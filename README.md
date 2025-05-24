# 🛠 Установка и настройка проекта Laravel

## 📋 Системные требования
- **ОС**: Windows 10/11 или Linux
- **PHP**: 8.1+
- **База данных**: MySQL 5.7+ / PostgreSQL / SQLite
- **Node.js**: 16+ (для фронтенда)
- **Composer**: 2.5+

## 🚀 Быстрый старт

### 1. Установка зависимостей
```bash
composer install
npm install
npm run dev
2. Настройка окружения
bash
cp .env.example .env
php artisan key:generate

4. Запуск миграций
bash
php artisan migrate --seed
5. Запуск сервера
bash
php artisan serve
