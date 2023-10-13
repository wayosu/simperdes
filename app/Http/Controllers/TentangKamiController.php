<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tentang-kami', [
            'title' => 'Tentang Kami',
            'subtitle' => '',
            'active' => 'tentang-kami',
            'data' => TentangKami::first(),
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required',
            'link_gmaps' => 'required',
            'email' => 'required',
            'telepon' => 'required',
        ]);

        TentangKami::where('id', $id)->update([
            'alamat' => $request->alamat,
            'link_gmaps' => $request->link_gmaps,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'link_facebook' => $request->link_facebook,
            'link_instagram' => $request->link_instagram,
            'link_twitter' => $request->link_twitter,
        ]);

        return redirect()->back()->with('success', 'Informasi tentang kami berhasil diperbarui.');
    }

}
