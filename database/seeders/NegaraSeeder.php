<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Negara;


class NegaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Negara::truncate();
        $csvFile = fopen(base_path('database/csvs/countries.csv'), 'r');
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if (! $firstline) {
                Negara::create([
                    'id'   => $data['0'],
                    'nama' => $data['1'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
