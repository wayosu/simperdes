<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master-data.provinsi.home', [
            'title' => 'Provinsi',
            'subtitle' => '',
            'active' => 'provinsi',
            'provinsis' => Provinsi::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-data.provinsi.create', [
            'title' => 'Provinsi',
            'subtitle' => 'Tambah Data',
            'active' => 'provinsi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_provinsi' => 'required|unique:provinsis,nama_provinsi',
            ],
            [
                'nama_provinsi.required' => 'Nama provinsi harus diisi.',
                'nama_provinsi.unique' => 'Nama provinsi sudah ada.',
            ]
        );

        $data = new Provinsi([
            'nama_provinsi' => $request->nama_provinsi,
        ]);
        $data->save();

        return redirect()->route('superadmin.provinsi')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('master-data.provinsi.edit', [
            'title' => 'Provinsi',
            'subtitle' => 'Edit Data',
            'active' => 'provinsi',
            'data' => Provinsi::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_provinsi' => 'required|unique:provinsis,nama_provinsi,' . $id,
            ],
            [
                'nama_provinsi.required' => 'Nama provinsi harus diisi.',
                'nama_provinsi.unique' => 'Nama provinsi sudah ada.',
            ]
        );

        $data = Provinsi::findorfail($id);

        $data_provinsi = [
            'nama_provinsi' => $request->nama_provinsi,
        ];
        $data->update($data_provinsi);

        return redirect()->route('superadmin.provinsi')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Provinsi::findOrFail($id);
        $data->delete();

        return redirect()->route('superadmin.provinsi')->with('success', 'Data berhasil dihapus.');
    }
}
