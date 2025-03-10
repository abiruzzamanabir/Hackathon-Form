<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('url')->nullable()->default('https://bbf.digital/cyber-security-summit-2024/');
            $table->string('footer')->nullable()->default('Bangladesh Brand Forum. All rights reserved.');
            $table->dateTime('close')->nullable()->default('2025-03-20 00:00:00');
            $table->string('name')->nullable()->default('AI Hackathon');
            $table->string('amount')->nullable()->default('15000');
            $table->string('logo')->nullable()->default('d0a7d5a0d6f6d2f47b6bc1e53dfd66d9.png');
            $table->string('iconbg')->nullable()->default('e335fecd282caa354269c8c59e119343.png');
            $table->string('background')->nullable()->default('6bcfae89cf18a71c3f0e64a51f0eccd8.jpg');
            $table->string('favicon')->nullable()->default('7e88072e75e25650fbe69d30c3dc8823.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
};
