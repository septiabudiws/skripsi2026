<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $guarded = ['id'];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'transaksi_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
