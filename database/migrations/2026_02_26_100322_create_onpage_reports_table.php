<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('onpage_reports', function (Blueprint $table) {
        $table->id();
        $table->foreignId('website_id')->constrained()->onDelete('cascade');
        $table->string('url');
        $table->integer('title_length')->nullable();
        $table->integer('meta_length')->nullable();
        $table->integer('h1_count')->nullable();
        $table->integer('h2_count')->nullable();
        $table->integer('image_alt_missing')->nullable();
        $table->integer('internal_links')->nullable();
        $table->integer('seo_score')->nullable();
        $table->date('checked_at');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onpage_reports');
    }
};
