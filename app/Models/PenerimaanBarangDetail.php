<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanBarangDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'penerimaan_barang_id', 'karat', 'berat_real', 'berat_kotor'
    ];

    public function penerimaanBarang()
    {
        return $this->belongsTo(PenerimaanBarang::class);
    }
}
