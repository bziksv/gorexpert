# PHP 8.2 — совместимость Битрикс 16.0.9

Локальный стек работает на **Homebrew php@8.2**. Ядро Bitrix 16.0.9 из коробки рассчитано на PHP 5.x/7.0 и ломается на 8.x. Ниже — что уже применено в репозитории.

## Запуск

```bash
cd gorexpert.ru
./scripts/start-dev.sh          # php-fpm из /opt/homebrew/opt/php@8.2
./scripts/verify-php82.sh       # smoke-check страниц
```

## Слои совместимости

### 1. Полифиллы (runtime)

Канонический файл: `bitrix/php_interface/php82-polyfills.php`  
Подключается из `bitrix/php_interface/init.php` (и локально через `auto_prepend_file` в `.local/php/php.ini`).

- `each()`
- `get_magic_quotes_gpc()` / `get_magic_quotes_runtime()` / `set_magic_quotes_runtime()`
- `create_function()` (через `eval`, только для legacy)

### 2. Патчи ядра (в git)

| Проблема PHP 8 | Где / что сделано |
|----------------|-------------------|
| `$GLOBALS += $arr` запрещён | `tools.php`, `urlrewrite.php`, `404.php` → цикл `$GLOBALS[$k]=$v` |
| PHP4-конструкторы `function ClassName()` не вызываются | добавлены `__construct()` → `$this->ClassName(...)` в `bitrix/modules` |
| `Exception` typehints не принимают `Error` | `exceptionhandler*.php` → `\Throwable` |
| `ASSERT_QUIET_EVAL` удалён | `exceptionhandler.php` — проверки `defined()` |
| `$str{0}` синтаксис удалён | `punycode.php`, `asn.php` → `$str[0]` |
| nested ternary без скобок | `cache_html.php` |
| `mktime()` без аргументов | заменено на `time()` в modules |
| static call non-static event handlers | `module.php` `ExecuteModuleEventEx` |
| reserved class `String` | `BinaryString` (раньше) |
| `get_magic_quotes_gpc()` | guard `function_exists` в `tools.php` |
| `mysqli_fetch_assoc(null)` | guard в `FetchRow()` |

### 3. Что не трогаем

- `upload/`, секреты (`dbconn.php`, `.settings.php`, `license_key.php`)
- демо-wizards с curly braces (не на публичном runtime)

## Prod

На проде сейчас свой PHP (не 8.2). Эти патчи **обратно совместимы** с PHP 7.4: полифиллы локальные, правки ядра безопасны для 7.4.

Перед сменой PHP на хостинге:

1. Выкатить патчи из git (`php82-polyfills.php` + `init.php` уже в дереве)
2. Поставить PHP 8.2 + расширения (mysqli, mbstring, xml, gd, zip, intl, opcache)
3. Прогнать `./scripts/verify-php82.sh` против staging / prod URL

### Модули arturgolubev.*

- `phpQuery-onefile.php` — восстановлены `$param[0]` / `$param[1]` / `$param[2]` (сломанный патч curly braces)
- `Unitools` — методы `public static`, `\CUser`, `\IntVal`
- `cssinliner` — `getInnerCss`/`getOuterCss` без `CPHPCache` (ломал output buffer в `OnEndBufferContent`)
- `FilterCreateEx` — `public static` (вызов из `FilterCreate`)
