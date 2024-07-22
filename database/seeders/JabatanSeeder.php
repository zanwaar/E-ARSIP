<?php

namespace Database\Seeders;

use App\Models\Disposisi;
use App\Models\FileDokument;
use App\Models\Jabatan;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatans = [
            ['alias' => 'Kadis', 'name' => 'Kepala Dinas', 'bidang_id' => 1, 'user_id' => 3],
            ['alias' => 'Kabib', 'name' => 'Kepala', 'bidang_id' => 2, 'user_id' => 4],
            ['alias' => 'Kabib', 'name' => 'Kepala', 'bidang_id' => 3, 'user_id' => 7],
            ['alias' => 'Kasi', 'name' => 'Kepala Seksi', 'bidang_id' => 2, 'user_id' => 5],
            ['alias' => 'Staff', 'name' => 'Staff', 'bidang_id' => 2, 'user_id' => 6],
            ['alias' => 'Staff', 'name' => 'Staff', 'bidang_id' => 2, 'user_id' => 8],
            ['alias' => 'Staff', 'name' => 'Staff', 'bidang_id' => 2, 'user_id' => 9],
            ['alias' => 'Staff', 'name' => 'Staff', 'bidang_id' => 2, 'user_id' => 10],
            // Tambahkan jabatan lainnya sesuai kebutuhan
        ];

        foreach ($jabatans as $jabatan) {
            Jabatan::create($jabatan);
        }

        // Create surat masuk
        // $suratMasuks = [
        //     // ['nomor_surat' => '003/SM/2024', 'pengirim' => 'John Doe', 'tanggal_masuk' => '2024-07-01', 'perihal' => 'Permohonan Informasi'],
        //     ['nomor_surat' => '002/SM/2024', 'pengirim' => 'Jane Smith', 'tanggal_masuk' => '2024-07-02', 'perihal' => 'Undangan Rapat'],
        //     ['nomor_surat' => '001/SM/2024', 'pengirim' => 'Michael Johnson', 'tanggal_masuk' => '2024-07-03', 'perihal' => 'Pengajuan Proposal'],
        //     // ['nomor_surat' => '004/SM/2024', 'pengirim' => 'Emily Davis', 'tanggal_masuk' => '2024-07-04', 'perihal' => 'Laporan Tahunan'],
        //     // ['nomor_surat' => '005/SM/2024', 'pengirim' => 'David Brown', 'tanggal_masuk' => '2024-07-05', 'perihal' => 'Konfirmasi Pembayaran'],
        //     // ['nomor_surat' => '006/SM/2024', 'pengirim' => 'Sarah Wilson', 'tanggal_masuk' => '2024-07-06', 'perihal' => 'Permintaan Kerjasama'],
        //     // ['nomor_surat' => '007/SM/2024', 'pengirim' => 'Chris Martin', 'tanggal_masuk' => '2024-07-07', 'perihal' => 'Pengaduan Pelanggan'],
        //     // ['nomor_surat' => '008/SM/2024', 'pengirim' => 'Olivia Taylor', 'tanggal_masuk' => '2024-07-08', 'perihal' => 'Permohonan Sponsorship'],
        //     // ['nomor_surat' => '009/SM/2024', 'pengirim' => 'Daniel Lee', 'tanggal_masuk' => '2024-07-09', 'perihal' => 'Permintaan Penawaran'],
        //     // ['nomor_surat' => '010/SM/2024', 'pengirim' => 'Sophia Harris', 'tanggal_masuk' => '2024-07-10', 'perihal' => 'Undangan Seminar']
        // ];


        // foreach ($suratMasuks as $data) {
        //     $suratMasuk = SuratMasuk::create($data);

        //     // Create corresponding fileDokument entries
        //     FileDokument::create([
        //         'dokument_id' => $suratMasuk->id,
        //         'dokument' => 'SURAT MASUK',
        //         'file' => 'documents/' . $suratMasuk->nomor_surat . '.pdf', // Example file path
        //     ]);
        // }

        // Create surat keluar
        $suratKeluars = [
            ['nomor_surat' => '001/SK/2024', 'penerima' => 'Company A', 'tanggal_keluar' => '2024-07-03', 'perihal' => 'Penawaran Produk'],
            ['nomor_surat' => '002/SK/2024', 'penerima' => 'Company B', 'tanggal_keluar' => '2024-07-04', 'perihal' => 'Konfirmasi Pesanan'],
        ];

        foreach ($suratKeluars as $suratKeluar) {
            $surat =  SuratKeluar::create($suratKeluar);

            // Create corresponding fileDokument entries
            FileDokument::create([
                'dokument_id' => $surat->id,
                'dokument' => 'SURAT KELUAR',
                'file' => 'documents/' . $surat->nomor_surat . '.pdf', // Example file path
            ]);
        }

        // Create nested disposisi

        // Disposisi::create(['surat_masuk_id' => 1, 'user_id' => 3, 'isi_disposisi' => 'Surat Masuk']);
        // Disposisi::create(['surat_masuk_id' => 2, 'user_id' => 3, 'is_read' => true, 'isi_disposisi' => 'Surat Masuk']); // staff ke kadis
        // Disposisi::create(['surat_masuk_id' => 2, 'user_id' => 4, 'is_read' => true, 'isi_disposisi' => 'Harap ditindaklanjuti segera.']); // kadis ke kabib
        // Disposisi::create(['surat_masuk_id' => 2, 'user_id' => 5, 'is_read' => true, 'isi_disposisi' => 'Mohon persiapkan laporan.']); //  kabib ke kasi
        // Disposisi::create(['surat_masuk_id' => 2, 'bidang_id' => 2, 'isi_disposisi' => 'Laporan telah disiapkan.']); // kasi ke staff bidang


        // Disposisi::create(['surat_masuk_id' => 2, 'user_id' => 7, 'isi_disposisi' => 'Harap ditindaklanjuti segera.']);

        // Disposisi::create(['surat_masuk_id' => 3, 'isi_disposisi' => 'Mohon persiapkan laporan.']);
        // Disposisi::create(['surat_masuk_id' => 3, 'user_id' => 6, 'isi_disposisi' => 'Laporan telah disiapkan.']);
    }
}
