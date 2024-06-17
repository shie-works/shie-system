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
        Schema::create('post_details', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id')->comment('postテーブルのid');
            $table->string('sub_title')->comment('見出し');
            $table->text('text')->nullable()->comment('内容');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_details');
    }
};
