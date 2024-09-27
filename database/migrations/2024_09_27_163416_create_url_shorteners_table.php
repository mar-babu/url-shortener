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
        if (!Schema::hasTable('url_shorteners')) {
            Schema::create('url_shorteners', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->string('name')->nullable();
                $table->string('shorten_url');
                $table->longText('original_url');
                $table->integer('click_count')->default(0);
                $table->timestamps();

                $table->index('user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('url_shorteners')) {
            Schema::dropIfExists('url_shorteners');
        }
    }
};
