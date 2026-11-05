# PHP 8.x — совместимость Битрикс 16.0.9

Имя файла историческое (`PHP82`). Актуально для **PHP 8.2 / 8.3**.

| Окружение | PHP |
|-----------|-----|
| Local (`./scripts/start-dev.sh`) | Homebrew **php@8.3** FPM |
| Prod `gorexpert.ru` (`155.212.171.103`) | **8.3.6** |

Ядро Bitrix 16.0.9 из коробки рассчитано на PHP 5.x/7.0 и ломается на 8.x. Ниже — что уже применено в репозитории.

## Запуск

```bash
cd gorexpert.ru
./scripts/start-dev.sh          # php-fpm из /opt/homebrew/opt/php@8.3
./scripts/verify-php82.sh       # smoke-check страниц
```

## Слои совместимости

### 1. Полифиллы (runtime)

Канонический файл: `bitrix/php_interface/php82-polyfills.php`  
Подключается из `bitrix/php_interface/init.php` (и локально через `auto_prepend_file` в `.local/php/php.ini`).

- `each()`
- `get_magic_quotes_gpc()` / `get_magic_quotes_runtime()` / `set_magic_quotes_runtime()`
- `create_function()` (через `eval`, только для legacy)
- в `/bitrix/admin/`: белый фон страницы (чтобы Cursor/Electron не снимал «чёрный экран» на fatal/пустом body)

### 2. Патчи ядра (в git)

| Проблема PHP 8 | Где / что сделано |
|----------------|-------------------|
| `$GLOBALS += $arr` запрещён | `tools.php`, `urlrewrite.php`, `404.php` → цикл `$GLOBALS[$k]=$v` |
| PHP4-конструкторы `function ClassName()` не вызываются | добавлены `__construct()` → `$this->ClassName(...)` (compression, fileman, controller packets, …) |
| `Exception` typehints не принимают `Error` | `exceptionhandler*.php` → `\Throwable` |
| `ASSERT_QUIET_EVAL` удалён | `exceptionhandler.php` — проверки `defined()` |
| `$str{0}` синтаксис удалён | `punycode.php`, `asn.php` → `$str[0]` |
| nested ternary без скобок | `cache_html.php` |
| `mktime()` без аргументов | заменено на `time()` в modules |
| static call non-static | `admin_lib`, `admin_tools`, `user`, `fileman_*`, `iblock*`, `CTar::getNextName`, update_client*, … |
| signature mismatch child/parent | `CControllerClientRequestTo::Send($url, $page)` |
| `continue` в `switch` внутри цикла | `event_log.php` → `continue 2` |
| mysqli exceptions при `$ignore_errors` | `database_mysqli.php` `QueryInternal` — catch `mysqli_sql_exception` |
| empty/`false` unserialize backup | `CControllerClient::GetBackup` / `GetInstalledOptions` |
| reserved class `String` | `BinaryString` |
| `mysqli_fetch_assoc(null)` | guard в `FetchRow()` |

### 3. Что не трогаем

- `upload/`, секреты (`dbconn.php`, `.settings.php`, `license_key.php`)
- демо-wizards с curly braces (не на публичном runtime)

## Prod

Прод уже на **PHP 8.3.6** (`155.212.171.103`, путь и деплой — в [PROJECT.md](PROJECT.md)).

Перед выкатом патчей:

1. `git push origin main`
2. rsync нужных файлов на `/var/www/gorexpert_ru_usr/data/www/gorexpert.ru` (на диске сайта **нет** git)
3. `chown -R gorexpert_ru_usr:gorexpert_ru_usr` на залитые пути + сброс `bitrix/cache`, `managed_cache`, `html_pages`
4. БД целиком не копировать; при необходимости только `CREATE TABLE IF NOT EXISTS` для пустых UF-таблиц (`b_utm_user`, `b_uts_user`)
5. Smoke: админка `/bitrix/admin/`, `settings.php?mid=main`, `update_system.php`, `event_log.php`, `dump_list.php`

### Модули arturgolubev.*

- `phpQuery-onefile.php` — восстановлены `$param[0]` / `$param[1]` / `$param[2]` (сломанный патч curly braces)
- `Unitools` — методы `public static`, `\CUser`, `\IntVal`
- `cssinliner` — `getInnerCss`/`getOuterCss` без `CPHPCache` (ломал output buffer в `OnEndBufferContent`)
- `FilterCreateEx` — `public static` (вызов из `FilterCreate`)
