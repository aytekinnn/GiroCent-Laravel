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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('tc')->nullable();
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            $table->string('ulke')->nullable();
            $table->string('sehir')->nullable();
            $table->string('ilce')->nullable();
            $table->string('posta_kodu')->nullable();
            $table->integer('icraDosya')->nullable();
            $table->integer('calismaSuresi')->nullable();
            $table->integer('aylikGelir')->nullable();
            $table->integer('malVarligi')->nullable();
            $table->dateTime('dogum')->nullable();
            $table->string('medeni_durum')->nullable();
            $table->integer('evDurum')->nullable();
            $table->integer('sgkDurum')->nullable();
            $table->string('baglanti')->nullable();
            $table->string('baglantiTelefon')->nullable();
            $table->text('message')->nullable();
            $table->integer('status')->default(1);
            $table->integer('taksit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
