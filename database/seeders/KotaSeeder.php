<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Kota;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Kota::truncate();
        $csvFile = fopen(base_path('database/csvs/kabupaten_kota.csv'), 'r');
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if (! $firstline) {
                Kota::create([
                    'id'   => $data['0'],
                    'nama' => $data['1'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
