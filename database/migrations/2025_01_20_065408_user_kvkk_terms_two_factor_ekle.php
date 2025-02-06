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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('kvkk')->nullable();
            $table->integer('terms')->nullable();
            $table->string('image')->nullable();
            $table->string('two_factor_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('kvkk');
            $table->dropColumn('terms');
            $table->dropColumn('image');
            $table->dropColumn('two_factor_code');
        });
    }
};
