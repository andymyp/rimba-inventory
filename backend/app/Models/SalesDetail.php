<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sales_detail';
    protected $fillable = ['code_transaksi', 'id_item'];
    public $timestamps = false;
}
