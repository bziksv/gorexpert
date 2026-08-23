#!/bin/sh
set -e
cd "$(dirname "$0")/.."
PROJECT="$(pwd)"
SITE_ROOT="$(pwd)"
PHP_BIN=/opt/homebrew/opt/php@7.4
NGINX=/opt/homebrew/bin/nginx
RUN_DIR="$PROJECT/.local/run"
ENV_FILE="$PROJECT/.local/db.env"

mkdir -p "$RUN_DIR"

if [ -f "$ENV_FILE" ]; then
  . "$ENV_FILE"
fi

if mysqladmin --protocol=SOCKET ping --silent 2>/dev/null; then
  if [ ! -f "$SITE_ROOT/bitrix/php_interface/dbconn.local.php" ]; then
    "$PROJECT/scripts/apply-local-db-config.sh"
  fi
  if [ -n "${DB_LOGIN:-}" ] && [ -n "${DB_PASSWORD:-}" ] && [ -n "${DB_NAME:-}" ]; then
    TABLES=$(mysql -h 127.0.0.1 -u "$DB_LOGIN" -p"$DB_PASSWORD" -N -e \
      "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='$DB_NAME'" 2>/dev/null || echo 0)
    if [ "$TABLES" -lt 50 ]; then
      if [ -f "$RUN_DIR/mysql-import.pid" ] && kill -0 "$(cat "$RUN_DIR/mysql-import.pid")" 2>/dev/null; then
        echo "MySQL import in progress — tail -f $RUN_DIR/mysql-import.log"
      else
        echo "WARN: DB empty ($TABLES tables). Run: ./scripts/setup-local-db.sh"
      fi
    else
      echo "Local MySQL: $DB_NAME ($TABLES tables)"
    fi
  fi
else
  echo "WARN: MySQL not running — brew services start mysql"
fi

if [ -f "$SITE_ROOT/bitrix/html_pages/.enabled" ]; then
  mv "$SITE_ROOT/bitrix/html_pages/.enabled" \
    "$SITE_ROOT/bitrix/html_pages/.enabled.local-off" 2>/dev/null || true
fi

"$PROJECT/scripts/stop-dev.sh" 2>/dev/null || true
sleep 1

USER_NAME="$(whoami)"
USER_GROUP="$(id -gn)"

sed "s|SITE_ROOT|$SITE_ROOT|g; s|RUN_DIR|$RUN_DIR|g" \
  "$PROJECT/.local/nginx/nginx.conf" > "$RUN_DIR/nginx.conf"
sed "s|RUN_DIR|$RUN_DIR|g" \
  "$PROJECT/.local/php/fpm.conf" > "$RUN_DIR/fpm.conf"
sed "s|USER_NAME|$USER_NAME|g; s|USER_GROUP|$USER_GROUP|g; s|RUN_DIR|$RUN_DIR|g" \
  "$PROJECT/.local/php/pools.conf" > "$RUN_DIR/pools.conf"
cp "$PROJECT/.local/php/php.ini" "$RUN_DIR/php.ini"

export PHPRC="$RUN_DIR/php.ini"

"$PHP_BIN/sbin/php-fpm" -y "$RUN_DIR/fpm.conf" &
FPM_PID=$!
sleep 1

if ! kill -0 "$FPM_PID" 2>/dev/null; then
  echo "php-fpm failed — see $RUN_DIR/php-fpm.log"
  exit 1
fi

"$NGINX" -c "$RUN_DIR/nginx.conf"
sleep 1

HTTP=$(curl -sS -o /tmp/gorexpert-check.html -w '%{http_code}' --max-time 120 http://127.0.0.1:8096/ || echo 000)
BYTES=$(wc -c < /tmp/gorexpert-check.html 2>/dev/null | tr -d ' ')

echo "http://127.0.0.1:8096/ → HTTP $HTTP (${BYTES:-0} bytes)"
echo "php-fpm :9096 (PHP 7.4, ondemand, max 2 workers, 512M)"
echo "stop: ./scripts/stop-dev.sh"

if [ "$HTTP" = "000" ] || [ "${BYTES:-0}" -lt 10000 ]; then
  echo "WARN: site not responding or empty page — check $RUN_DIR/php-errors.log"
  tail -10 "$RUN_DIR/nginx-error.log" 2>/dev/null || true
  exit 1
fi
