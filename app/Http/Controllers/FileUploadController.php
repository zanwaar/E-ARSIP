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
                $q->where('alias', 'SUBKABIB');
            })->take(4);
        } elseif ($authRole === 'SUBKABIB') {
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
        $fileName = $request->input('file');

        $fileDokument = FileDokument::where('file', $fileName)->firstOrFail();

        $filePath = $this->getFilePath($fileDokument);

        if (!Storage::disk('local')->exists($filePath)) {
            abort(404, 'File not found');
        }

        $file = Storage::disk('local')->get($filePath);

        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $fileDokument->file . '"');
    }

    public function downloadFile(Request $request)
    {
        $fileName = $request->input('file');

        $fileDokument = FileDokument::where('file', $fileName)->firstOrFail();

        $filePath = $this->getFilePath($fileDokument);

        if (!Storage::disk('local')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->download(Storage::disk('local')->path($filePath));
    }

    public function deleteFile(Request $request)
    {
        $fileName = $request->input('file');

        $fileDokument = FileDokument::where('file', $fileName)->firstOrFail();

        $filePath = $this->getFilePath($fileDokument);

        if (Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
        } else {
            abort(404, 'File not found in storage');
        }

        $fileDokument->delete();

        return response()->json(['message' => 'File deleted successfully']);
    }

    private function getFilePath($fileDokument)
    {
        if ($fileDokument->dokument == 'SURAT KELUAR') {
            return 'files/surat-keluar/' . $fileDokument->file;
        } else if ($fileDokument->dokument == 'SURAT MASUK') {
            return 'files/surat-masuk/' . $fileDokument->file;
        } else if ($fileDokument->dokument == 'DOKUMENT') {
            return 'files/dokument/' . $fileDokument->file;
        } else {
            abort(404, 'File not found');
        }
    }
}
