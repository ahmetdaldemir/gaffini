# 🚀 Deployment Rehberi

Bu projeyi farklı platformlarda yayınlamak için rehberler.

## 🎯 Railway (Önerilen)

### 1. Railway Hesabı Oluşturun
- [Railway.app](https://railway.app) adresine gidin
- GitHub ile giriş yapın

### 2. Projeyi Deploy Edin
```bash
# Railway CLI kurulumu
npm install -g @railway/cli

# Giriş yapın
railway login

# Projeyi başlatın
railway init

# Deploy edin
railway up
```

### 3. Environment Variables Ayarlayın
Railway dashboard'da şu değişkenleri ekleyin:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app
APP_KEY=base64:your-app-key-here
DB_CONNECTION=mysql
DB_HOST=your-mysql-host
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

### 4. Veritabanı Ekleme
- Railway dashboard'da "New Service" → "Database" → "MySQL"
- Environment variables'da DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD güncelleyin

## 🌐 Vercel

### 1. Vercel Hesabı Oluşturun
- [Vercel.com](https://vercel.com) adresine gidin
- GitHub ile giriş yapın

### 2. Projeyi Import Edin
- "New Project" → GitHub repo'nuzu seçin
- Framework Preset: "Other"
- Build Command: `composer install --no-dev`
- Output Directory: `laravel-app/public`

### 3. Environment Variables
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.vercel.app
APP_KEY=base64:your-app-key-here
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

## ☁️ DigitalOcean App Platform

### 1. DigitalOcean Hesabı Oluşturun
- [DigitalOcean.com](https://digitalocean.com) adresine gidin

### 2. App Platform'da Yeni Uygulama
- "Create App" → "Source Code" → GitHub repo'nuzu seçin
- Environment: "Docker"
- Build Command: `docker build -t app .`
- Run Command: `docker run -p 80:80 app`

### 3. Database Ekleme
- "Create Database" → "MySQL"
- Environment variables'da veritabanı bilgilerini güncelleyin

## 🐳 Docker ile Manuel Deployment

### 1. Server'a Docker Kurulumu
```bash
# Ubuntu/Debian
curl -fsSL https://get.docker.com -o get-docker.sh
sh get-docker.sh

# Docker Compose kurulumu
sudo curl -L "https://github.com/docker/compose/releases/download/v2.20.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

### 2. Projeyi Server'a Kopyalayın
```bash
git clone https://github.com/your-username/gaffini.git
cd gaffini
```

### 3. Environment Dosyası Oluşturun
```bash
cp laravel-app/.env.example laravel-app/.env
# .env dosyasını düzenleyin
```

### 4. Deploy Edin
```bash
docker-compose up -d
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate
docker-compose exec php php artisan storage:link
```

## 🔧 Ortak Adımlar

### 1. Laravel Key Oluşturma
```bash
php artisan key:generate
```

### 2. Veritabanı Migration
```bash
php artisan migrate
```

### 3. Storage Link
```bash
php artisan storage:link
```

### 4. Cache Temizleme
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 🛡️ Güvenlik

### Production Environment
- `APP_DEBUG=false`
- `APP_ENV=production`
- Güçlü `APP_KEY`
- Güvenli veritabanı şifreleri
- HTTPS kullanımı

### SSL Sertifikası
- Railway: Otomatik
- Vercel: Otomatik
- DigitalOcean: Let's Encrypt
- Manuel: Certbot

## 📊 Monitoring

### Health Check
```bash
curl https://your-app-url.com/health
```

### Log Monitoring
- Railway: Built-in logs
- Vercel: Function logs
- DigitalOcean: App logs

## 💰 Maliyet Karşılaştırması

| Platform | Başlangıç Fiyatı | Özellikler |
|----------|------------------|------------|
| Railway | $5/ay | Docker, DB dahil |
| Vercel | $20/ay | Serverless, CDN |
| DigitalOcean | $5/ay | VPS, tam kontrol |
| Heroku | $7/ay | PaaS, kolay kullanım |
| AWS | Değişken | Enterprise |

## 🎯 Önerilen Platform

**Railway** bu proje için en uygun seçenek çünkü:
- ✅ Docker desteği
- ✅ MySQL veritabanı dahil
- ✅ Kolay deployment
- ✅ Makul fiyat
- ✅ Otomatik SSL
- ✅ GitHub entegrasyonu
