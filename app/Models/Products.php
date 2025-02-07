<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Products
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $slug
 * @property string|null $product_code
 * @property string|null $image
 * @property string|null $location
 * @property string|null $price
 * @property int|null $tax_class
 * @property int|null $stock
 * @property int|null $stok_dus
 * @property int|null $stok_dis_durum
 * @property int|null $kargo
 * @property string $gecerlilik_tarih
 * @property int|null $durum
 * @property int|null $order
 * @property string|null $category_id
 * @property string|null $uretici_id
 * @property string|null $features_id
 * @property string $extra_features_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $one_cikar
 *
 * @property \App\Models\Categories $category
 * @property \App\Models\Manufacturers $manufacturer
 * @property \App\Models\Faetures $feature
 */
class Products extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'slug',
        'product_code',
        'image',
        'location',
        'price',
        'tax_class',
        'stock',
        'stok_dus',
        'stok_dis_durum',
        'kargo',
        'gecerlilik_tarihi',
        'durum',
        'order',
        'category_id',
        'uretici_id',
        'features_id',
        'one_cikar',
        'extra_features_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id')->withDefault([
            'name' => 'Kategori Yok'
        ]);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturers::class, 'uretici_id', 'id')->withDefault([
            'name' => 'Üretici Yok'
        ]);
    }

    public function feature()
    {
        return $this->belongsTo(Faetures::class, 'features_id', 'id')->withDefault([
            'name' => 'Özellik Yok'
        ]);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaigns::class, 'product_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id', 'id');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = \Str::slug($value, '-');
    }


    protected $casts = [
        'price' => 'decimal:2',
        'gecerlilik_tarihi' => 'datetime:Y-m-d',
        'durum' => 'boolean'
    ];
}
