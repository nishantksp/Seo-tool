<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Backfill assignments from legacy keywords.website_id.
        DB::table('keywords')->orderBy('id')->chunkById(100, function ($keywords) {
            foreach ($keywords as $keyword) {
                DB::table('keyword_assignments')->insert([
                    'website_id' => $keyword->website_id,
                    'keyword_id' => $keyword->id,
                    'target_url' => null,
                    'priority' => null,
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        Schema::table('keywords', function (Blueprint $table) {
            $table->dropForeign(['website_id']);
            $table->dropColumn('website_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keywords', function (Blueprint $table) {
            $table->foreignId('website_id')->nullable()->constrained()->onDelete('cascade');
        });

        // Best-effort rollback: restore website_id using the first assignment per keyword.
        DB::table('keywords')->orderBy('id')->chunkById(100, function ($keywords) {
            foreach ($keywords as $keyword) {
                $websiteId = DB::table('keyword_assignments')
                    ->where('keyword_id', $keyword->id)
                    ->orderBy('id')
                    ->value('website_id');

                DB::table('keywords')
                    ->where('id', $keyword->id)
                    ->update(['website_id' => $websiteId]);
            }
        });
    }
};
