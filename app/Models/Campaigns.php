<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $product_id
 * @property string $start_date
 * @property string $end_date
 * @property string $discount
 * @property string $new_price
 */

class Campaigns extends Model
{
    use HasFactory;

    protected $table = 'campaigns';
    protected $fillable = ['name', 'discount', 'product_id','new_price','start_date', 'end_date', 'status','content'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id')->withDefault(['name' => 'Ürün Yok']);
    }
}
