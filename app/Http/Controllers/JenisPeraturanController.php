<?php

namespace App\Http\Controllers;

use App\Models\JenisPeraturan;
use Illuminate\Http\Request;

class JenisPeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master-data.jenis-peraturan.home', [
            'title' => 'Jenis Peraturan Desa',
            'subtitle' => '',
            'active' => 'jenis-peraturan',
            'datas' => JenisPeraturan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-data.jenis-peraturan.create', [
            'title' => 'Jenis Peraturan Desa',
            'subtitle' => 'Tambah Data',
            'active' => 'jenis-peraturan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'jenis_aturan' => 'required',
            ],
            [
                'jenis_aturan.required' => 'Nama provinsi harus diisi.'
            ]
        );

        $data = new JenisPeraturan([
            'jenis_aturan' => $request->jenis_aturan,
        ]);
        $data->save();

        return redirect()->route('superadmin.jenis-peraturan')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('master-data.jenis-peraturan.edit', [
            'title' => 'Jenis Peraturan Desa',
            'subtitle' => 'Edit Data',
            'active' => 'jenis-peraturan',
            'data' => JenisPeraturan::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'jenis_aturan' => 'required',
            ],
            [
                'jenis_aturan.required' => 'Nama provinsi harus diisi.'
            ]
        );

        $data = JenisPeraturan::findorfail($id);

        $data_jenis_peraturan = [
            'jenis_aturan' => $request->jenis_aturan,
        ];
        $data->update($data_jenis_peraturan );

        return redirect()->route('superadmin.jenis-peraturan')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = JenisPeraturan::findOrFail($id);
        $data->delete();

        return redirect()->route('superadmin.jenis-peraturan')->with('success', 'Data berhasil dihapus.');
    }
}
