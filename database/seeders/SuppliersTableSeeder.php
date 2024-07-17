<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'Supplier A',
                'email' => 'supplierA@example.com',
                'phone' => '123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Supplier B',
                'email' => 'supplierB@example.com',
                'phone' => '987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data supplier lainnya sesuai kebutuhan
        ]);
    }
}
