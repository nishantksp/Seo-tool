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
    Schema::create('backlinks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('website_id')->constrained()->onDelete('cascade');
        $table->string('source_url');
        $table->string('anchor_text')->nullable();
        $table->enum('link_type', ['dofollow', 'nofollow'])->default('dofollow');
        $table->integer('da')->nullable();
        $table->enum('status', ['active', 'lost'])->default('active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backlinks');
    }
};
