#!/bin/sh
cd "$(dirname "$0")/.."
RUN_DIR="$(pwd)/.local/run"

lsof -ti:8096 2>/dev/null | xargs kill 2>/dev/null || true
lsof -ti:9096 2>/dev/null | xargs kill 2>/dev/null || true
[ -f "$RUN_DIR/nginx.pid" ] && kill "$(cat "$RUN_DIR/nginx.pid")" 2>/dev/null || true
[ -f "$RUN_DIR/php-fpm.pid" ] && kill "$(cat "$RUN_DIR/php-fpm.pid")" 2>/dev/null || true

sleep 1
lsof -ti:8096 2>/dev/null | xargs kill -9 2>/dev/null || true
lsof -ti:9096 2>/dev/null | xargs kill -9 2>/dev/null || true

echo "stopped (:8096 / :9096)"
