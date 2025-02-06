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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 75)->nullable();
            $table->text('description')->nullable();
            $table->string('slug', 75)->nullable();
            $table->string('product_code', 100)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('location', 75)->nullable();
            $table->integer('price')->nullable();
            $table->integer('tax_class')->nullable()->comment('0: %10, 1: %20');
            $table->integer('stock')->nullable();
            $table->integer('stok_dus')->nullable()->comment('satış oldukça stoktan düş 0,1');
            $table->integer('stok_dis_durum')->nullable()->comment('0: 2-3 Gün içinde, 1: ön sipariş, 2: stokta var, 3: stokta yok');
            $table->integer('kargo')->nullable()->comment('0: kargo yok, 1: kargo var');
            $table->date('gecerlilik_tarih')->nullable()->comment('Ürün son satış tarihi');
            $table->integer('durum')->nullable()->comment('0: pasif, 1: aktif');
            $table->integer('order')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('uretici_id')->nullable();
            $table->integer('feaures_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
