@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title"><i class="fas fa-lock fa-xs"></i> Ubah Password</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->role == 'superadmin')
                            <form action="{{ route('superadmin.pengaturan.update-password', Auth::user()->id) }}" method="post">
                            @elseif (Auth::user()->role == 'admin_kabkota')
                            <form action="{{ route('admin-kabkota.pengaturan.update-password', Auth::user()->id) }}" method="post">
                            @elseif (Auth::user()->role == 'admin_kecamatan')
                            <form action="{{ route('admin-kecamatan.pengaturan.update-password', Auth::user()->id) }}" method="post">
                            @elseif (Auth::user()->role == 'admin_desakel')
                            <form action="{{ route('admin-desakel.pengaturan.update-password', Auth::user()->id) }}" method="post">
                            @elseif (Auth::user()->role == 'mitra')
                            <form action="{{ route('mitra.pengaturan.update-password', Auth::user()->id) }}" method="post">
                            @endif
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" name="password_baru" class="form-control @error('password_baru') is-invalid @enderror">
                                    @error('password_baru')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password" name="konfirmasi_password_baru" class="form-control @error('konfirmasi_password_baru') is-invalid @enderror">
                                    @error('konfirmasi_password_baru')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <button type="reset" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Reset</button>
                                <button type="submit" class="btn btn-sm btn-success show_confirm_pass "><i class="fas fa-save"></i> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title"><i class="fas fa-info-circle fa-xs"></i> Informasi Akun</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i>Informasi</h5>
                                Hi, <b>{{ Auth::user()->name }}</b>. Informasi anda dapat diperbarui melalui form dibawah ini. Anda terdaftar di <b>SIMPERDES</b> sebagai 
                                @if (Auth::user()->role == 'superadmin')
                                    <b>Super Admin</b>.
                                @elseif (Auth::user()->role == 'admin_kabkota')
                                    <b>Admin Kabupaten/Kota</b>.
                                @elseif (Auth::user()->role == 'admin_kecamatan')
                                    <b>Admin Kecamatan</b>.
                                @elseif (Auth::user()->role == 'admin_desakel')
                                    <b>Admin Desa/Kelurahan</b> di <b>{{ Auth::user()->desa_kelurahan->nama_desa ?? '-' }}</b>.
                                @elseif (Auth::user()->role == 'mitra')
                                    <b>Mitra</b>.
                                @endif
                                Jika anda ingin mengubah password, silahkan gunakan form <b>Ubah Password</b>.
                              </div>


                            @if (Auth::user()->role == 'superadmin')
                            <form action="{{ route('superadmin.pengaturan.update-bio', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @elseif (Auth::user()->role == 'admin_kabkota')
                            <form action="{{ route('admin-kabkota.pengaturan.update-bio', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @elseif (Auth::user()->role == 'admin_kecamatan')
                            <form action="{{ route('admin-kecamatan.pengaturan.update-bio', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @elseif (Auth::user()->role == 'admin_desakel')
                            <form action="{{ route('admin-desakel.pengaturan.update-bio', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @elseif (Auth::user()->role == 'mitra')
                            <form action="{{ route('mitra.pengaturan.update-bio', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @endif
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" >
                                    @error('email')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Hp</label>
                                    <input type="text" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror" value="{{ Auth::user()->nomor_hp }}">
                                    @error('nomor_hp')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror">
                                    @error('alamat')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="hidden" name="foto_lama" value="{{ Auth::user()->foto}}">
                                            <input type="file" name="foto"
                                                class="custom-file-input @error('foto') is-invalid @enderror"
                                                id="foto">
                                            <label class="custom-file-label text-muted" for="foto">Pilih
                                                Foto Baru</label>
                                        </div>
                                        <div class="input-group-append">
                                            <a href="{{ asset(Auth::user()->foto) }}" target="_blank">
                                                <span class="input-group-text"><i class="fas fa-image"></i> &nbsp; Foto</span>
                                            </a>
                                        </div>
                                    </div>
                                    @error('foto')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <button type="reset" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Reset</button>
                                <button type="submit" class="btn btn-sm btn-success show_confirm"><i class="fas fa-save"></i> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        @if (session('success'))
            Swal.fire(
                'Berhasil!',
                '{{ session('success') }}',
                'success'
            )
        @endif

        $('.show_confirm_pass').click(function(event) {
          var form =  $(this).closest("form");
          event.preventDefault();
          Swal.fire({
            title: 'Konfirmasi untuk memperbarui password?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Perbarui!',
            cancelButtonText: 'Batal'
          })
          .then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
          });
        });

        $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          event.preventDefault();
          Swal.fire({
            title: 'Konfirmasi untuk memperbarui informasi akun?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Perbarui!',
            cancelButtonText: 'Batal'
          })
          .then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
          });
        });
    </script>
@endpush