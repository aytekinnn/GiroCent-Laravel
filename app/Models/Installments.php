<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $order_id
 * @property int user_id
 * @property int $taksit_no
 * @property string $amount
 * @property string $due_date
 * @property int $status
 */
class Installments extends Model
{
    use HasFactory;
    protected $table = 'installments';
    protected $fillable = ['order_id', 'user_id', 'taksit_no', 'amount', 'due_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
