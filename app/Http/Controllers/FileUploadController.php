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

        $usersQuery = User::with('jabatans.bidang')
            ->where('name', 'like', '%' . $query . '%');

        if ($authRole === 'Kadis') {
            $usersQuery->whereHas('jabatans', function ($q) {
                $q->where('alias', 'Kabib');
            });
        } elseif ($authRole === 'Kabib') {
            $usersQuery->whereHas('jabatans', function ($q) {
                $q->where('alias', 'Kasi');
            });
        } else {
            // Jika jabatan adalah 'Staff', ambil satu pengguna saja
            $usersQuery->whereHas('jabatans', function ($q) {
                $q->where('alias', 'Staff');
            })->take(1);
        }

        // Jika bukan 'Staff', ambil empat pengguna
        if ($authRole !== 'Kasi') {
            $usersQuery->take(4);
        }

        $users = $usersQuery->get();
        $responseData = $users->map(function ($user) use ($authRole) {
            if ($authRole !== 'Kasi') {
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
        $filePath = 'files/' . $filePath->file;

        if (!Storage::disk('local')->exists($filePath)) {
            abort(404, 'File not found');
        }
        $contents = Storage::disk('local')->get($filePath);
        return response($contents, 200)
            ->header('Content-Type', 'application/pdf');
    }
}
