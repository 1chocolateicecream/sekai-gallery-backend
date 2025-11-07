# 🎨 Sekai Asset Gallery - Backend

Backend API для Sekai Gallery с защищённой админ-панелью.

## 🚀 Установка

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## 🔧 Конфигурация

Откройте `.env` и установите секретный префикс:

```env
DB_CONNECTION=sqlite
ADMIN_SECRET_PREFIX=sekai_admin_2024
```

## 🎛 Админ-панель

Доступ через секретный URL: `http://localhost:8000/{ADMIN_SECRET_PREFIX}/assets`

**Функции:**
- ✅ Просмотр всех assets
- ➕ Добавление новых images с URL
- ✏️ Редактирование
- ❌ Удаление

## 📡 API

### GET `/api/v1/images`

**Query Parameters:**
- `unit` - фильтр по юниту (leoneed, vbs, mmj, wxs, n25, other)
- `tags[]` - фильтр по тегам (AND логика)

**Примеры:**

```bash
# Все images
GET /api/v1/images

# Только Leo/need
GET /api/v1/images?unit=leoneed

# С тегами
GET /api/v1/images?tags[]=room&tags[]=school
```

## 🏃 Запуск

```bash
php artisan serve
# http://localhost:8000
```

## 📦 Deployment

**Render/Fly.io:**
1. Build: `composer install --no-dev`
2. Start: `php artisan serve --host=0.0.0.0 --port=$PORT`
3. Env vars: `APP_KEY`, `ADMIN_SECRET_PREFIX`
