<?php

namespace App\Http\Controllers;

use App\Models\PeraturanDesa;
use App\Models\Perde;
use App\Models\TentangKami;
use Illuminate\Support\Facades\File;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function welcome()
    {
        $three_latest_data = PeraturanDesa::where('status_admin_kabkota', 4)
                                            ->where('status_admin_kecamatan', 4)
                                            ->where('status_admin_mitra', 4)
                                            ->latest()
                                            ->take(3)
                                            ->get();

        $latest_data = PeraturanDesa::where('status_admin_kabkota', 4)
                                            ->where('status_admin_kecamatan', 4)
                                            ->where('status_admin_mitra', 4)
                                            ->latest()
                                            ->get();

        $perdes = Perde::latest()->get();

        return view('welcome', [
            'three_latest_data' => $three_latest_data,
            'latest_data' => $latest_data,
            'perdes' => $perdes,
            'tentang_kami' => TentangKami::first(),
        ]);
    }

    public function unduh($filename)
    {
        // Specify the path to the file in the "public" directory.
        $filePath = public_path('uploads/peraturan-desa/file/' . $filename);

        // Check if the file exists.
        if (file_exists($filePath)) {
            // Determine the content type based on the file extension.
            $contentType = $this->getContentType($filename);

            // Return the file as a response with the appropriate content type.
            return response()->download($filePath, $filename, ['Content-Type' => $contentType]);
        } else {
            // Handle the case where the file doesn't exist.
            abort(404);
        }
    }

    private function getContentType($filename)
    {
        $extension = File::extension($filename);
        switch ($extension) {
            case 'pdf':
                return 'application/pdf';
            case 'doc':
                return 'application/msword';
            case 'docx':
                return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            default:
                return 'application/octet-stream'; // Default content type for unknown file types.
        }
    }
}
