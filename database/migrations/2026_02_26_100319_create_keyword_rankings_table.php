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
    Schema::create('keyword_rankings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('keyword_id')->constrained()->onDelete('cascade');
        $table->integer('rank');
        $table->integer('previous_rank')->nullable();
        $table->date('checked_at');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyword_rankings');
    }
};
