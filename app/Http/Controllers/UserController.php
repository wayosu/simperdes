<?php

namespace App\Http\Controllers;

use App\Models\DesaKelurahan;
use App\Models\KabupatenKota;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.home', [
            'title' => 'Users',
            'subtitle' => '',
            'active' => 'users',
            'datas' => User::where('role', '!=', 4)->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create', [
            'title' => 'Users',
            'subtitle' => 'Tambah Data',
            'active' => 'users',
            'kabupaten_kotas' => KabupatenKota::join('provinsis', 'kabupaten_kotas.provinsi_id', '=', 'provinsis.id')
            ->orderBy('provinsis.nama_provinsi', 'ASC')
            ->select('kabupaten_kotas.*')
            ->get(),
            'kecamatans' => Kecamatan::join('kabupaten_kotas', 'kecamatans.kabupaten_kota_id', '=', 'kabupaten_kotas.id')
            ->join('provinsis', 'kabupaten_kotas.provinsi_id', '=', 'provinsis.id')
            ->orderBy('provinsis.nama_provinsi', 'ASC')
            ->select('kecamatans.*')
            ->get(),
            'desa_kelurahans' => DesaKelurahan::join('kecamatans', 'desa_kelurahans.kecamatan_id', '=', 'kecamatans.id')
            ->join('kabupaten_kotas', 'kecamatans.kabupaten_kota_id', '=', 'kabupaten_kotas.id')
            ->join('provinsis', 'kabupaten_kotas.provinsi_id', '=', 'provinsis.id')
            ->orderBy('provinsis.nama_provinsi', 'ASC')
            ->select('desa_kelurahans.*')
            ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        $request->validate([
            'nama_petugas' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ],
        [
            'nama_petugas.required' => 'Nama petugas harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'role.required' => 'Tipe user harus diisi.',
        ]);

        $selectRegion = null;
        $fieldName = null;
        $errorMessage = null;

        switch ($request->role) {
            case 1:
                $selectRegion = $request->desa_kelurahan_id;
                $fieldName = 'desa_kelurahan_id';
                $errorMessage = 'Desa kelurahan harus diisi.';
                break;

            case 2:
                $selectRegion = $request->kecamatan_id;
                $fieldName = 'kecamatan_id';
                $errorMessage = 'Kecamatan harus diisi.';
                break;

            case 3:
                $selectRegion = $request->kabupaten_kota_id;
                $fieldName = 'kabupaten_kota_id';
                $errorMessage = 'Kabupaten kota harus diisi.';
                break;

            default:
                break;
        }

        if ($fieldName !== null) {
            $request->validate([
                $fieldName => 'required',
            ], [
                $fieldName . '.required' => $errorMessage,
            ]);
        }

        // upload foto
        if ($request->has('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'foto.image' => 'Foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus berupa gambar.',
                'foto.max' => 'Foto maksimal berukuran 2 MB.',
            ]);

            $foto = $request->file('foto');
            $foto_name = time() . '.' . $foto->extension();
            $foto->move('uploads/users/foto/', $foto_name);
        } else {
            $foto_name = 'default.jpg';
        }

        $data = new User([
            'name' => $request->nama_petugas,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'nomor_hp' => $request->nomor_hp,
            'alamat' => $request->alamat,
            'foto' => 'uploads/users/foto/' . $foto_name,
        ]);
        
        if ($request->role == 1 || $request->role == 2 || $request->role == 3) {
            $data->setAttribute($fieldName, $selectRegion);
        }
        
        $data->save();


        return redirect()->route('superadmin.users')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('users.edit', [
            'title' => 'Users',
            'subtitle' => 'Edit Data',
            'active' => 'users',
            'data' => User::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_petugas' => 'required',
            'email' => 'required|unique:users,email,' . $id,
        ],
        [
            'nama_petugas.required' => 'Nama petugas harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        $user = User::findOrFail($id);

        // upload foto
        if ($request->has('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'foto.image' => 'Foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus berupa gambar.',
                'foto.max' => 'Foto maksimal berukuran 2 MB.',
            ]);

            $path_foto = $request->foto_lama;

            if (File::exists($path_foto)) {
                File::delete($path_foto);
            }

            $foto = $request->file('foto');
            $foto_name = time() . '.' . $foto->extension();
            $foto->move('uploads/users/foto/', $foto_name);

            $data_user = [
                'name' => $request->nama_petugas,
                'email' => $request->email,
                'nomor_hp' => $request->nomor_hp,
                'alamat' => $request->alamat,
                'foto' => 'uploads/users/foto/' . $foto_name,
            ];
        } else {
            $data_user = [
                'name' => $request->nama_petugas,
                'email' => $request->email,
                'nomor_hp' => $request->nomor_hp,
                'alamat' => $request->alamat,
            ];
        }

        $user->update($data_user);

        return redirect()->route('superadmin.users')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $path_foto = $user->foto;

        if (File::exists($path_foto)) {
            File::delete($path_foto);
        }

        $user->delete();

        return redirect()->route('superadmin.users')->with('success', 'Data berhasil dihapus.');
    }

    public function pengaturan()
    {
        return view('pengaturan-akun', [
            'title' => 'Pengaturan Akun',
            'subtitle' => '',
            'active' => 'pengaturan-akun',
            'data' => User::findOrFail(auth()->user()->id),
        ]);
    }

    public function update_password(Request $request, $id)
    {
        // update password
        $request->validate([
            'password_baru' => 'required|min:8',
            'konfirmasi_password_baru' => 'required|same:password_baru',
        ],
        [
            'password_baru.required' => 'Password baru harus diisi.',
            'password_baru.min' => 'Password baru minimal 8 karakter.',
            'konfirmasi_password_baru.required' => 'Konfirmasi password baru harus diisi.',
            'konfirmasi_password_baru.same' => 'Konfirmasi password baru tidak sama.',
        ]);

        $user = User::findOrFail($id);

        $data_user = [
            'password' => bcrypt($request->password_baru),
        ];
        $user->update($data_user);

        if (auth()->user()->role == 'superadmin') {
            return redirect()->route('superadmin.pengaturan')->with('success', 'Password berhasil diperbarui.');
        } else if (auth()->user()->role == 'admin_kabkota') {
            return redirect()->route('admin-kabkota.pengaturan')->with('success', 'Password berhasil diperbarui.');
        } else if (auth()->user()->role == 'admin_kecamatan') {
            return redirect()->route('admin-kecamatan.pengaturan')->with('success', 'Password berhasil diperbarui.');
        } else if (auth()->user()->role == 'admin_desakel') {
            return redirect()->route('admin-desakel.pengaturan')->with('success', 'Password berhasil diperbarui.');
        } else if (auth()->user()->role == 'mitra') {
            return redirect()->route('mitra.pengaturan')->with('success', 'Password berhasil diperbarui.');
        }
    }

    public function update_bio(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
        ],
        [
            'name.required' => 'Nama petugas harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        $user = User::findOrFail($id);

        // upload foto
        if ($request->has('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'foto.image' => 'Foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus berupa gambar.',
                'foto.max' => 'Foto maksimal berukuran 2 MB.',
            ]);

            $path_foto = $request->foto_lama;

            if (File::exists($path_foto)) {
                File::delete($path_foto);
            }

            $foto = $request->file('foto');
            $foto_name = time() . '.' . $foto->extension();
            $foto->move('uploads/users/foto/', $foto_name);

            $data_user = [
                'name' => $request->name,
                'email' => $request->email,
                'nomor_hp' => $request->nomor_hp,
                'alamat' => $request->alamat,
                'foto' => 'uploads/users/foto/' . $foto_name,
            ];
        } else {
            $data_user = [
                'name' => $request->name,
                'email' => $request->email,
                'nomor_hp' => $request->nomor_hp,
                'alamat' => $request->alamat,
            ];
        }

        $user->update($data_user);

        if (auth()->user()->role == 'superadmin') {
            return redirect()->route('superadmin.pengaturan')->with('success', 'Informasi Akun berhasil diperbarui.');
        } else if (auth()->user()->role == 'admin_kabkota') {
            return redirect()->route('admin-kabkota.pengaturan')->with('success', 'Informasi Akun berhasil diperbarui.');
        } else if (auth()->user()->role == 'admin_kecamatan') {
            return redirect()->route('admin-kecamatan.pengaturan')->with('success', 'Informasi Akun berhasil diperbarui.');
        } else if (auth()->user()->role == 'admin_desakel') {
            return redirect()->route('admin-desakel.pengaturan')->with('success', 'Informasi Akun berhasil diperbarui.');
        } else if (auth()->user()->role == 'mitra') {
            return redirect()->route('mitra.pengaturan')->with('success', 'Informasi Akun berhasil diperbarui.');
        }
    }
}
