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
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->smallInteger('release_flag')->default(0)->after('post_category_id')->comment('リリースフラグ　0->未リリース：1->リリース済み');
            $table->string('main_image')->nullable()->after('description')->comment('画像ファイルURL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dropColumn('release_flag');
            $table->dropColumn('main_image');
        });
    }
};
