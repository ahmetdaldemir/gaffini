<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Transform Your Space',
                'subtitle' => 'Premium Flooring',
                'description' => 'Vestibulum rhoncus nisl ac gravida porta. Mauris eu sapien lacus. Etiam molestie justo neque, in convallis massa tempus in.',
                'background_image' => 'assets/img/slider/1.jpg',
                'button_text' => 'Our Services',
                'button_url' => '/services',
                'button_target' => '_self',
                'overlay_type' => 'overlay-4',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Florix Flooring: Your Foundation For Style',
                'subtitle' => 'Durable Design',
                'description' => 'Vestibulum rhoncus nisl ac gravida porta. Mauris eu sapien lacus. Etiam molestie justo neque, in convallis massa tempus in.',
                'background_image' => 'assets/img/slider/2.jpg',
                'button_text' => 'Our Services',
                'button_url' => '/services',
                'button_target' => '_self',
                'overlay_type' => 'overlay-5',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Your Dream Floors, Our Expert Installation',
                'subtitle' => 'Durable Design',
                'description' => 'Vestibulum rhoncus nisl ac gravida porta. Mauris eu sapien lacus. Etiam molestie justo neque, in convallis massa tempus in.',
                'background_image' => 'assets/img/slider/3-1.jpg',
                'button_text' => 'Our Services',
                'button_url' => '/services',
                'button_target' => '_self',
                'overlay_type' => 'overlay-4',
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::firstOrCreate(
                ['title' => $slider['title']],
                $slider
            );
        }
    }
}
