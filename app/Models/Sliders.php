<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property string $title;
 * @property string $content;
 * @property string $image;
 * @property int $status;
 * @property int $order;
 * @property string $created_at;
 * @property string $updated_at;
 */

class Sliders extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    protected $fillable = ['title','image','status','order','content'];
}
