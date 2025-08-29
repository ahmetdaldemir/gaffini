<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Genel Ayarlar
            [
                'key' => 'site_title',
                'value' => 'Gaffini',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Başlığı',
                'description' => 'Sitenin ana başlığı',
            ],
            [
                'key' => 'site_description',
                'value' => 'Gaffini şirketi resmi web sitesi',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Açıklaması',
                'description' => 'Sitenin meta açıklaması',
            ],
            [
                'key' => 'site_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'label' => 'Site Logo',
                'description' => 'Sitenin ana logosu',
            ],
            [
                'key' => 'site_favicon',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'label' => 'Favicon',
                'description' => 'Site favicon\'u',
            ],

            // İletişim Bilgileri
            [
                'key' => 'contact_email',
                'value' => 'info@gaffini.com',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'E-posta Adresi',
                'description' => 'İletişim e-posta adresi',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+90 212 123 45 67',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Telefon',
                'description' => 'İletişim telefon numarası',
            ],
            [
                'key' => 'contact_address',
                'value' => 'İstanbul, Türkiye',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Adres',
                'description' => 'Şirket adresi',
            ],

            // Sosyal Medya
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/gaffini',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Facebook',
                'description' => 'Facebook sayfası URL\'si',
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/gaffini',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Twitter',
                'description' => 'Twitter sayfası URL\'si',
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/gaffini',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Instagram',
                'description' => 'Instagram sayfası URL\'si',
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/gaffini',
                'type' => 'text',
                'group' => 'social',
                'label' => 'LinkedIn',
                'description' => 'LinkedIn sayfası URL\'si',
            ],

            // SEO Ayarları
            [
                'key' => 'seo_keywords',
                'value' => 'gaffini, inşaat, proje, villa, konut',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Anahtar Kelimeler',
                'description' => 'Site anahtar kelimeleri',
            ],
            [
                'key' => 'google_analytics',
                'value' => null,
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Google Analytics ID',
                'description' => 'Google Analytics takip kodu',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
