#!/bin/sh
set -e
cd "$(dirname "$0")/.."
PROJECT="$(pwd)"
SITE_ROOT="$(pwd)"
ENV_FILE="$PROJECT/.local/db.env"
LOG_DIR="$PROJECT/.local/run"
LOG_FILE="$LOG_DIR/mysql-import.log"
PID_FILE="$LOG_DIR/mysql-import.pid"

if [ ! -f "$ENV_FILE" ]; then
  echo "Missing $ENV_FILE — run: cp .local/db.env.example .local/db.env"
  exit 1
fi

. "$ENV_FILE"

SQL_PATH="$PROJECT/$SQL_DUMP"
if [ ! -f "$SQL_PATH" ]; then
  echo "Dump not found: $SQL_PATH"
  exit 1
fi

mkdir -p "$LOG_DIR"

if ! mysqladmin --protocol=SOCKET ping --silent 2>/dev/null; then
  echo "MySQL is not running. Start: brew services start mysql"
  exit 1
fi

echo "Creating database and user..."
mysql --protocol=SOCKET -u root <<SQL
CREATE DATABASE IF NOT EXISTS \`$DB_NAME\`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '$DB_LOGIN'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
CREATE USER IF NOT EXISTS '$DB_LOGIN'@'127.0.0.1' IDENTIFIED BY '$DB_PASSWORD';
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$DB_LOGIN'@'localhost';
GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$DB_LOGIN'@'127.0.0.1';
GRANT SESSION_VARIABLES_ADMIN, SYSTEM_VARIABLES_ADMIN ON *.* TO '$DB_LOGIN'@'localhost';
GRANT SESSION_VARIABLES_ADMIN, SYSTEM_VARIABLES_ADMIN ON *.* TO '$DB_LOGIN'@'127.0.0.1';
FLUSH PRIVILEGES;
SQL

TABLES=$(mysql --protocol=SOCKET -u root -N -e \
  "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='$DB_NAME'" 2>/dev/null || echo 0)

FORCE_IMPORT=false
BG=false
for arg in "$@"; do
  case "$arg" in
    --force|-f) FORCE_IMPORT=true ;;
    --background|-b) BG=true ;;
  esac
done

if [ "$FORCE_IMPORT" = true ]; then
  echo "Dropping database $DB_NAME..."
  mysql --protocol=SOCKET -u root -e "DROP DATABASE IF EXISTS \`$DB_NAME\`;"
  mysql --protocol=SOCKET -u root <<SQL
CREATE DATABASE \`$DB_NAME\`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
SQL
  TABLES=0
fi

if [ "$TABLES" -ge 50 ] && [ "$FORCE_IMPORT" = false ]; then
  echo "Database already has $TABLES tables — skip import."
  echo "To re-import: $0 --force"
else
  DUMP_SIZE=$(du -h "$SQL_PATH" | awk '{print $1}')
  echo "Importing $SQL_DUMP ($DUMP_SIZE) into $DB_NAME..."

  if [ "$BG" = true ]; then
    if [ -f "$PID_FILE" ] && kill -0 "$(cat "$PID_FILE")" 2>/dev/null; then
      echo "Import already running (pid $(cat "$PID_FILE")). tail -f $LOG_FILE"
      exit 0
    fi
    : > "$LOG_FILE"
    nohup sh -c "
      case '$SQL_PATH' in
        *.gz)
          gunzip -c '$SQL_PATH' | mysql --protocol=SOCKET -u root \
            --default-character-set=utf8mb4 --max_allowed_packet=64M '$DB_NAME'
          ;;
        *)
          mysql --protocol=SOCKET -u root \
            --default-character-set=utf8mb4 --max_allowed_packet=64M \
            '$DB_NAME' < '$SQL_PATH'
          ;;
      esac
      echo 'IMPORT OK' >> '$LOG_FILE'
    " >> "$LOG_FILE" 2>&1 &
    echo $! > "$PID_FILE"
    echo "Import started in background (pid $(cat "$PID_FILE"))."
    echo "Progress: tail -f $LOG_FILE"
    exit 0
  fi

  case "$SQL_PATH" in
    *.gz)
      gunzip -c "$SQL_PATH" | mysql --protocol=SOCKET -u root \
        --default-character-set=utf8mb4 --max_allowed_packet=64M "$DB_NAME"
      ;;
    *)
      mysql --protocol=SOCKET -u root \
        --default-character-set=utf8mb4 --max_allowed_packet=64M \
        "$DB_NAME" < "$SQL_PATH"
      ;;
  esac
  echo "Import finished."
fi

"$PROJECT/scripts/apply-local-db-config.sh"

TABLES=$(mysql -h "$DB_HOST" -u "$DB_LOGIN" -p"$DB_PASSWORD" -N -e \
  "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='$DB_NAME'" 2>/dev/null)
echo "Tables in $DB_NAME: $TABLES"
echo "Start: ./scripts/start-dev.sh"
