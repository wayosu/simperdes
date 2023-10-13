<?php

namespace App\Http\Controllers;

use App\Models\JenisPeraturan;
use App\Models\LogReviewPeraturanDesa;
use App\Models\PeraturanDesa;
use App\Models\ReviewPeraturanDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReviewPeraturanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'superadmin') {
            $data = ReviewPeraturanDesa::latest()->get();
        } else {
            $data = ReviewPeraturanDesa::where('user_id', '=', auth()->user()->id)->latest()->get();
        }

        return view('review-peraturan-desa.home', [
            'title' => 'Tinjauan Peraturan Desa',
            'subtitle' => '',
            'active' => 'tinjauan-peraturan-desa',
            'datas' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function review($id)
    {
        $data = PeraturanDesa::findOrFail($id);

        return view('review-peraturan-desa.review', [
            'title' => 'Peraturan Desa',
            'subtitle' => 'Data Tinjauan',
            'active' => 'peraturan-desa',
            'result' => $data,
            'jenis_peraturans' => JenisPeraturan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $get_review = ReviewPeraturanDesa::where('peraturan_desa_id', '=', $request->peraturan_desa_id)->where('user_id', '=', auth()->user()->id)->first();

        if ($get_review != null) {
            if ($get_review->file != null) {
                // Get the source file path
                $path_file = $get_review->file;
        
                // Check if the source file exists
                if (File::exists($path_file)) {
                    // Rename the file
                    $file_name = explode('/', $path_file);
                    $file_name = end($file_name);
                    $file_parts = pathinfo($file_name);
                    $file_name = $file_parts['filename'] . '_' . time() . '.' . $file_parts['extension'];
        
                    // Move the file to the log folder
                    if (File::copy($path_file, 'uploads/peraturan-desa/review-file/log/' . $file_name)) {
                        // Insert log review peraturan desa
                        $data_log_review_perdes = [
                            'peraturan_desa_id' => $get_review->peraturan_desa_id,
                            'user_id' => $get_review->user_id,
                            'status' => $get_review->status,
                            'catatan' => $get_review->catatan,
                            'file' => 'uploads/peraturan-desa/review-file/log/' . $file_name,
                            'link_tautan' => $get_review->link_tautan,
                        ];
                    } else {
                        // Handle the case where the file could not be copied
                        // You can log an error or take appropriate action
                        // Insert log review peraturan desa without a file
                        $data_log_review_perdes = [
                            'peraturan_desa_id' => $get_review->peraturan_desa_id,
                            'user_id' => $get_review->user_id,
                            'status' => $get_review->status,
                            'catatan' => $get_review->catatan,
                            'link_tautan' => $get_review->link_tautan,
                        ];

                    }
                } else {
                    // Handle the case where the source file does not exist
                    // You can log an error or take appropriate action
                    // Insert log review peraturan desa without a file
                    $data_log_review_perdes = [
                        'peraturan_desa_id' => $get_review->peraturan_desa_id,
                        'user_id' => $get_review->user_id,
                        'status' => $get_review->status,
                        'catatan' => $get_review->catatan,
                        'link_tautan' => $get_review->link_tautan,
                    ];
                }

                if (File::exists($path_file)) {
                    File::delete($path_file);
                } 
            } else {
                // Insert log review peraturan desa without a file
                $data_log_review_perdes = [
                    'peraturan_desa_id' => $get_review->peraturan_desa_id,
                    'user_id' => $get_review->user_id,
                    'status' => $get_review->status,
                    'catatan' => $get_review->catatan,
                    'link_tautan' => $get_review->link_tautan,
                ];
            }
        
            $data_log_rpd = new LogReviewPeraturanDesa($data_log_review_perdes);
            $data_log_rpd->save();
        
            // Delete review peraturan desa
            $get_review->delete();
        }

        $perdes_id = $request->peraturan_desa_id;

        $request->validate([
            'catatan' => 'required',
        ], 
        [
            'catatan.required' => 'Catatan harus diisi.',
        ]);

        if ($request->has('file_review')) {
            $request->validate([
                'file_review' => 'mimes:pdf,doc,docx'
            ], 
            [
                'catatan.required' => 'Catatan harus diisi.',
            ]);

            $file_review = $request->file('file_review');
            $file_reviewName = time() . '-' . rand(1,100) . '.' . $file_review->extension();
            $file_review->move('uploads/peraturan-desa/review-file/', $file_reviewName);

            $data_review_perdes = [
                'peraturan_desa_id' => $perdes_id,
                'user_id' => auth()->user()->id,
                'catatan' => $request->catatan,
                'file' => 'uploads/peraturan-desa/review-file/'.$file_reviewName,
                'link_tautan' => $request->link_tautan,
            ];
        } else {
            $data_review_perdes = [
                'peraturan_desa_id' => $perdes_id,
                'user_id' => auth()->user()->id,
                'catatan' => $request->catatan,
                'link_tautan' => $request->link_tautan,
            ];
        }

        $data = new ReviewPeraturanDesa($data_review_perdes);
        $data->save();

        $perdes = PeraturanDesa::find($perdes_id);
        
        if (auth()->user()->role == 'admin_kabkota') {
            $perdes->update(['status_admin_kabkota' => 2]);
            return redirect()->route('admin-kabkota.review-peraturan-desa')->with('success', 'Tinjauan peraturan desa berhasil dikirim.');
        } else if (auth()->user()->role == 'admin_kecamatan') {
            $perdes->update(['status_admin_kecamatan' => 2]);
            return redirect()->route('admin-kecamatan.review-peraturan-desa')->with('success', 'Tinjauan peraturan desa berhasil dikirim.');
        } else if (auth()->user()->role == 'mitra') {
            $perdes->update(['status_admin_mitra' => 2]);
            return redirect()->route('mitra.review-peraturan-desa')->with('success', 'Tinjauan peraturan desa berhasil dikirim.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = ReviewPeraturanDesa::findOrFail($id);
        $peraturan_desa = PeraturanDesa::findOrFail($data->peraturan_desa_id);
        
        $data_log_rpd = LogReviewPeraturanDesa::where('peraturan_desa_id', '=', $data->peraturan_desa_id)->where('user_id', '=', $data->user_id)->get();

        return view('review-peraturan-desa.detail', [
            'title' => 'Peraturan Desa',
            'subtitle' => 'Detail Tinjauan',
            'active' => 'tinjauan-peraturan-desa',
            'result' => $peraturan_desa,
            'jenis_peraturans' => JenisPeraturan::all(),
            'review' => $data,
            'log_review' => $data_log_rpd,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReviewPeraturanDesa $reviewPeraturanDesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReviewPeraturanDesa $reviewPeraturanDesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = ReviewPeraturanDesa::findOrFail($id);
        $destination = $data->file;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $peraturan_desa = PeraturanDesa::find($data->peraturan_desa_id);
        $peraturan_desa->update([
            'status_admin_kabkota' => 0,
            'admin_kabkota_id' => null,
        ]);

        $data->delete();

        if (auth()->user()->role == 'admin_kabkota') {
            return redirect()->route('admin-kabkota.review-peraturan-desa')->with('success', 'Data berhasil dihapus.');
        } else if (auth()->user()->role == 'admin_kecamatan') {
            return redirect()->route('admin-kecamatan.review-peraturan-desa')->with('success', 'Data berhasil dihapus.');
        } else if (auth()->user()->role == 'mitra') {
            return redirect()->route('mitra.review-peraturan-desa')->with('success', 'Data berhasil dihapus.');
        }
    }

    public function hasil_review($id)
    {
        
    }
}
