#!/bin/bash

echo "🚂 Railway Manual Setup Script"
echo "=============================="
echo "Bu script'i Railway terminal'de çalıştırın"
echo ""

# Check if we're in Railway environment
if [ -z "$RAILWAY_ENVIRONMENT" ] && [ -z "$MYSQLHOST" ]; then
    echo "⚠️  Warning: Bu script'i Railway terminal'de çalıştırmanız gerekiyor."
    echo "Railway Dashboard → Your Project → Terminal"
    echo ""
fi

echo "📋 Laravel Setup Komutları:"
echo "=============================="

echo ""
echo "1️⃣  APP_KEY oluşturma:"
echo "php artisan key:generate --force"
echo ""

echo "2️⃣  Veritabanı migration'ları:"
echo "php artisan migrate --force"
echo ""

echo "3️⃣  Storage link oluşturma:"
echo "php artisan storage:link --force"
echo ""

echo "4️⃣  Cache'leri temizleme:"
echo "php artisan config:clear"
echo "php artisan cache:clear"
echo "php artisan route:clear"
echo "php artisan view:clear"
echo ""

echo "5️⃣  Production optimizasyonları:"
echo "php artisan config:cache"
echo "php artisan route:cache"
echo "php artisan view:cache"
echo ""

echo "6️⃣  Seeder çalıştırma (opsiyonel):"
echo "php artisan db:seed --force"
echo ""

echo "7️⃣  Test endpoint'leri:"
echo "curl /health"
echo "curl /db-test"
echo ""

echo "🎯 Her komutu tek tek çalıştırın ve hata mesajlarını kontrol edin."
echo "✅ Tüm komutlar başarılı olduktan sonra uygulamanız hazır olacak!"
echo ""
echo "📖 Detaylı rehber için: RAILWAY_SETUP.md dosyasını okuyun"
