<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataUangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => 'IDR', 'nama' => 'Rupiah Indonesia'],
            ['kode' => 'USD', 'nama' => 'Dolar Amerika'],
        ];

        DB::table('mata_uang')->insert($data);
    }
}
