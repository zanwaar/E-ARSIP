<?php

namespace Database\Seeders;

use App\Models\Disposisi;
use App\Models\FileDokument;
use App\Models\Jabatan;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $jabatans = [
            ['alias' => 'KADIS', 'name' => 'Kepala Dinas', 'bidang_id' => 1, 'user_id' => 3],
            ['alias' => 'SUBKABIB', 'name' => 'Kepala', 'bidang_id' => 2, 'user_id' => 4],
            ['alias' => 'SUBKABIB', 'name' => 'Kepala', 'bidang_id' => 3, 'user_id' => 7],
            ['alias' => 'KASI', 'name' => 'Kepala Seksi', 'bidang_id' => 2, 'user_id' => 5],
            ['alias' => 'STAFFBAGIAN', 'name' => 'Staff', 'bidang_id' => 2, 'user_id' => 6],
            ['alias' => 'STAFFBAGIAN', 'name' => 'Staff', 'bidang_id' => 2, 'user_id' => 8],
            ['alias' => 'STAFFBAGIAN', 'name' => 'Staff', 'bidang_id' => 2, 'user_id' => 9],
            ['alias' => 'STAFFBAGIAN', 'name' => 'Staff', 'bidang_id' => 2, 'user_id' => 10],
            ['alias' => 'KASI', 'name' => 'Kepala Seksi', 'bidang_id' => 3, 'user_id' => 11],
            ['alias' => 'STAFFBAGIAN', 'name' => 'Staff', 'bidang_id' => 3, 'user_id' => 12],
            ['alias' => 'STAFFBAGIAN', 'name' => 'Staff', 'bidang_id' => 3, 'user_id' => 13],
            // Tambahkan jabatan lainnya sesuai kebutuhan
        ];

        foreach ($jabatans as $jabatan) {
            Jabatan::create($jabatan);
        }


        // Create surat masuk
        $suratMasuks2 = [
            ['nomor_surat' => '010/SM/2024', 'pengirim' => 'Sophia Harris', 'tanggal_masuk' => '2024-07-10', 'perihal' => 'Undangan Seminar'],
            ['nomor_surat' => '009/SM/2024', 'pengirim' => 'Daniel Lee', 'tanggal_masuk' => '2024-07-09', 'perihal' => 'Permintaan Penawaran'],
            ['nomor_surat' => '008/SM/2024', 'pengirim' => 'Olivia Taylor', 'tanggal_masuk' => '2024-07-08', 'perihal' => 'Permohonan Sponsorship'],
            ['nomor_surat' => '007/SM/2024', 'pengirim' => 'Chris Martin', 'tanggal_masuk' => '2024-07-07', 'perihal' => 'Pengaduan Pelanggan'],
            ['nomor_surat' => '006/SM/2024', 'pengirim' => 'Sarah Wilson', 'tanggal_masuk' => '2024-07-06', 'perihal' => 'Permintaan Kerjasama'],

        ];
        $suratMasuks3 = [
            ['nomor_surat' => '005/SM/2024', 'pengirim' => 'David Brown', 'tanggal_masuk' => '2024-07-05', 'perihal' => 'Konfirmasi Pembayaran'],
            ['nomor_surat' => '004/SM/2024', 'pengirim' => 'Emily Davis', 'tanggal_masuk' => '2024-07-04', 'perihal' => 'Laporan Tahunan'],
            ['nomor_surat' => '003/SM/2024', 'pengirim' => 'John Doe', 'tanggal_masuk' => '2024-07-01', 'perihal' => 'Permohonan Informasi'],
            ['nomor_surat' => '002/SM/2024', 'pengirim' => 'Jane Smith', 'tanggal_masuk' => '2024-07-02', 'perihal' => 'Undangan Rapat'],
            ['nomor_surat' => '001/SM/2024', 'pengirim' => 'Michael Johnson', 'tanggal_masuk' => '2024-07-03', 'perihal' => 'Pengajuan Proposal'],
        ];

        foreach ($suratMasuks2 as $data) {
            $suratMasuk = SuratMasuk::create($data);
            FileDokument::create([
                'dokument_id' => $suratMasuk->id,
                'dokument' => 'SURAT MASUK',
                'file' => $suratMasuk->nomor_surat . '_' . $faker->word . '_' . $faker->numberBetween(1000, 9999) . '.pdf',
                'size' => $faker->numberBetween(10, 999) . ' KB'
            ]);
        }
        foreach ($suratMasuks3 as $data) {
            $suratMasuk = SuratMasuk::create($data);
            FileDokument::create([
                'dokument_id' => $suratMasuk->id,
                'dokument' => 'SURAT MASUK',
                'file' => $suratMasuk->nomor_surat . '_' . $faker->word . '_' . $faker->numberBetween(1000, 9999) . '.pdf',
                'size' => $faker->numberBetween(10, 999) . ' KB'
            ]);
        }

        // Create surat keluar
        $suratKeluars = [
            ['nomor_surat' => '013/SK/2024', 'penerima' => 'Company L', 'tanggal_keluar' => '2024-07-09', 'perihal' => 'Konfirmasi Pesanan'],
            ['nomor_surat' => '012/SK/2024', 'penerima' => 'Company K', 'tanggal_keluar' => '2024-07-09', 'perihal' => 'Penawaran Jasa'],
            ['nomor_surat' => '011/SK/2024', 'penerima' => 'Company J', 'tanggal_keluar' => '2024-07-08', 'perihal' => 'Pemberitahuan'],
            ['nomor_surat' => '010/SK/2024', 'penerima' => 'Company I', 'tanggal_keluar' => '2024-07-08', 'perihal' => 'Konfirmasi Pembayaran'],
            ['nomor_surat' => '009/SK/2024', 'penerima' => 'Company H', 'tanggal_keluar' => '2024-07-07', 'perihal' => 'Pengiriman Dokumen'],
            ['nomor_surat' => '008/SK/2024', 'penerima' => 'Company G', 'tanggal_keluar' => '2024-07-07', 'perihal' => 'Undangan Rapat'],
            ['nomor_surat' => '007/SK/2024', 'penerima' => 'Company F', 'tanggal_keluar' => '2024-07-06', 'perihal' => 'Pemberitahuan Acara'],
            ['nomor_surat' => '006/SK/2024', 'penerima' => 'Company E', 'tanggal_keluar' => '2024-07-06', 'perihal' => 'Konfirmasi Pengiriman'],
            ['nomor_surat' => '005/SK/2024', 'penerima' => 'Company D', 'tanggal_keluar' => '2024-07-05', 'perihal' => 'Permohonan Kerjasama'],
            ['nomor_surat' => '004/SK/2024', 'penerima' => 'Company C', 'tanggal_keluar' => '2024-07-05', 'perihal' => 'Pemberitahuan'],
        ];

        // Offset untuk ID yang dimulai dari 11
        $offset = 11;

        foreach ($suratKeluars as $index => $suratKeluar) {
            $surat = SuratKeluar::create($suratKeluar);
            // $surat = SuratKeluar::create(array_merge($suratKeluar, ['id' => $offset + $index]));
            FileDokument::create([
                'dokument_id' => $surat->id,
                'dokument' => 'SURAT KELUAR',
                'file' => $surat->nomor_surat . '_' . $faker->word . '_' . $faker->numberBetween(1000, 9999) . '.pdf',
                'size' => $faker->numberBetween(10, 999) . ' KB',

            ]);
        }


        // Create disposisi surat masuk
        Disposisi::create(['surat_masuk_id' => 1, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        Disposisi::create(['surat_masuk_id' => 2, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        Disposisi::create(['surat_masuk_id' => 3, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        Disposisi::create(['surat_masuk_id' => 4, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        Disposisi::create(['surat_masuk_id' => 5, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        Disposisi::create(['surat_masuk_id' => 6, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        Disposisi::create(['surat_masuk_id' => 7, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        Disposisi::create(['surat_masuk_id' => 8, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        Disposisi::create(['surat_masuk_id' => 9, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        Disposisi::create(['surat_masuk_id' => 10, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);

        $disposisiMessages = [
            'Harap ditindaklanjuti segera.',
            'Mohon diperiksa dan dilaporkan hasilnya.',
            'Segera buat laporan tertulis.',
            'Harap diselesaikan dalam waktu 2 hari.',
            'Tolong koordinasikan dengan bagian terkait.',
            'Cek ulang dan beri rekomendasi.',
            'Lakukan tindakan sesuai prosedur.',
            'Pastikan semua berkas sudah lengkap.',
            'Segera ajukan untuk persetujuan.',
            'Buat jadwal rapat untuk membahas ini.',
            'Harap diverifikasi kembali.',
            'Mohon segera ditindaklanjuti.',
            'Buat laporan lengkap dan komprehensif.',
            'Ajukan ke bagian terkait untuk validasi.',
            'Pastikan semua persyaratan telah dipenuhi.',
            'Koordinasikan dengan tim terkait.',
            'Harap ditinjau ulang dan dilaporkan.',
            'Tindak lanjuti dengan segera dan tepat.',
            'Buat rencana tindakan dan laporkan.',
            'Kumpulkan data pendukung secepatnya.',
            'Lakukan analisis mendalam dan laporkan.',
            'Segera hubungi pihak terkait untuk klarifikasi.',
            'Buat draft laporan dan ajukan untuk review.',
            'Pastikan tidak ada kesalahan dalam berkas.',
            'Lakukan follow-up dengan segera.'
        ];

        // Create disposisi kadis ke kabib
        for ($i = 1; $i <= 5; $i++) {
            Disposisi::create([
                'surat_masuk_id' => $i,
                'user_id' => 4,
                'is_read' => true,
                'isi_disposisi' => $faker->randomElement($disposisiMessages)
            ]);
        }

        // Create disposisi kabab ke kasi Kepegawaian id 5
        for ($i = 1; $i <= 5; $i++) {
            Disposisi::create([
                'surat_masuk_id' => $i,
                'user_id' => 5,
                'is_read' => true,
                'isi_disposisi' => $faker->randomElement($disposisiMessages)
            ]);
        }

        // Create disposisi kasi ke staff Kepegawaian id 6
        for ($i = 1; $i <= 2; $i++) {
            Disposisi::create([
                'surat_masuk_id' => $i,
                'user_id' => 6,
                'bidang_id' => 2,
                'is_read' => true,
                'isi_disposisi' => $faker->randomElement($disposisiMessages)
            ]);
        }

        // Create disposisi kadis ke kabib keuangan id 7
        for ($i = 6; $i <= 10; $i++) {
            Disposisi::create([
                'surat_masuk_id' => $i,
                'user_id' => 7,
                'is_read' => true,
                'isi_disposisi' => $faker->randomElement($disposisiMessages)
            ]);
        }

        // Create disposisi kabib ke kasi keuangan id 11
        for ($i = 6; $i <= 10; $i++) {
            Disposisi::create([
                'surat_masuk_id' => $i,
                'user_id' => 11,
                'is_read' => true,
                'isi_disposisi' => $faker->randomElement($disposisiMessages)
            ]);
        }

        // Create disposisi kasi ke staff keuangan id 12
        // for ($i = 6; $i <= 10; $i++) {
        //     Disposisi::create([
        //         'surat_masuk_id' => $i,
        //         'user_id' => 12,
        //         'bidang_id' => 3,
        //         'is_read' => true,
        //         'isi_disposisi' => $faker->randomElement($disposisiMessages)
        //     ]);
        // }
        // // Create disposisi kasi ke staff Kepegawaian id 6
        // for ($i = 1; $i <= 10; $i++) {
        //     FileDokument::create([
        //         'dokument' => 'DOKUMENT',
        //         'file' => 'DOKUMENT_' . $faker->word . '_' . $faker->numberBetween(1000, 9999) . '.pdf',
        //         'size' => $faker->numberBetween(10, 999) . ' KB'
        //     ]);
        // }
    }
}
