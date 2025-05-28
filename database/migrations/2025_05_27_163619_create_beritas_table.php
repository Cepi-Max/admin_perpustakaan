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
            $table->foreignId('author_id')->constrained(
                table: 'users',
                indexName: 'berita_author_id' 
            )->onDelete('cascade');
            $table->foreignId('berita_category_id')->constrained(
                table: 'kategori_beritas',
                indexName: 'berita_category_id' 
            );
            $table->string('inovator');
            $table->longText('body');
            $table->string('image');
            $table->integer('seen')->default(0);;
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
