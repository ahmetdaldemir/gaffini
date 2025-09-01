# 🚂 Railway Deployment Checklist

## ✅ Pre-Deployment Hazırlık

### 1. Railway Hesap Ayarları
- [ ] Railway hesabı oluşturuldu: https://railway.app
- [ ] GitHub hesabı Railway ile bağlandı
- [ ] Railway'de yeni proje oluşturuldu

### 2. Proje Dosyaları Kontrolü
- [ ] `Dockerfile.railway` mevcut ve doğru
- [ ] `railway.toml` mevcut ve doğru
- [ ] `docker/start-railway.sh` mevcut ve executable
- [ ] `laravel-app/` klasörü mevcut
- [ ] Tüm değişiklikler commit edildi

### 3. Git Ayarları
- [ ] Proje git repository
- [ ] Railway git remote eklendi
- [ ] Main/master branch'te çalışılıyor

## 🚀 Railway'de Proje Kurulumu

### 1. Proje Oluşturma
1. Railway Dashboard'a gidin: https://railway.app/dashboard
2. "New Project" butonuna tıklayın
3. "Deploy from GitHub repo" seçin
4. Bu repository'yi seçin
5. Proje adını belirleyin (örn: "gaffini-app")

### 2. Veritabanı Ekleme
1. Railway projenizde "New" butonuna tıklayın
2. "Database" seçeneğini seçin
3. "MySQL" veritabanını seçin
4. Veritabanı adını belirleyin (örn: "gaffini-db")

### 3. Environment Variables Kontrolü
Railway otomatik olarak şu değişkenleri sağlayacak:
- [ ] `MYSQLHOST` - Veritabanı host'u
- [ ] `MYSQLPORT` - Veritabanı port'u
- [ ] `MYSQLDATABASE` - Veritabanı adı
- [ ] `MYSQLUSER` - Veritabanı kullanıcı adı
- [ ] `MYSQLPASSWORD` - Veritabanı şifresi

## 🔧 Deployment Süreci

### 1. İlk Deployment
1. Railway'de "Deploy" butonuna tıklayın
2. Build sürecini bekleyin (5-15 dakika)
3. Logları takip edin

### 2. Deployment Sonrası Kontroller
- [ ] Build başarılı mı?
- [ ] Container başladı mı?
- [ ] Health check endpoint'i çalışıyor mu?
- [ ] Veritabanı bağlantısı çalışıyor mu?

### 3. Post-Deploy Komutları
Railway otomatik olarak şu komutları çalıştıracak:
- [ ] `php artisan key:generate --force`
- [ ] `php artisan migrate --force`
- [ ] `php artisan storage:link --force`
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`

## 🧪 Test ve Doğrulama

### 1. Health Check Endpoints
```bash
# Genel sağlık kontrolü
curl https://your-app-name.railway.app/health

# Veritabanı bağlantı testi
curl https://your-app-name.railway.app/db-test
```

### 2. Uygulama Fonksiyonları
- [ ] Ana sayfa yükleniyor mu?
- [ ] Admin paneli çalışıyor mu? (`/admin`)
- [ ] Veritabanı işlemleri çalışıyor mu?
- [ ] Dosya upload'ları çalışıyor mu?

### 3. SSL ve Domain
- [ ] SSL sertifikası aktif mi?
- [ ] Railway domain çalışıyor mu?
- [ ] Özel domain eklenmiş mi? (opsiyonel)

## 🐛 Sorun Giderme

### Veritabanı Bağlantı Hatası
```bash
# Railway terminal'de
php artisan tinker --execute="DB::connection()->getPdo();"
```

### Migration Hatası
```bash
php artisan migrate:status
php artisan migrate --force
```

### Cache Sorunları
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Dosya İzinleri
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## 📊 Monitoring

### Railway Dashboard
- [ ] **Logs**: Hata mesajları var mı?
- [ ] **Metrics**: CPU/Memory kullanımı normal mi?
- [ ] **Health**: Health check başarılı mı?
- [ ] **Deployments**: Son deployment başarılı mı?

### Laravel Logs
```bash
# Railway terminal'de
tail -f storage/logs/laravel.log
```

## 🔄 Güncelleme ve Yeniden Deployment

### 1. Kod Güncellemesi
```bash
# Yerel makinede
git add .
git commit -m "Update message"
git push origin main
```

### 2. Railway Otomatik Deployment
- [ ] Railway otomatik olarak yeni deployment başlatacak
- [ ] Build sürecini bekleyin
- [ ] Logları kontrol edin

## 📞 Destek

### Sorun Durumunda
1. Railway loglarını kontrol edin
2. Laravel loglarını kontrol edin
3. Test endpoint'lerini kullanın
4. Railway support'a başvurun

### Faydalı Linkler
- [Railway Dashboard](https://railway.app/dashboard)
- [Railway Documentation](https://docs.railway.app)
- [Railway Support](https://railway.app/support)

## 🎉 Başarılı Deployment

Tüm kontroller tamamlandığında:
- ✅ Uygulamanız production'da çalışıyor
- ✅ Veritabanı bağlantısı aktif
- ✅ SSL sertifikası aktif
- ✅ Health check başarılı
- ✅ Tüm endpoint'ler çalışıyor

**Tebrikler! Uygulamanız Railway'de başarıyla yayında!** 🚀
