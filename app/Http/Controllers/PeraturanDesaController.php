<?php

namespace App\Http\Controllers;

use App\Models\JenisPeraturan;
use App\Models\LogPeraturanDesa;
use App\Models\LogReviewPeraturanDesa;
use App\Models\PeraturanDesa;
use App\Models\ReviewPeraturanDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PeraturanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_user_id = auth()->user()->id;

        if (auth()->user()->role == 'superadmin') {
            $datas = PeraturanDesa::orderBy('updated_at', 'DESC')->latest()->get();
        } else if (auth()->user()->role == 'admin_kabkota') {
            $datas = PeraturanDesa::where('admin_kabkota_id', $current_user_id)
            ->orWhereNull('admin_kabkota_id')
            ->orderByDesc('updated_at')
            ->get();
        } else if (auth()->user()->role == 'admin_kecamatan') {
            $datas = PeraturanDesa::where('admin_kecamatan_id', $current_user_id)
            ->orWhereNull('admin_kecamatan_id')
            ->orderByDesc('updated_at')
            ->get();
        } else if (auth()->user()->role == 'mitra') {
            $datas = PeraturanDesa::where('admin_mitra_id', $current_user_id)
            ->orWhereNull('admin_mitra_id')
            ->orderByDesc('updated_at')
            ->get();
        } else if (auth()->user()->role == 'admin_desakel') {
            $datas = PeraturanDesa::where('user_id', '=', $current_user_id)->orderBy('updated_at', 'DESC')->latest()->get();
        }
        return view('peraturan-desa.home', [
            'title' => 'Peraturan Desa',
            'subtitle' => '',
            'active' => 'peraturan-desa',
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peraturan-desa.create', [
            'title' => 'Peraturan Desa',
            'subtitle' => 'Tambah Data',
            'active' => 'peraturan-desa',
            'jenis_peraturans' => JenisPeraturan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_peraturan' => 'required',
            'jenis_peraturan_id' => 'required',
            'isi_peraturan' => 'required',
            'file_peraturan' => 'required|mimes:pdf,doc,docx',
            'nama_penyusun' => 'required',
        ],
        [
            'judul_peraturan.required' => 'Judul Peraturan harus diisi.',
            'jenis_peraturan_id.required' => 'Jenis Peraturan harus diisi.',
            'isi_peraturan.required' => 'Isi Peraturan harus diisi.',
            'file_peraturan.required' => 'File Peraturan harus diisi.',
            'file_peraturan.mimes' => 'File Peraturan harus berupa file pdf, doc, atau docx.',
            'nama_penyusun.required' => 'Nama Penyusun user harus diisi.',
        ]);

        // mengambil file
        $file = $request->file('file_peraturan');
        $fileName = time() . '-' . rand(1,100) . '.' . $file->extension();
        $file->move('uploads/peraturan-desa/file/', $fileName);

        PeraturanDesa::create([
            'judul_peraturan' => $request->judul_peraturan,
            'jenis_peraturan_id' => $request->jenis_peraturan_id,
            'isi_peraturan' => $request->isi_peraturan,
            'file' => 'uploads/peraturan-desa/file/'.$fileName,
            'nama_penyusun' => $request->nama_penyusun,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('admin-desakel.peraturan-desa')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = PeraturanDesa::findOrFail($id);
        $data_log_pd = LogPeraturanDesa::where('peraturan_desa_id', $data->id)->get();
        $data_log_rpd = LogReviewPeraturanDesa::where('peraturan_desa_id', $data->id)->get();

        return view('peraturan-desa.detail', [
            'title' => 'Peraturan Desa',
            'subtitle' => 'Detail Peraturan Desa',
            'active' => 'peraturan-desa',
            'result' => $data,
            'data_log_pd' => $data_log_pd,
            'data_log_rpd' => $data_log_rpd,
            // 'jenis_peraturans' => JenisPeraturan::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = PeraturanDesa::findOrFail($id);

        if ($data->status == 0 || $data->status == 4) {
            return view('peraturan-desa.edit', [
                'title' => 'Peraturan Desa',
                'subtitle' => 'Edit Data',
                'active' => 'peraturan-desa',
                'data' => $data,
                'jenis_peraturans' => JenisPeraturan::all(),
            ]);
        } else {
            return redirect()->route('admin-desakel.peraturan-desa')->with('error', 'Halaman tidak dapat diakses.');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->file_lama);
        // exit;

        $request->validate([
            'judul_peraturan' => 'required',
            'jenis_peraturan_id' => 'required',
            'isi_peraturan' => 'required',
            'file_peraturan' => 'mimes:pdf,doc,docx',
            'nama_penyusun' => 'required',
        ],
        [
            'judul_peraturan.required' => 'Judul Peraturan harus diisi.',
            'jenis_peraturan_id.required' => 'Jenis Peraturan harus diisi.',
            'isi_peraturan.required' => 'Isi Peraturan harus diisi.',
            'file_peraturan.mimes' => 'File Peraturan harus berupa file pdf, doc, atau docx.',
            'nama_penyusun.required' => 'Nama Penyusun user harus diisi.',
        ]);

        $data = PeraturanDesa::findorfail($id);

        if ($request->has('file_peraturan')) {
            $path_file = $request->file_lama;

            // menghapus file lama*.
            if (File::exists($path_file)) {
                File::delete($path_file);
            }

            $file = $request->file('file_peraturan');
            $fileName = time() . '-' . rand(1,100) . '.' . $file->extension();
            $file->move('uploads/peraturan-desa/file/', $fileName);

            $peraturan_desa_data = [
                'judul_peraturan' => $request->judul_peraturan,
                'jenis_peraturan_id' => $request->jenis_peraturan_id,
                'isi_peraturan' => $request->isi_peraturan,
                'file' => 'uploads/peraturan-desa/file/'.$fileName,
                'nama_penyusun' => $request->nama_penyusun,
            ];
        } else {
            $peraturan_desa_data = [
                'judul_peraturan' => $request->judul_peraturan,
                'jenis_peraturan_id' => $request->jenis_peraturan_id,
                'isi_peraturan' => $request->isi_peraturan,
                'nama_penyusun' => $request->nama_penyusun,
            ];
        }
        $data->update($peraturan_desa_data);

        return redirect()->route('admin-desakel.peraturan-desa')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = PeraturanDesa::findOrFail($id);
        $destination = $data->file;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $data->delete();

        return redirect()->route('admin-desakel.peraturan-desa')->with('success', 'Data berhasil dihapus.');
    }

    public function status(Request $request, $id)
    {
        $status = $request->status;
        $data = PeraturanDesa::findOrFail($id);

        if (auth()->user()->role == 'admin_kabkota') {
            // update status admin kabkota
            $data->update([
                'status_admin_kabkota' => $status,
                'admin_kabkota_id' => auth()->user()->id,
            ]);
        } else if (auth()->user()->role == 'admin_kecamatan') {
            // update status admin kecamatan
            $data->update([
                'status_admin_kecamatan' => $status,
                'admin_kecamatan_id' => auth()->user()->id,
            ]);
        } else if (auth()->user()->role == 'mitra') {
            // update status admin mitra
            $data->update([
                'status_admin_mitra' => $status,
                'admin_mitra_id' => auth()->user()->id,
            ]);
        }

        if (auth()->user()->role == 'admin_kabkota') {
            return redirect()->route('admin-kabkota.peraturan-desa.review', $data->id)->with('warning', 'Berikan masukkan, tanggapan dan saran terhadap peraturan desa ini.');
        } else if (auth()->user()->role == 'admin_kecamatan') {
            return redirect()->route('admin-kecamatan.peraturan-desa.review', $data->id)->with('warning', 'Berikan masukkan, tanggapan dan saran terhadap peraturan desa ini.');
        } else if (auth()->user()->role == 'mitra') {
            return redirect()->route('mitra.peraturan-desa.review', $data->id)->with('warning', 'Berikan masukkan, tanggapan dan saran terhadap peraturan desa ini.');
        }
    }

    public function status_review(Request $request, $id)
    {
        $status = $request->status;
        $tipe_admin = $request->tipe_admin;

        $peraturan_desa = PeraturanDesa::findOrFail($id);
        
        if ($tipe_admin == 'admin_kabkota') {
            $review_peraturan_desa = ReviewPeraturanDesa::where('peraturan_desa_id', '=', $peraturan_desa->id)->where('user_id', '=', $peraturan_desa->admin_kabkota_id)->first();
        } else if ($tipe_admin == 'admin_kecamatan') {
            $review_peraturan_desa = ReviewPeraturanDesa::where('peraturan_desa_id', '=', $peraturan_desa->id)->where('user_id', '=', $peraturan_desa->admin_kecamatan_id)->first();
        } else if ($tipe_admin == 'admin_mitra') {
            $review_peraturan_desa = ReviewPeraturanDesa::where('peraturan_desa_id', '=', $peraturan_desa->id)->where('user_id', '=', $peraturan_desa->admin_mitra_id)->first();
        }

        if (!$review_peraturan_desa) {
            // Handle the case where no matching ReviewPeraturanDesa record is found
            // You can return an error message or redirect as needed
            return redirect()->back()->with('error', 'Data tinjauan tidak ditemukan.');
        }

        // dd($review_peraturan_desa);
        // exit;

        $data_rpd = ReviewPeraturanDesa::find($review_peraturan_desa->id);
        $data_rpd->update([
            'status' => $status
        ]);

        if (auth()->user()->role == 'superadmin') {
            return redirect()->route('superadmin.hasil-review', $data_rpd->id)->with('warning', 'Berikan masukkan, tanggapan dan saran terhadap peraturan desa ini.');
        } else if (auth()->user()->role == 'admin_desakel') {
            return redirect()->route('admin-desakel.hasil-review', $data_rpd->id)->with('warning', 'Berikan masukkan, tanggapan dan saran terhadap peraturan desa ini.');
        }
    }

    public function hasil_review($id)
    {
        $data = ReviewPeraturanDesa::findOrFail($id);

        return view('peraturan-desa.hasil-review', [
            'title' => 'Peraturan Desa',
            'subtitle' => 'Hasil Tinjauan Peraturan Desa',
            'active' => 'peraturan-desa',
            'result' => $data,
        ]);
    }

    public function detail_review(Request $request, $id)
    {
        $tipe_admin = $request->tipe_admin;

        // Find the PeraturanDesa record
        $peraturan_desa = PeraturanDesa::findOrFail($id);
        
        $review_peraturan_desa = null;
        
        // Check the value of $tipe_admin and assign the appropriate ReviewPeraturanDesa record
        if ($tipe_admin == 'admin_kabkota') {
            $review_peraturan_desa = ReviewPeraturanDesa::where('peraturan_desa_id', $peraturan_desa->id)
                ->where('user_id', $peraturan_desa->admin_kabkota_id)
                ->first();
        } else if ($tipe_admin == 'admin_kecamatan') {
            $review_peraturan_desa = ReviewPeraturanDesa::where('peraturan_desa_id', $peraturan_desa->id)
                ->where('user_id', $peraturan_desa->admin_kecamatan_id)
                ->first();
        } else if ($tipe_admin == 'admin_mitra') {
            $review_peraturan_desa = ReviewPeraturanDesa::where('peraturan_desa_id', $peraturan_desa->id)
                ->where('user_id', $peraturan_desa->admin_mitra_id)
                ->first();
        }
        
        if (!$review_peraturan_desa) {
            // Handle the case where no matching ReviewPeraturanDesa record is found
            // You can return an error message or redirect as needed
            return redirect()->back()->with('error', 'Data tinjauan tidak ditemukan.');
        }
        
        $data_rpd = ReviewPeraturanDesa::findOrFail($review_peraturan_desa->id);
        
        return view('peraturan-desa.detail-review', [
            'title' => 'Peraturan Desa',
            'subtitle' => 'Detail Tinjauan Peraturan Desa',
            'active' => 'peraturan-desa',
            'result' => $data_rpd,
        ]);
    }

    public function batal_periksa($id)
    {
        $data = ReviewPeraturanDesa::findOrFail($id);
        $data->update([
            'status' => 0
        ]);

        return redirect()->route('admin-desakel.peraturan-desa.detail', $data->peraturan_desa->id);
    }

    public function lanjut_evaluasi(Request $request, $id)
    {
        $rpd = ReviewPeraturanDesa::findOrFail($id);
        $data = PeraturanDesa::findOrFail($rpd->peraturan_desa_id);

        $rpd->update([
            'status' => 2
        ]);

        if ($request->tipe_admin == 'admin_kabkota') {
            $data->update([
                'status_admin_kabkota' => 3
            ]);
        } else if ($request->tipe_admin == 'admin_kecamatan') {
            $data->update([
                'status_admin_kecamatan' => 3
            ]);
        } else if ($request->tipe_admin == 'mitra') {
            $data->update([
                'status_admin_mitra' => 3
            ]);
        }

        return redirect()->route('admin-desakel.peraturan-desa.detail', $data->id)->with('success', 'Tinjauan Peraturan Desa sudah di tahap Evaluasi.');
    }

    public function evaluasi($id)
    {
        $data = PeraturanDesa::findOrFail($id);

        return view('peraturan-desa.evaluasi', [
            'title' => 'Peraturan Desa',
            'subtitle' => 'Evaluasi Peraturan Desa',
            'active' => 'peraturan-desa',
            'result' => $data,
            'jenis_peraturans' => JenisPeraturan::all(),
        ]);
    }

    public function evaluasi_update(Request $request, $id)
    {
        $data = PeraturanDesa::findOrFail($id);

        // copy and paste file lama ke folder log
        $path_file = $data->file;
        // rename file lama
        $file_name = explode('/', $path_file);
        $file_name = end($file_name);
        $file_name = explode('.', $file_name);
        $file_name = $file_name[0].'_'.time().'.'.$file_name[1];
        // pinda file ke folder log
        // dd($path_file, $file_name);
        // exit;
        File::copy($path_file, 'uploads/peraturan-desa/file/log/'.$file_name);

        // buat log peraturan desa setelah update
        $log_peraturan_desa = new LogPeraturanDesa([
            'peraturan_desa_id' => $data->id,
            'judul_peraturan' => $data->judul_peraturan,
            'jenis_peraturan_id' => $data->jenis_peraturan_id,
            'isi_peraturan' => $data->isi_peraturan,
            'file' => 'uploads/peraturan-desa/file/log/'.$file_name,
            'nama_penyusun' => $data->nama_penyusun,
            'user_id' => $data->user_id,
            'status' => $data->status,
            'status_admin_kabkota' => $data->status_admin_kabkota,
            'status_admin_kecamatan' => $data->status_admin_kecamatan,
            'status_admin_mitra' => $data->status_admin_mitra,
            'admin_kabkota_id' => $data->admin_kabkota_id,
            'admin_kecamatan_id' => $data->admin_kecamatan_id,
            'admin_mitra_id' => $data->admin_mitra_id,
            'created_at' => $data->created_at,
            'updated_at' => $data->updated_at,
        ]);
        $log_peraturan_desa->save();

        $request->validate([
            'judul_peraturan' => 'required',
            'jenis_peraturan_id' => 'required',
            'isi_peraturan' => 'required',
            'file_peraturan' => 'mimes:pdf,doc,docx',
            'nama_penyusun' => 'required',
        ],
        [
            'judul_peraturan.required' => 'Judul Peraturan harus diisi.',
            'jenis_peraturan_id.required' => 'Jenis Peraturan harus diisi.',
            'isi_peraturan.required' => 'Isi Peraturan harus diisi.',
            'file_peraturan.mimes' => 'File Peraturan harus berupa file pdf, doc, atau docx.',
            'nama_penyusun.required' => 'Nama Penyusun user harus diisi.',
        ]);

        if ($request->has('file_peraturan')) {
            $path_file = $request->file_lama;

            // menghapus file lama*.
            if (File::exists($path_file)) {
                File::delete($path_file);
            }

            $file = $request->file('file_peraturan');
            $fileName = time() . '-' . rand(1,100) . '.' . $file->extension();
            $file->move('uploads/peraturan-desa/file/', $fileName);

            $peraturan_desa_data = [
                'judul_peraturan' => $request->judul_peraturan,
                'jenis_peraturan_id' => $request->jenis_peraturan_id,
                'isi_peraturan' => $request->isi_peraturan,
                'file' => 'uploads/peraturan-desa/file/'.$fileName,
                'nama_penyusun' => $request->nama_penyusun,
                'status_admin_kabkota' => 0,
                'status_admin_kecamatan' => 0,
                'status_admin_mitra' => 0,
            ];
        } else {
            $peraturan_desa_data = [
                'judul_peraturan' => $request->judul_peraturan,
                'jenis_peraturan_id' => $request->jenis_peraturan_id,
                'isi_peraturan' => $request->isi_peraturan,
                'nama_penyusun' => $request->nama_penyusun,
                'status_admin_kabkota' => 0,
                'status_admin_kecamatan' => 0,
                'status_admin_mitra' => 0,
            ];
        }
        $data->update($peraturan_desa_data);

        return redirect()->route('admin-desakel.peraturan-desa.detail', $data->id)->with('success', 'Evaluasi Peraturan Desa Berhasil.');
    }

    public function selesai($id)
    {
        $pd = PeraturanDesa::findOrFail($id);

        $data_rpd = ReviewPeraturanDesa::whereIn('peraturan_desa_id', [$pd->id]);
        $data_rpd->update([
            'status' => 4
        ]);

        $pd->update([
            'status_admin_kabkota' => 4,
            'status_admin_kecamatan' => 4,
            'status_admin_mitra' => 4
        ]);

        // return redirect()->route('admin-desakel.peraturan-desa.detail', $pd->id)->with('success', 'Evaluasi Peraturan Desa sudah selesai.');

        return redirect()->route('welcome')->with('success', 'Evaluasi Peraturan Desa sudah selesai.');
    }
}
