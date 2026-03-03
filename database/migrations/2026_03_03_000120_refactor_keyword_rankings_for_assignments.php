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
        Schema::table('keyword_rankings', function (Blueprint $table) {
            $table->foreignId('keyword_assignment_id')->nullable()->after('id');
            $table->string('search_engine', 50)->default('google')->after('previous_rank');
            $table->string('location', 100)->nullable()->after('search_engine');
            $table->string('device_type', 20)->default('desktop')->after('location');
        });

        // Backfill assignment reference for existing rankings.
        DB::table('keyword_rankings')->orderBy('id')->chunkById(100, function ($rankings) {
            foreach ($rankings as $ranking) {
                $assignmentId = DB::table('keyword_assignments')
                    ->where('keyword_id', $ranking->keyword_id)
                    ->orderBy('id')
                    ->value('id');

                DB::table('keyword_rankings')
                    ->where('id', $ranking->id)
                    ->update(['keyword_assignment_id' => $assignmentId]);
            }
        });

        Schema::table('keyword_rankings', function (Blueprint $table) {
            $table->dropForeign(['keyword_id']);
            $table->dropColumn('keyword_id');
            $table->index(['keyword_assignment_id', 'checked_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keyword_rankings', function (Blueprint $table) {
            $table->foreignId('keyword_id')->nullable()->constrained()->onDelete('cascade');
        });

        DB::table('keyword_rankings')->orderBy('id')->chunkById(100, function ($rankings) {
            foreach ($rankings as $ranking) {
                $keywordId = DB::table('keyword_assignments')
                    ->where('id', $ranking->keyword_assignment_id)
                    ->value('keyword_id');

                DB::table('keyword_rankings')
                    ->where('id', $ranking->id)
                    ->update(['keyword_id' => $keywordId]);
            }
        });

        Schema::table('keyword_rankings', function (Blueprint $table) {
            $table->dropColumn(['keyword_assignment_id', 'search_engine', 'location', 'device_type']);
        });
    }
};
