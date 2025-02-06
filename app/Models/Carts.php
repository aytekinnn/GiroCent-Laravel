<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property string $name
 * @property string $price
 * @property integer $quantity
 * @property string $image
 * @property string $created_at
 * @property string $deleted_at
 * @property integer $campaigns
 * @property string $extra_features_id
 */

class Carts extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = ['user_id', 'product_id', 'name', 'price', 'quantity', 'image','campaigns','extra_features_id'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
