<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'ust_id',
        'deleted_at',
        'status',
        'order',
        'popular_category',
        'icon'
    ];

    public function subCategories()
    {
        return $this->hasMany(Categories::class, 'ust_id');
    }

    // Üst kategoriye ait bilgileri almak için ilişki
    public function parentCategory()
    {
        return $this->belongsTo(Categories::class, 'ust_id');
    }
}
