# 🚂 Railway Deployment Setup

## Healthcheck Sorunu Çözümü

### 1. Railway Dashboard'da Environment Variables

Railway dashboard'da şu environment variables'ları ekleyin:

```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app
APP_KEY=base64:your-app-key-here
LOG_CHANNEL=stack
LOG_LEVEL=error
DB_CONNECTION=mysql
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### 2. Laravel Key Oluşturma

Laravel key oluşturmak için:

```bash
# Yerel makinenizde
cd laravel-app
php artisan key:generate --show
```

Bu komut size bir key verecek. Bu key'i Railway'de `APP_KEY` olarak kullanın.

### 3. Veritabanı Ekleme

1. Railway dashboard'da "New Service" → "Database" → "MySQL"
2. Environment variables'da şu değişkenleri güncelleyin:
   - `DB_HOST`: Railway'in verdiği host
   - `DB_DATABASE`: Railway'in verdiği database name
   - `DB_USERNAME`: Railway'in verdiği username
   - `DB_PASSWORD`: Railway'in verdiği password

### 4. Healthcheck Endpoint

Proje `/health` endpoint'ini içerir. Bu endpoint şu JSON'u döner:

```json
{
  "status": "OK",
  "timestamp": "2024-01-01T00:00:00.000000Z"
}
```

### 5. Deployment Adımları

1. **GitHub repo'nuzu Railway'e bağlayın**
2. **Environment variables'ları ayarlayın**
3. **MySQL veritabanı ekleyin**
4. **Deploy edin**

### 6. Troubleshooting

#### Healthcheck Hatası
- Environment variables'ların doğru olduğundan emin olun
- `APP_KEY`'in doğru formatta olduğunu kontrol edin
- Veritabanı bağlantısını test edin

#### Veritabanı Bağlantı Hatası
- Railway'de MySQL servisinin çalıştığından emin olun
- Environment variables'da DB_* değişkenlerini kontrol edin

#### Laravel Hatası
- Logları kontrol edin: Railway dashboard → Logs
- Cache'i temizleyin: `php artisan cache:clear`

### 7. Monitoring

Railway dashboard'da:
- **Logs**: Uygulama loglarını görüntüleyin
- **Metrics**: CPU, memory kullanımını izleyin
- **Health**: Healthcheck durumunu kontrol edin

### 8. Domain Ayarlama

Railway otomatik olarak bir domain verir. Özel domain eklemek için:
1. Railway dashboard → Settings → Domains
2. "Add Domain" → domain adınızı girin
3. DNS ayarlarını yapın

### 9. SSL Sertifikası

Railway otomatik olarak SSL sertifikası sağlar. Ek ayar gerekmez.

### 10. Backup

Railway MySQL veritabanı otomatik backup alır. Manuel backup için:
1. Railway dashboard → Database → Backups
2. "Create Backup" → backup'ı indirin
