#!/bin/bash
set -e

# انسخ .env.example إلى .env لو مش موجود
if [ ! -f ".env" ]; then
  cp .env.example .env || touch .env
fi

# أضف متغيرات أساسية لو .env فاضي
echo "APP_NAME='Programming News'" >> .env
echo "APP_ENV=local" >> .env
echo "APP_DEBUG=true" >> .env
echo "APP_URL=http://localhost:8000" >> .env

# توليد APP_KEY لو مش موجود (ده هيحل الـ 500 error نهائياً)
php artisan key:generate --force

# صلاحيات Laravel (لو حصل error permissions)
chmod -R 777 storage bootstrap/cache || true

# شغّل السيرفر
exec php artisan serve --host=0.0.0.0 --port=8000