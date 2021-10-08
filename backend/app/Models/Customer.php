<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_customer';
    protected $fillable = ['nama', 'contact', 'email', 'alamat', 'diskon', 'tipe_diskon', 'ktp'];
    public $timestamps = false;
}
