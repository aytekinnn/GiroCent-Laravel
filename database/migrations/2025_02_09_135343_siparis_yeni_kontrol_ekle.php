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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('sirket_gorev')->nullable();
            $table->string('maks_taksit_tutar')->nullable();
            $table->string('nufus_kayit_ilce')->nullable();
            $table->string('e_devlet_sifre')->nullable();
            $table->string('ikamet_suresi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('sirket_gorev');
            $table->dropColumn('maks_taksit_tutar');
            $table->dropColumn('nufus_kayit_ilce');
            $table->dropColumn('e_devlet_sifre');
            $table->dropColumn('ikamet_suresi');
        });
    }
};
