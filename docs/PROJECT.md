# gorexpert.ru — документация проекта

## О проекте

Сайт ООО **«Городская экспертиза»** (Санкт-Петербург) — оценочная компания, работающая с 2004 года. Услуги по оценке недвижимости, бизнеса, оборудования, земельных участков и др.

| Параметр | Значение |
|----------|----------|
| CMS | 1С-Битрикс **16.0.9** |
| Шаблон | `bitrix/templates/gorexpert/` |
| Кастомный код | `bitrix/php_interface/`, `include_areas/`, разделы `/services/` |
| Медиа | `upload/` (medialibrary) |
| Локальный URL | **http://127.0.0.1:8096/** |
| Локальная БД | `gorexpert_local` @ `127.0.0.1` |
| Git | [github.com/bziksv/gorexpert](https://github.com/bziksv/gorexpert) |
| Prod | [gorexpert.ru](https://gorexpert.ru) |

### Бизнес-направления

- **Услуги** — ~70 статических страниц в `/services/` (оценка недвижимости, бизнеса, оборудования и т.д.)
- **Новости** — инфоблок 1, компонент `bitrix:news`
- **Статьи** — инфоблок 2, компонент `bitrix:news`
- **Фотогалерея** — модуль `v1rt.mediagallery`, `/gallerys/`
- **Онлайн-заявка** — компонент `bitrix:order`, `/online-zajavka/`
- **Контакты, документы, прайсы, примеры отчётов** — статические разделы

---

## Сервер и окружения

| Окружение | Домен | Путь на сервере | IP |
|-----------|-------|-----------------|-----|
| **Prod** | gorexpert.ru | `/var/www/gorexpert/data/www/gorexpert.ru` | 45.90.35.63 |

### Правило работы

> **Сейчас работаем только локально** (`http://127.0.0.1:8096/`).  
> Деплой на prod — только по явной просьбе.

### SSH-доступ

```bash
ssh root@45.90.35.63
# путь к сайту: /var/www/gorexpert/data/www/gorexpert.ru
```

Рекомендуемая запись в `~/.ssh/config`:

```
Host gorexpert
    HostName 45.90.35.63
    User root
    IdentityFile ~/.ssh/id_ed25519
    IdentitiesOnly yes
```

### Деплой на prod (по запросу)

Сайт на проде — git-репозиторий с remote `https://github.com/bziksv/gorexpert`.  
Пользователь веб-сервера / PHP: **`gorexpert:gorexpert`**.

```bash
ssh root@45.90.35.63
cd /var/www/gorexpert/data/www/gorexpert.ru

git fetch origin main
git reset --hard FETCH_HEAD

# ОБЯЗАТЕЛЬНО: git от root оставляет файлы root:root —
# без этого Битрикс не сможет редактировать файлы в админке
chown -R gorexpert:gorexpert /var/www/gorexpert/data/www/gorexpert.ru
find . -type d -exec chmod 755 {} +
find . -type f -exec chmod 644 {} +
for d in bitrix/cache bitrix/managed_cache bitrix/stack_cache bitrix/html_pages bitrix/tmp upload; do
  [ -d "$d" ] && find "$d" -type d -exec chmod 775 {} + && find "$d" -type f -exec chmod 664 {} +
done

rm -rf bitrix/cache/* bitrix/managed_cache/* bitrix/html_pages/*
```

Одной командой с локальной машины:

```bash
ssh root@45.90.35.63 'set -e
SITE=/var/www/gorexpert/data/www/gorexpert.ru
cd "$SITE"
git fetch origin main && git reset --hard FETCH_HEAD
chown -R gorexpert:gorexpert "$SITE"
find "$SITE" -type d -exec chmod 755 {} +
find "$SITE" -type f -exec chmod 644 {} +
for d in bitrix/cache bitrix/managed_cache bitrix/stack_cache bitrix/html_pages bitrix/tmp upload; do
  [ -d "$SITE/$d" ] && find "$SITE/$d" -type d -exec chmod 775 {} + && find "$SITE/$d" -type f -exec chmod 664 {} +
done
rm -rf bitrix/cache/* bitrix/managed_cache/* bitrix/html_pages/*
'
```

> **Важно:** секреты (`dbconn.php`, `.settings.php`, `license_key.php`, `upload/`) в git не входят — на проде они остаются локальными и при `git reset` не затираются.  
> Если после деплоя в админке «Проверка доступа» ругается на чтение/запись — почти всегда забыли `chown -R gorexpert:gorexpert`.

---

## Архитектура

```
Пользователь
    ↓
bitrix/templates/gorexpert/     (header, footer, CSS/JS)
    ↓
services/*/index.php            (статические страницы услуг)
news/index.php                  (bitrix:news, iblock 1)
articles/index.php              (bitrix:news, iblock 2)
gallerys/index.php              (v1rt.mediagallery:mediagallery)
online-zajavka/index.php        (bitrix:order → info@gorexpert.ru)
    ↓
bitrix/php_interface/           (after_connect.php, dbconn)
```

### Ключевые компоненты

| Раздел | Компонент | Iblock / модуль |
|--------|-----------|-----------------|
| Новости | `bitrix:news` / `firstsite.content` | **1** — content |
| Статьи | `bitrix:news` / `firstsite.content` | **2** — content |
| Фотогалерея | `v1rt.mediagallery:mediagallery` | модуль `v1rt.mediagallery` |
| Онлайн-заявка | `bitrix:order` | почтовое событие #7 |
| Карта сайта | `bitrix:main.map` | `/sitemap/` |

Услуги — **не инфоблоки**, а отдельные PHP-страницы в `/services/<slug>/index.php` с include-областями из `include_areas/`.

### Кастомные модули

| Модуль | Назначение |
|--------|------------|
| `v1rt.mediagallery` | Фотогалерея (коллекции, папки) |
| `niges.cookiesaccept` | Баннер cookies |
| `arturgolubev.cssinliner` | Инлайн CSS (оптимизация) |
| `arturgolubev.lazyload` | Ленивая загрузка изображений |
| `prime.cleaner` | Очистка / обслуживание |

### PHP 8.2 (локальный стек и патчи ядра)

Локально: Homebrew **php@8.2** FPM. Битрикс 16.0.9 из коробки на 8.x не стартует — в репозитории лежит слой совместимости.

Подробности: **[docs/PHP82.md](PHP82.md)**. Проверка: `./scripts/verify-php82.sh`.

Кратко:

- полифиллы: `bitrix/php_interface/php82-polyfills.php` (+ `init.php`)
- `__construct` для PHP4-конструкторов в `bitrix/modules`
- правки `$GLOBALS += …`, curly braces, nested ternary, `mktime()` → `time()`, `\Throwable` в exception handler
- патч `String` → `BinaryString` (PHP 7.1+)

---

| Файл | Назначение |
|------|------------|
| `bitrix/php_interface/after_connect.php` | `SET NAMES utf8`, `sql_mode` |
| `bitrix/php_interface/after_connect_d7.php` | D7-подключение |
| `include_areas/` | Include-области шаблона (шапка, футер, блоки) |

---

## Инфоблоки

| ID | Тип | Назначение |
|----|-----|------------|
| **1** | content | Новости (`/news/`) |
| **2** | content | Статьи (`/articles/`) |

---

## Структура проекта

```
gorexpert/                      — workspace (вне git)
├── gorexpert_ru.sql            — дамп БД (~2.4 MB, вне git)
└── gorexpert.ru/               — git root, код сайта
    ├── bitrix/
    │   ├── templates/gorexpert/    — шаблон сайта
    │   ├── modules/                — кастомные модули
    │   └── php_interface/          — dbconn, after_connect
    ├── services/                   — ~70 страниц услуг
    ├── include_areas/              — include-блоки шаблона
    ├── news/, articles/            — разделы с компонентами
    ├── scripts/                    — локальный dev
    ├── .local/                     — nginx/php-fpm (gitignored runtime)
    └── docs/                       — документация
```

Корневые dot-файлы (меню, доступ, ЧПУ):

| Файл | Назначение |
|------|------------|
| `.top.menu.php` | Верхнее меню |
| `.left.menu.php` | Левое меню |
| `.dopmenu.menu.php` | Доп. меню |
| `.htaccess` | Apache: редиректы, ЧПУ |
| `.access.php` | Права доступа Bitrix |
| `urlrewrite.php` | Правила ЧПУ |

---

## Локальная разработка

Без Docker. Homebrew **nginx** + **PHP 8.2 FPM** (`php@8.2`) + **MySQL**.

> **Важно:** ядро Битрикс **16.0.9** требует патча `String` → `BinaryString` в `bitrix/modules/main/lib/text/` (уже применён локально) для работы на PHP 7.1+ / 8.x.

```bash
cd gorexpert.ru
cp .local/db.env.example .local/db.env
./scripts/setup-local-db.sh       # импорт ../gorexpert_ru.sql (один раз)
./scripts/start-dev.sh            # nginx :8096 + php-fpm :9096
./scripts/stop-dev.sh             # остановка
```

| Параметр | Значение |
|----------|----------|
| URL | http://127.0.0.1:8096/ |
| Nginx | `.local/nginx/nginx.conf` → `.local/run/nginx.conf` |
| PHP-FPM | `.local/php/fpm.conf`, `pools.conf` |
| Учётные данные БД | `.local/db.env` (gitignored) |
| Локальный dbconn | `bitrix/php_interface/dbconn.local.php` (gitignored) |

При первом запуске `start-dev.sh` вызывает `apply-local-db-config.sh`, если `dbconn.local.php` отсутствует.

Пересоздать БД из дампа:

```bash
./scripts/setup-local-db.sh --force
```

### Порты соседних проектов

| Проект | HTTP | FPM |
|--------|------|-----|
| almamed | 8080 | 9080 |
| akvasan-shop | 8081 | 9081 |
| vilmed | 8082 | 9082 |
| kosmamed | 8083 | 9083 |
| polimer | 8084 | 9084 |
| lormag | 8085 | 9085 |
| metplus-vrn.ru | 8086 | 9086 |
| oftalmag / insortex | 8087 | 9087 |
| metprof-vrn | 8088 | 9088 |
| vrn-ehk | 8089 | 9089 |
| medplakaty | 8090 | 9090 |
| miinox | 8091 | 9091 |
| argument-uk | 8092 | 9092 |
| dckljaksa | 8093 | 9093 |
| fasad36.ru | 8094 | 9094 |
| gnkmed | 8095 | 9095 |
| **gorexpert.ru** | **8096** | **9096** |

---

## Git

**Репозиторий:** [github.com/bziksv/gorexpert](https://github.com/bziksv/gorexpert)  
**Git root:** папка `gorexpert.ru/` (дамп `gorexpert_ru.sql` лежит на уровень выше, вне git).

### Что НЕ коммитить

Секреты и тяжёлые данные исключены в `.gitignore`:

- `bitrix/.settings.php` — пароль БД
- `bitrix/php_interface/dbconn.php`, `dbconn.local.php`
- `bitrix/license_key.php`
- `.local/db.env`, `.local/run/`, `.local/backup/`
- `upload/`, кеш, дампы (`*.sql`)

Примеры без секретов: `bitrix/.settings.example.php`, `bitrix/php_interface/dbconn.example.php`.

### Исключения из индексации Cursor

Настроены в `.cursorignore` (по образцу fasad36, metplus-vrn.ru):

- кеш Битрикс
- медиа (`upload/`)
- ядро UI (`bitrix/js`, `bitrix/css`, `bitrix/admin`…)
- бинарные файлы

---

## База данных

| Параметр | Prod | Local |
|----------|------|-------|
| Имя БД | `gorexpert_ru` | `gorexpert_local` |
| Пользователь | `gorexpert_ru` | `gorexpert_local` |
| Хост | `localhost` | `127.0.0.1` |
| Дамп | — | `../gorexpert_ru.sql` (~2.4 MB) |

---

## Журнал изменений

| Дата | Что сделано |
|------|-------------|
| 2026-08-23 | Первичная документация, `.gitignore`, `.cursorignore`, локальный dev :8096, скрипты в `scripts/`, патч `String`→`BinaryString` для PHP 7.4 |

### Шаблон записи

```markdown
### YYYY-MM-DD — краткое описание
- **Проблема:** ...
- **Решение:** ...
- **Файлы:** path/to/file.php
```
