<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\User;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ana menüyü oluştur
        $mainMenu = Menu::create([
            'name' => 'Ana Menü',
            'slug' => 'main-menu',
            'description' => 'Sitenin ana navigasyon menüsü',
            'is_active' => true,
            'order' => 1,
        ]);

        // Kullanıcı oluştur (eğer yoksa)
        $user = User::firstOrCreate(
            ['email' => 'ahmetdaldemir@gmail.com'],
            [
                'name' => 'Ahmet Daldemir',
                'password' => bcrypt('198711ad'),
            ]
        );

        // Örnek sayfalar oluştur
        $aboutPage = Page::create([
            'title' => 'Hakkımızda',
            'slug' => 'hakkimizda',
            'content' => '<h2>Hakkımızda</h2><p>Gaffini şirketi olarak...</p>',
            'excerpt' => 'Gaffini şirketi hakkında detaylı bilgi',
            'status' => 'published',
            'author_id' => $user->id,
            'published_at' => now(),
            'order' => 1,
        ]);

        $contactPage = Page::create([
            'title' => 'İletişim',
            'slug' => 'iletisim',
            'content' => '<h2>İletişim</h2><p>Bizimle iletişime geçin...</p>',
            'excerpt' => 'İletişim bilgileri ve form',
            'status' => 'published',
            'author_id' => $user->id,
            'published_at' => now(),
            'order' => 2,
        ]);

        // Ana menü öğelerini oluştur
        $aboutMenuItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'title' => 'Hakkımızda',
            'slug' => 'about-us',
            'type' => 'page',
            'page_id' => $aboutPage->id,
            'is_active' => true,
            'order' => 1,
        ]);

        $projectsMenuItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'title' => 'Projeler',
            'slug' => 'projects',
            'type' => 'link',
            'url' => '#',
            'is_active' => true,
            'order' => 2,
        ]);

        // Projeler alt menüleri
        $villasMenuItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $projectsMenuItem->id,
            'title' => 'Villalar',
            'slug' => 'villas',
            'type' => 'link',
            'url' => '/projects/villas',
            'is_active' => true,
            'order' => 1,
        ]);

        $residentialMenuItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $projectsMenuItem->id,
            'title' => 'Konut Projeleri',
            'slug' => 'residential',
            'type' => 'link',
            'url' => '/projects/residential',
            'is_active' => true,
            'order' => 2,
        ]);

        $manufacturingMenuItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'title' => 'Üretim',
            'slug' => 'manufacturing',
            'type' => 'link',
            'url' => '#',
            'is_active' => true,
            'order' => 3,
        ]);

        // Üretim alt menüsü
        $factoryMenuItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $manufacturingMenuItem->id,
            'title' => 'Fabrika',
            'slug' => 'factory',
            'type' => 'link',
            'url' => '/manufacturing/factory',
            'is_active' => true,
            'order' => 1,
        ]);

        $contactMenuItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'title' => 'İletişim',
            'slug' => 'contact',
            'type' => 'page',
            'page_id' => $contactPage->id,
            'is_active' => true,
            'order' => 4,
        ]);
    }
}
