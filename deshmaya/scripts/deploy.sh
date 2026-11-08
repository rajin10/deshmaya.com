#!/usr/bin/env bash
set -Eeuo pipefail

PHP_BINARY="${1:-php}"
COMPOSER_BINARY="${2:-composer}"
PUBLIC_PATH="${3:-}"

cd "$(dirname "$0")/.."

"$COMPOSER_BINARY" install \
  --no-dev \
  --prefer-dist \
  --optimize-autoloader \
  --no-interaction \
  --no-scripts

mkdir -p storage/framework/{cache,data,sessions,views} storage/logs bootstrap/cache

if [ -n "$PUBLIC_PATH" ]; then
  cat > "$PUBLIC_PATH/index.php" <<PHP
<?php

use Illuminate\\Foundation\\Application;
use Illuminate\\Http\\Request;

define('LARAVEL_START', microtime(true));

\$maintenance = "$(pwd)/storage/framework/maintenance.php";
if (file_exists(\$maintenance)) {
    require \$maintenance;
}

require "$(pwd)/vendor/autoload.php";

/** @var Application \$app */
\$app = require_once "$(pwd)/bootstrap/app.php";
\$app->handleRequest(Request::capture());
PHP

  ln -sfn "$(pwd)/storage/app/public" "$PUBLIC_PATH/storage"
fi

if [ ! -L public/storage ]; then
  "$PHP_BINARY" artisan storage:link
fi
"$PHP_BINARY" artisan package:discover --ansi
"$PHP_BINARY" artisan migrate --force
"$PHP_BINARY" artisan optimize:clear
"$PHP_BINARY" artisan optimize
