#!/bin/sh
# Smoke-check Bitrix 16 on local PHP 8.2 stack.
set -e
cd "$(dirname "$0")/.."
BASE="${1:-http://127.0.0.1:8096}"

fail=0
check() {
  url="$1"
  min="${2:-1000}"
  code=$(curl -sS -o /tmp/gx82-check.html -w '%{http_code}' --max-time 30 "$BASE$url" || echo 000)
  bytes=$(wc -c < /tmp/gx82-check.html | tr -d ' ')
  if [ "$code" != "200" ] || [ "$bytes" -lt "$min" ]; then
    echo "FAIL $url → HTTP $code (${bytes}b)"
    fail=1
  else
    echo "OK   $url → HTTP $code (${bytes}b)"
  fi
  if grep -qiE 'Fatal error|ParseError|TypeError|ArgumentCountError' /tmp/gx82-check.html 2>/dev/null; then
    if ! grep -qiE 'DOCTYPE|Городская|gorexpert' /tmp/gx82-check.html 2>/dev/null; then
      echo "FAIL $url contains PHP fatal"
      fail=1
    fi
  fi
}

echo "PHP FPM binary: $(/opt/homebrew/opt/php@8.2/bin/php -v | head -1)"
check "/" 5000
check "/contacts/" 3000
check "/online-zajavka/" 2000
check "/company/legal/politika-cookie/" 2000
check "/company/legal/politika-personalnyh-dannyh/" 2000
check "/services/ocenka-nedvijemosti/" 2000

if [ "$fail" -ne 0 ]; then
  echo "PHP 8.2 smoke check FAILED"
  exit 1
fi
echo "PHP 8.2 smoke check passed"
