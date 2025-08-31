# Railway Deployment Setup

Bu rehber, Laravel uygulamanızı Railway'de deploy etmek için gerekli adımları içerir.

## 1. Railway'de Proje Oluşturma

1. [Railway Dashboard](https://railway.app/dashboard)'a gidin
2. "New Project" butonuna tıklayın
3. "Deploy from GitHub repo" seçeneğini seçin
4. Bu repository'yi seçin

## 2. Veritabanı Ekleme

1. Railway projenizde "New" butonuna tıklayın
2. "Database" seçeneğini seçin
3. "MySQL" veritabanını seçin
4. Veritabanı oluşturulduktan sonra, "Connect" sekmesinden connection bilgilerini alın

## 3. Environment Variables Ayarlama

Railway'de projenizin "Variables" sekmesinde aşağıdaki environment değişkenlerini ayarlayın:

### Temel Ayarlar
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app
LOG_CHANNEL=stack
LOG_LEVEL=error
```

### Veritabanı Ayarları (Railway otomatik olarak sağlar)
```
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}
```

### Diğer Ayarlar
```
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
BROADCAST_DRIVER=log
FILESYSTEM_DISK=local
```

## 4. APP_KEY Oluşturma

Railway'de terminal açın ve şu komutu çalıştırın:
```bash
php artisan key:generate
```

## 5. Migration ve Seeder Çalıştırma

Railway'de terminal açın ve şu komutları çalıştırın:
```bash
php artisan migrate --force
php artisan db:seed --force
```

## 6. Storage Link Oluşturma

```bash
php artisan storage:link
```

## 7. Cache Temizleme ve Optimize Etme

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Sorun Giderme

### Veritabanı Bağlantı Hatası
Eğer "Connection refused" hatası alıyorsanız:
1. Veritabanının Railway'de aktif olduğundan emin olun
2. Environment değişkenlerinin doğru ayarlandığından emin olun
3. Veritabanı servisinin uygulama servisinden önce başladığından emin olun

### Migration Hatası
Eğer migration'lar çalışmıyorsa:
1. Veritabanı bağlantısını kontrol edin
2. `php artisan migrate:status` komutu ile durumu kontrol edin
3. Gerekirse `php artisan migrate:fresh --seed` komutunu çalıştırın

### Dosya İzinleri
Eğer dosya izin hatası alıyorsanız:
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## Önemli Notlar

1. **Production Environment**: `APP_ENV=production` ve `APP_DEBUG=false` olmalı
2. **SSL**: Railway otomatik olarak SSL sertifikası sağlar
3. **Database**: Railway MySQL veritabanı kullanır
4. **Logs**: Railway'de logları "Logs" sekmesinden takip edebilirsiniz

## Deployment Sonrası Kontrol

1. Uygulamanızın çalıştığını kontrol edin
2. Veritabanı tablolarının oluştuğunu kontrol edin
3. Admin panelinin çalıştığını kontrol edin
4. Dosya upload'larının çalıştığını kontrol edin
