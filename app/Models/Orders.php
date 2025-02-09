<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $int
 * @property int $user_id
 * @property string $phone
 * @property string $tc
 * @property string $company_name
 * @property string $address
 * @property string $ulke
 * @property string $sehir
 * @property string $ilce
 * @property string $posta_kodu
 * @property int $icraDosya
 * @property int $calismaSuresi
 * @property int $aylikGelir
 * @property int $malVarligi
 * @property string $dogum
 * @property string $medeni_durum
 * @property int $evDurum
 * @property int $sgkDurum
 * @property string $baglanti
 * @property string $baglantiTelefon
 * @property string $message
 * @property int $status
 * @property string $taksit
 * @property string $cartId
 * @property string $adet
 * @property string $sirket_gorev
 * @property string $maks_taksit_tutar
 * @property string $nufus_kayit_ilce
 * @property string $e_devlet_sifre
 * @property string ikamet_suresi
 */
class Orders extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'phone',
        'tc',
        'company_name',
        'address',
        'ulke',
        'sehir',
        'ilce',
        'posta_kodu',
        'icraDosya',
        'calismaSuresi',
        'aylikGelir',
        'malVarligi',
        'dogum',
        'medeni_durum',
        'evDurum',
        'sgkDurum',
        'baglanti',
        'baglantiTelefon',
        'message',
        'status',
        'taksit',
        'cartId',
        'adet',
        'sirket_gorev',
        'maks_taksit_tutar',
        'nufus_kayit_ilce',
        'e_devlet_sifre',
        'ikamet_suresi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
