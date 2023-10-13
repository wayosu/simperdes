<?php

namespace App\Http\Controllers;

use App\Models\KabupatenKota;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master-data.kecamatan.home', [
            'title' => 'Kecamatan',
            'subtitle' => '',
            'active' => 'kecamatan',
            'datas' => Kecamatan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-data.kecamatan.create', [
            'title' => 'Kecamatan',
            'subtitle' => 'Tambah Data',
            'active' => 'kecamatan',
            'kabupaten_kotas' => KabupatenKota::join('provinsis', 'kabupaten_kotas.provinsi_id', '=', 'provinsis.id')
                                                ->orderBy('provinsis.nama_provinsi', 'ASC')
                                                ->select('kabupaten_kotas.*')
                                                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_kecamatan' => 'required',
                'nama_camat' => 'required',
                'kabupaten_kota_id' => 'required',
            ],
            [
                'nama_kecamatan.required' => 'Nama kecamatan harus diisi.',
                'nama_camat.required' => 'Nama camat harus diisi.',
                'kabupaten_kota_id.required' => 'Kabupaten kota harus diisi.',
            ]
        );

        $data = new Kecamatan([
            'nama_kecamatan' => $request->nama_kecamatan,
            'nama_camat' => $request->nama_camat,
            'kabupaten_kota_id' => $request->kabupaten_kota_id,
        ]);
        $data->save();

        return redirect()->route('superadmin.kecamatan')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('master-data.kecamatan.edit', [
            'title' => 'Kecamatan',
            'subtitle' => 'Edit Data',
            'active' => 'kecamatan',
            'data' => Kecamatan::findOrFail($id),
            'kabupaten_kotas' => KabupatenKota::join('provinsis', 'kabupaten_kotas.provinsi_id', '=', 'provinsis.id')
                                                ->orderBy('provinsis.nama_provinsi', 'ASC')
                                                ->select('kabupaten_kotas.*')
                                                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_kecamatan' => 'required',
                'nama_camat' => 'required',
                'kabupaten_kota_id' => 'required',
            ],
            [
                'nama_kecamatan.required' => 'Nama kecamatan harus diisi.',
                'nama_camat.required' => 'Nama camat harus diisi.',
                'kabupaten_kota_id.required' => 'Kabupaten kota harus diisi.',
            ]
        );

        $data = Kecamatan::findorfail($id);

        $data_kecamatan = [
            'nama_kecamatan' => $request->nama_kecamatan,
            'nama_camat' => $request->nama_camat,
            'kabupaten_kota_id' => $request->kabupaten_kota_id,
        ];
        $data->update($data_kecamatan);

        return redirect()->route('superadmin.kecamatan')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Kecamatan::findOrFail($id);
        $data->delete();

        return redirect()->route('superadmin.kecamatan')->with('success', 'Data berhasil dihapus.');
    }
}
