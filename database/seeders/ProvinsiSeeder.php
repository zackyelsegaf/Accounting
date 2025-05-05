<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Provinsi;
use Flynsarmy\CsvSeeder\CsvSeeder;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Provinsi::truncate();
        $csvFile = fopen(base_path('database/csvs/provinsi.csv'), 'r');
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if (! $firstline) {
                Provinsi::create([
                    'id'   => $data['0'],
                    'nama' => $data['1'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
