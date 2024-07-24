<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\FileDokument;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function fetch(Request $request)
    {
        $query = $request->input('q');
        $authUser = auth()->user();
        $authRole = $authUser->jabatans->alias ?? null;
        $authBidangId = $authUser->jabatans->bidang_id ?? null;

        $usersQuery = User::with('jabatans.bidang')
            ->where('name', 'like', '%' . $query . '%');

        if ($authRole === 'KADIS') {
            $usersQuery->whereHas('jabatans', function ($q) {
                $q->where('alias', 'KABIB');
            });
            $usersQuery->take(4);
        } elseif ($authRole === 'KABIB') {
            $usersQuery->whereHas('jabatans', function ($q) use ($authBidangId) {
                $q->where('alias', 'KASI')
                    ->where('bidang_id', $authBidangId);
            });
        } else {
            $usersQuery->whereHas('jabatans', function ($q) use ($authBidangId) {
                $q->where('alias', 'STAFFBAGIAN')
                    ->where('bidang_id', $authBidangId);
            })->take(1);
        }

        $users = $usersQuery->get();

        $responseData = $users->map(function ($user) use ($authRole) {
            if ($authRole != 'KASI') {
                return [
                    'id' => $user->id,
                    'name' => $user->jabatans->name . ' ' . $user->jabatans->bidang->name . ' ( ' . $user->name . ' ) ',
                ];
            } else {
                return [
                    'id' => $user->id,
                    'name' => $user->jabatans->name . ' ' . $user->jabatans->bidang->name,
                ];
            }
        });

        return response()->json($responseData);
    }

    public function getPdf(Request $request)
    {
        $file = $request->input('file');
        // dd($file);
        // $filePath = storage_path('app/pdf/' . $file);
        $filePath = FileDokument::where('file', $file)
            ->firstOrFail();

        if ($filePath->dokument == 'SURAT KELUAR') {
            $filePath = 'files/surat-keluar/' . $filePath->file;
        } else {
            $filePath = 'files/surat-masuk/' . $filePath->file;
        }



        if (!Storage::disk('local')->exists($filePath)) {
            abort(404, 'File not found');
        }
        $contents = Storage::disk('local')->get($filePath);
        return response($contents, 200)
            ->header('Content-Type', 'application/pdf');
    }
}
