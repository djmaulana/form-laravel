<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParameterKarat;

class ParameterKaratSeeder extends Seeder
{
    public function run()
    {
        $karats = ['24K', '22K', '18K', '14K'];
        
        foreach ($karats as $karat) {
            ParameterKarat::create(['name' => $karat]);
        }
    }
}
