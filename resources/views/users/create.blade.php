@extends('layouts.app')

@push('styles')
    @include('plugins.select2-css')
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{ route('superadmin.users') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active">{{ $subtitle }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('superadmin.users') }}" class="text-secondary mr-2"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                                <h3 class="card-title">Form {{ $subtitle }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('superadmin.users.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_petugas">Nama Petugas <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_petugas" id="nama_petugas"
                                                class="form-control @error('nama_petugas') is-invalid @enderror"
                                                value="{{ old('nama_petugas') }}" placeholder="Nama Petugas">
                                            @error('nama_petugas')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tipe_user">Tipe User <span class="text-danger">*</span></label>
                                            <select name="role" id="tipe_user"
                                                class="form-control @error('role') is-invalid @enderror"
                                                style="width: 100%;">
                                                <option value="" hidden disabled selected>-- Pilih Tipe User --
                                                </option>
                                                <option value="3">Admin Kabupaten Kota</option>
                                                <option value="2">Admin Kecamatan</option>
                                                <option value="1">Admin Desa Kelurahan</option>
                                                <option value="0">Admin Mitra</option>
                                            </select>
                                            @error('role')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div id="selectRegionUser3" class="region-user">
                                            <div class="form-group">
                                                <label for="kabupaten_kota_id">Kabupaten Kota <span class="text-danger">*</span></label>
                                                <select name="kabupaten_kota_id" id="kabupaten_kota_id" class="form-control select2 @error('kabupaten_kota_id') is-invalid @enderror" style="width: 100%;">
                                                    <option value="" hidden disabled selected>-- Pilih Kabupaten Kota --</option>
                                                    @foreach ($kabupaten_kotas as $result)
                                                        <option value="{{ $result->id }}">{{ $result->nama_kabupaten_kota }}, {{ $result->provinsi->nama_provinsi }}</option>
                                                    @endforeach
                                                </select>
                                                @error('kabupaten_kota_id')
                                                    <span class="error invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div id="selectRegionUser2" class="region-user">
                                            <div class="form-group">
                                                <label for="kecamatan_id">Kecamatan <span class="text-danger">*</span></label>
                                                <select name="kecamatan_id" id="kecamatan_id" class="form-control select2 @error('kecamatan_id') is-invalid @enderror" style="width: 100%;">
                                                    <option value="" hidden disabled selected>-- Pilih Kecamatan --</option>
                                                    @foreach ($kecamatans as $result)
                                                        <option value="{{ $result->id }}">{{ $result->nama_kecamatan }}, {{ $result->kabupaten_kota->nama_kabupaten_kota }}, {{ $result->kabupaten_kota->provinsi->nama_provinsi }}</option>
                                                    @endforeach
                                                </select>
                                                @error('kecamatan_id')
                                                    <span class="error invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div id="selectRegionUser1" class="region-user">
                                            <div class="form-group">
                                                <label for="desa_kelurahan_id">Desa Kelurahan <span class="text-danger">*</span></label>
                                                <select name="desa_kelurahan_id" id="desa_kelurahan_id" class="form-control select2 @error('desa_kelurahan_id') is-invalid @enderror" style="width: 100%;">
                                                    <option value="" hidden disabled selected>-- Pilih Kecamatan --</option>
                                                    @foreach ($desa_kelurahans as $result)
                                                        <option value="{{ $result->id }}">{{ $result->nama_desa }}, {{ $result->kecamatan->nama_kecamatan }}, {{ $result->kecamatan->kabupaten_kota->nama_kabupaten_kota }}, {{ $result->kecamatan->kabupaten_kota->provinsi->nama_provinsi }}</option>
                                                    @endforeach
                                                </select>
                                                @error('desa_kelurahan_id')
                                                    <span class="error invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" placeholder="example@example.com">
                                            @error('email')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                value="{{ old('password') }}" placeholder="...">
                                            @error('password')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="nomor_hp">Nomor HP</label>
                                            <input type="text" name="nomor_hp" id="nomor_hp"
                                                class="form-control @error('nomor_hp') is-invalid @enderror"
                                                value="{{ old('nomor_hp') }}" placeholder="+62 ...">
                                            @error('nomor_hp')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" name="alamat" id="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror"
                                                value="{{ old('alamat') }}" placeholder="Jl. Example">
                                            @error('alamat')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <div class="custom-file">
                                                <input type="file" name="foto"
                                                    class="custom-file-input @error('foto') is-invalid @enderror"
                                                    id="foto">
                                                <label class="custom-file-label text-muted" for="foto">Pilih
                                                    foto</label>
                                            </div>
                                            @error('foto')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="reset" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i>
                                    Reset</button>
                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>
                                    Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @include('plugins.select2-js')

    <script>
        $(document).ready(function() {
            $('div.region-user').hide();
            $('#tipe_user').on('change', function() {
                let tipeUser = $(this).val();
                $('div.region-user').hide();
                $('#selectRegionUser'+tipeUser).show();               
            });
        });
    </script>
@endpush
