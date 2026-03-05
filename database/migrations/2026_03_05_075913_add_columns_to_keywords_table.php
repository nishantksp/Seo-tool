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
        Schema::table('keywords', function (Blueprint $table) {
            //
            $table->string('intent',50)->nullable()->after('difficulty');
            $table->string('language')->default('en')->after('intent');
            $table->string('country')->nullable()->after('language');
        
            $table->decimal('cpc', 8, 2)->nullable()->after('country');

            $table->unsignedBigInteger('competition')->nullable()->after('cpc');
            $table->boolean('is_branded')->default(false)->after('competition');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keywords', function (Blueprint $table) {
            //
            $table->dropColumn([
                'intent',
                'language',
                'country',
                'cpc',
                'competition',
                'is_branded',
            ]);
        });
    }
};
