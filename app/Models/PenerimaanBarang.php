<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar', 'barang', 'surat', 'supplier', 'tanggal', 'totalBeratReal', 'totalBeratKotor', 'timbangan', 'selisih', 'catatan', 'pembayaran', 'harga_beli', 'jatuh_tempo', 'nama_pengirim', 'pic'
    ];

    public function details()
    {
        return $this->hasMany(PenerimaanBarangDetail::class);
    }
}
