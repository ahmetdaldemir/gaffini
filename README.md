# Gaffini - Laravel CMS with Docker

Modern Laravel CMS uygulaması Docker ile birlikte çalışır.

## 🚀 Hızlı Başlangıç

### Gereksinimler
- Docker
- Docker Compose

### Kurulum

1. **Repo'yu klonlayın:**
```bash
git clone <repository-url>
cd gaffini
```

2. **Docker servislerini başlatın:**
```bash
docker-compose up -d
```

3. **Laravel bağımlılıklarını yükleyin:**
```bash
docker-compose exec php composer install
```

4. **Laravel key oluşturun:**
```bash
docker-compose exec php php artisan key:generate
```

5. **Veritabanı migration'larını çalıştırın:**
```bash
docker-compose exec php php artisan migrate
```

6. **Storage link oluşturun:**
```bash
docker-compose exec php php artisan storage:link
```

## 🌐 Erişim Adresleri

- **Ana Uygulama**: http://localhost:8081
- **Admin Panel**: http://localhost:8081/admin
- **phpMyAdmin**: http://localhost:8080

## 🔐 Admin Giriş Bilgileri

- **Email**: `ahmetdaldemir@gmail.com`
- **Şifre**: `198711ad`

## 📁 Proje Yapısı

```
gaffini/
├── docker/
│   ├── nginx/
│   │   ├── default.conf
│   │   └── nginx.conf
│   └── php/
│       └── Dockerfile
├── laravel-app/
│   ├── app/
│   ├── resources/
│   ├── routes/
│   └── ...
├── docker-compose.yml
└── README.md
```

## 🛠️ Docker Servisleri

- **nginx**: Web sunucusu (Port 8081)
- **php**: PHP-FPM 8.3 (Port 9000)
- **mysql**: MySQL 8.0 (Port 3390)
- **phpmyadmin**: Veritabanı yönetimi (Port 8080)

## 📝 Yararlı Komutlar

```bash
# Servisleri başlatma
docker-compose up -d

# Servisleri durdurma
docker-compose down

# Logları görüntüleme
docker-compose logs -f

# PHP container'ına erişim
docker-compose exec php bash

# Laravel komutları
docker-compose exec php php artisan migrate
docker-compose exec php php artisan cache:clear
docker-compose exec php php artisan config:clear
```

## 🔧 Özellikler

- ✅ Laravel 10
- ✅ Filament Admin Panel
- ✅ MySQL 8.0
- ✅ Nginx
- ✅ PHP 8.3 with FPM
- ✅ Docker Compose
- ✅ Content Management System
- ✅ Menu Management
- ✅ Page Management
- ✅ Slider Management
- ✅ Site Settings

## 🐛 Sorun Giderme

### Port Çakışması
Eğer port 8081 kullanımdaysa, `docker-compose.yml` dosyasında port numarasını değiştirin.

### Veritabanı Bağlantı Sorunu
`.env` dosyasında `DB_HOST=mysql` ve `DB_PORT=3306` olduğundan emin olun.

### Permission Sorunları
```bash
chmod -R 775 laravel-app/storage laravel-app/bootstrap/cache
```

## 📄 Lisans

Bu proje MIT lisansı altında lisanslanmıştır.
