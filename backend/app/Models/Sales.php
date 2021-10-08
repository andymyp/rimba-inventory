<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $primaryKey = 'code_transaksi';
    protected $fillable = ['tanggal_transaksi', 'id_customer', 'total_diskon', 'total_harga', 'total_bayar'];
    public $timestamps = false;
}
