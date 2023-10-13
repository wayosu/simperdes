<?php

namespace App\Http\Controllers;

use App\Models\DesaKelurahan;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DesaKelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master-data.desa-kelurahan.home', [
            'title' => 'Desa Kelurahan',
            'subtitle' => '',
            'active' => 'desa-kelurahan',
            'datas' => DesaKelurahan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-data.desa-kelurahan.create', [
            'title' => 'Desa Kelurahan',
            'subtitle' => 'Tambah Data',
            'active' => 'desa-kelurahan',
            'kecamatans' => Kecamatan::join('kabupaten_kotas', 'kecamatans.kabupaten_kota_id', '=', 'kabupaten_kotas.id')
                                        ->join('provinsis', 'kabupaten_kotas.provinsi_id', '=', 'provinsis.id')
                                        ->orderBy('provinsis.nama_provinsi', 'ASC')
                                        ->select('kecamatans.*')
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
                'nama_desa_kelurahan' => 'required',
                'nama_kepala_desa' => 'required',
                'kecamatan_id' => 'required',
            ],
            [
                'nama_desa_kelurahan.required' => 'Nama desa/kelurahan harus diisi.',
                'nama_kepala_desa.required' => 'Nama kepala desa harus diisi.',
                'kecamatan_id.required' => 'Kecamatan harus diisi.',
            ]
        );

        $data = new DesaKelurahan([
            'nama_desa' => $request->nama_desa_kelurahan,
            'nama_kepala_desa' => $request->nama_kepala_desa,
            'kecamatan_id' => $request->kecamatan_id,
        ]);
        $data->save();

        return redirect()->route('superadmin.desa-kelurahan')->with('success', 'Data berhasil ditambahkan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('master-data.desa-kelurahan.edit', [
            'title' => 'Desa Kelurahan',
            'subtitle' => 'Edit Data',
            'active' => 'desa-kelurahan',
            'data' => DesaKelurahan::findOrFail($id),
            'kecamatans' => Kecamatan::join('kabupaten_kotas', 'kecamatans.kabupaten_kota_id', '=', 'kabupaten_kotas.id')
                                        ->join('provinsis', 'kabupaten_kotas.provinsi_id', '=', 'provinsis.id')
                                        ->orderBy('provinsis.nama_provinsi', 'ASC')
                                        ->select('kecamatans.*')
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
                'nama_desa_kelurahan' => 'required',
                'nama_kepala_desa' => 'required',
                'kecamatan_id' => 'required',
            ],
            [
                'nama_desa_kelurahan.required' => 'Nama desa/kelurahan harus diisi.',
                'nama_kepala_desa.required' => 'Nama kepala desa harus diisi.',
                'kecamatan_id.required' => 'Kecamatan harus diisi.',
            ]
        );

        $data = DesaKelurahan::findorfail($id);

        $data_desa_kelurahan = [
            'nama_desa' => $request->nama_desa_kelurahan,
            'nama_kepala_desa' => $request->nama_kepala_desa,
            'kecamatan_id' => $request->kecamatan_id,
        ];
        $data->update($data_desa_kelurahan);

        return redirect()->route('superadmin.desa-kelurahan')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = DesaKelurahan::findOrFail($id);
        $data->delete();

        return redirect()->route('superadmin.desa-kelurahan')->with('success', 'Data berhasil dihapus.');
    }
}
