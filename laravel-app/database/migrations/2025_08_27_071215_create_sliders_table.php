<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Ana başlık
            $table->string('subtitle')->nullable(); // Alt başlık
            $table->text('description')->nullable(); // Açıklama
            $table->string('background_image'); // Arka plan görseli
            $table->string('button_text')->nullable(); // Buton metni
            $table->string('button_url')->nullable(); // Buton URL'i
            $table->string('button_target')->default('_self'); // Buton hedefi
            $table->enum('overlay_type', ['overlay-4', 'overlay-5', 'none'])->default('overlay-4'); // Overlay türü
            $table->boolean('is_active')->default(true); // Aktif/Pasif
            $table->integer('order')->default(0); // Sıralama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
