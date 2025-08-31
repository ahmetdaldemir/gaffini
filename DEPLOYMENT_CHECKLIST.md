# Railway Deployment Checklist

## ✅ Pre-Deployment Checklist

### 1. Railway Proje Ayarları
- [ ] Railway'de yeni proje oluşturuldu
- [ ] GitHub repository bağlandı
- [ ] MySQL veritabanı eklendi
- [ ] Environment variables ayarlandı

### 2. Environment Variables Kontrolü
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL=https://your-app-name.railway.app`
- [ ] `DB_CONNECTION=mysql`
- [ ] `DB_HOST=${MYSQLHOST}`
- [ ] `DB_PORT=${MYSQLPORT}`
- [ ] `DB_DATABASE=${MYSQLDATABASE}`
- [ ] `DB_USERNAME=${MYSQLUSER}`
- [ ] `DB_PASSWORD=${MYSQLPASSWORD}`

### 3. Dosya Kontrolleri
- [ ] `Dockerfile.railway` mevcut
- [ ] `docker/start-railway.sh` mevcut ve executable
- [ ] `railway.toml` doğru yapılandırılmış
- [ ] Laravel app klasörü mevcut

## 🚀 Deployment Adımları

### 1. İlk Deployment
1. Railway'de "Deploy" butonuna tıklayın
2. Build sürecini bekleyin (5-10 dakika)
3. Logları kontrol edin

### 2. Deployment Sonrası Kontroller
- [ ] Build başarılı mı?
- [ ] Veritabanı bağlantısı çalışıyor mu?
- [ ] Migration'lar çalıştı mı?
- [ ] APP_KEY oluşturuldu mu?

## 🔍 Test Endpoints

### Health Check
```bash
curl https://your-app-name.railway.app/health
```
**Beklenen Yanıt:**
```json
{
  "status": "OK",
  "timestamp": "2024-01-01T00:00:00.000000Z"
}
```

### Database Test
```bash
curl https://your-app-name.railway.app/db-test
```
**Beklenen Yanıt:**
```json
{
  "status": "OK",
  "database": "Connected",
  "connection": "mysql",
  "timestamp": "2024-01-01T00:00:00.000000Z"
}
```

## 🐛 Sorun Giderme

### Veritabanı Bağlantı Hatası
```bash
# Railway terminal'de çalıştırın
php artisan tinker --execute="DB::connection()->getPdo();"
```

### Migration Durumu Kontrolü
```bash
php artisan migrate:status
```

### Cache Temizleme
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### APP_KEY Kontrolü
```bash
php artisan tinker --execute="echo config('app.key');"
```

## 📊 Monitoring

### Railway Dashboard'da Kontrol Edilecekler
- [ ] **Logs**: Hata mesajları var mı?
- [ ] **Metrics**: CPU/Memory kullanımı normal mi?
- [ ] **Health**: Health check başarılı mı?
- [ ] **Deployments**: Son deployment başarılı mı?

### Laravel Log Kontrolü
```bash
# Railway terminal'de
tail -f storage/logs/laravel.log
```

## 🔧 Manuel Komutlar

### Gerekirse Manuel Migration
```bash
php artisan migrate --force
```

### Gerekirse Manuel Seeder
```bash
php artisan db:seed --force
```

### Storage Link Yeniden Oluşturma
```bash
php artisan storage:link --force
```

## ✅ Final Kontroller

### Uygulama Fonksiyonları
- [ ] Ana sayfa yükleniyor mu?
- [ ] Admin paneli çalışıyor mu? (`/admin`)
- [ ] Veritabanı işlemleri çalışıyor mu?
- [ ] Dosya upload'ları çalışıyor mu?
- [ ] SSL sertifikası aktif mi?

### Performance Kontrolleri
- [ ] Sayfa yükleme süreleri kabul edilebilir mi?
- [ ] Veritabanı sorguları optimize mi?
- [ ] Cache sistemi çalışıyor mu?

## 📞 Destek

Eğer sorun yaşıyorsanız:
1. Railway loglarını kontrol edin
2. Laravel loglarını kontrol edin
3. Test endpoint'lerini kullanın
4. Railway support'a başvurun

## 🎉 Başarılı Deployment

Tüm kontroller tamamlandığında uygulamanız production'da çalışıyor demektir!
