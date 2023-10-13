<?php

namespace App\Http\Controllers;

use App\Models\KabupatenKota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master-data.kabupaten-kota.home', [
            'title' => 'Kabupaten Kota',
            'subtitle' => '',
            'active' => 'kabupaten-kota',
            'datas' => KabupatenKota::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-data.kabupaten-kota.create', [
            'title' => 'Kabupaten Kota',
            'subtitle' => 'Tambah Data',
            'active' => 'kabupaten-kota',
            'provinsis' => Provinsi::orderBy('nama_provinsi', 'ASC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_kabupaten_kota' => 'required',
                'provinsi_id' => 'required',
            ],
            [
                'nama_kabupaten_kota.required' => 'Nama kabupaten kota harus diisi.',
                'provinsi_id.required' => 'Provinsi harus diisi.',
            ]
        );

        $data = new KabupatenKota([
            'nama_kabupaten_kota' => $request->nama_kabupaten_kota,
            'provinsi_id' => $request->provinsi_id,
        ]);
        $data->save();

        return redirect()->route('superadmin.kabupaten-kota')->with('success', 'Data berhasil ditambahkan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('master-data.kabupaten-kota.edit', [
            'title' => 'Kabupaten Kota',
            'subtitle' => 'Edit Data',
            'active' => 'kabupaten-kota',
            'data' => KabupatenKota::findOrFail($id),
            'provinsis' => Provinsi::orderBy('nama_provinsi', 'ASC')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_kabupaten_kota' => 'required',
                'provinsi_id' => 'required',
            ],
            [
                'nama_kabupaten_kota.required' => 'Nama kabupaten kota harus diisi.',
                'provinsi_id.required' => 'Provinsi harus diisi.',
            ]
        );

        $data = KabupatenKota::findorfail($id);

        $data_kabupaten_kota = [
            'nama_kabupaten_kota' => $request->nama_kabupaten_kota,
            'provinsi_id' => $request->provinsi_id,
        ];
        $data->update($data_kabupaten_kota);

        return redirect()->route('superadmin.kabupaten-kota')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = KabupatenKota::findOrFail($id);
        $data->delete();

        return redirect()->route('superadmin.kabupaten-kota')->with('success', 'Data berhasil dihapus.');
    }
}
