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
APP_NAME=Gaffini
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

## 4. Deployment

1. Railway'de "Deploy" butonuna tıklayın
2. Build sürecini bekleyin (5-10 dakika)
3. Deployment tamamlandıktan sonra, Railway terminal'de aşağıdaki komutları çalıştırın:

## 5. Post-Deployment Komutları

Railway'de terminal açın ve şu komutları sırasıyla çalıştırın:

```bash
# APP_KEY oluşturma
php artisan key:generate --force

# Migration'ları çalıştırma
php artisan migrate --force

# Storage link oluşturma
php artisan storage:link --force

# Cache'leri temizleme
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Production optimizasyonları
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 6. Seeder Çalıştırma (Opsiyonel)

Eğer seed data'ları yüklemek istiyorsanız:

```bash
php artisan db:seed --force
```

## Sorun Giderme

### Startup Script Hatası
Eğer startup script hatası alırsanız:

**Çözüm 1: Manuel Komutlar**
Railway terminal'de manuel olarak komutları çalıştırın (yukarıdaki Post-Deployment Komutları)

**Çözüm 2: Basit Apache Başlatma**
Railway'de "Variables" sekmesinde:
```
startCommand = "apache2-foreground"
```

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

## Test Endpoints

Deployment sonrası şu endpoint'leri test edebilirsiniz:
- `https://your-app.railway.app/health` - Genel sağlık kontrolü
- `https://your-app.railway.app/db-test` - Veritabanı bağlantı testi

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

## Manuel Komutlar

Eğer post-deploy komutları otomatik çalışmazsa, Railway terminal'de manuel olarak çalıştırın:

```bash
# Veritabanı bağlantısını test etme
php artisan tinker --execute="DB::connection()->getPdo();"

# Migration durumunu kontrol etme
php artisan migrate:status

# Cache'leri temizleme
php artisan config:clear
php artisan cache:clear
```

## Alternatif Çözümler

### Eğer Startup Script Çalışmazsa
Railway'de "Variables" sekmesinde:
```
startCommand = "apache2-foreground"
```

Sonra manuel olarak komutları çalıştırın.

### Eğer Apache Başlamazsa
Railway'de "Variables" sekmesinde:
```
startCommand = "php -S 0.0.0.0:80 -t public"
```

## Yeni Deployment Yaklaşımı

**Artık startup script kullanmıyoruz:**
- ✅ Doğrudan Apache başlatılıyor
- ✅ Daha güvenilir deployment
- ✅ Daha az hata riski
- ✅ Manuel komutlarla kontrol

**Deployment sırası:**
1. **Container başlar** → Apache çalışır
2. **Post-deploy komutları** → Laravel ayarları yapılır
3. **Manuel komutlar** → Gerekirse terminal'den çalıştırılır
