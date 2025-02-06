<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faetures extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'features';
    protected $fillable = ['name', 'ust_id', 'status'];


}
