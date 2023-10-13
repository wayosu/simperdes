<?php

namespace App\Http\Controllers;

use App\Models\JenisPeraturan;
use App\Models\Perde;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PerdeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_user_id = auth()->user()->id;

        return view('perdes.home', [
            'title' => 'PERDES',
            'subtitle' => '',
            'active' => 'perdes',
            'datas' => Perde::where('user_id', $current_user_id)->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('perdes.create', [
            'title' => 'PERDES',
            'subtitle' => 'Tambah PERDES',
            'active' => 'perdes',
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
         $fileName = 'PERDES-' . time() . '-' . rand(1,100) . '.' . $file->extension();
         $file->move('uploads/peraturan-desa/file/', $fileName);
 
         Perde::create([
             'judul_peraturan' => $request->judul_peraturan,
             'jenis_peraturan_id' => $request->jenis_peraturan_id,
             'isi_peraturan' => $request->isi_peraturan,
             'file' => 'uploads/peraturan-desa/file/'.$fileName,
             'nama_penyusun' => $request->nama_penyusun,
             'user_id' => auth()->user()->id,
         ]);
 
         return redirect()->route('admin-desakel.perdes')->with('success', 'Data berhasil diupload.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Perde::findOrFail($id);

        return view('perdes.detail', [
            'title' => 'PERDES',
            'subtitle' => 'Detail PERDES',
            'active' => 'perdes',
            'result' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Perde::findOrFail($id);

        return view('perdes.edit', [
            'title' => 'PERDES',
            'subtitle' => 'Edit PERDES',
            'active' => 'perdes',
            'data' => $data,
            'jenis_peraturans' => JenisPeraturan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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

        $data = Perde::findorfail($id);

        if ($request->has('file_peraturan')) {
            $path_file = $request->file_lama;

            // menghapus file lama*.
            if (File::exists($path_file)) {
                File::delete($path_file);
            }

            $file = $request->file('file_peraturan');
            $fileName = 'PERDES-' . time() . '-' . rand(1,100) . '.' . $file->extension();
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

        return redirect()->route('admin-desakel.perdes')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Perde::findOrFail($id);
        $destination = $data->file;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $data->delete();

        return redirect()->route('admin-desakel.perdes')->with('success', 'Data berhasil dihapus.');
    }
}
