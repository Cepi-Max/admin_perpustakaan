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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('berita_category_id')->constrained('kategori_beritas')->onDelete('cascade');
            $table->string('inovator')->nullable(); // Opsional kalau tidak selalu ada
            $table->longText('body');
            $table->string('image')->nullable(); // Boleh kosong kalau belum upload
            $table->unsignedBigInteger('seen')->default(0); // Gunakan unsigned untuk hitungan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
