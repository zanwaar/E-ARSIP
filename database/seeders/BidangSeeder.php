<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidangs = [
            ['name' => 'Kepala Dinas'],
            ['name' => 'Bidang Kepegawaian'],
            ['name' => 'Bidang Keuangan'],
            ['name' => 'Bidang Umum'],
            ['name' => 'Bidang Teknologi Informasi'],
            ['name' => 'Bidang Hukum'],
            ['name' => 'Bidang Kesehatan'],
            ['name' => 'Bidang Pendidikan'],
            ['name' => 'Bidang Pariwisata'],
            ['name' => 'Bidang Pertanian'],
            ['name' => 'Bidang Perindustrian'],
        ];

        foreach ($bidangs as $bidang) {
            Bidang::create($bidang);
        }
    }
}
