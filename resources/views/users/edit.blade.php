@extends('layouts.app')

@push('styles')
    {{-- @include('plugins.select2-css') --}}
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
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('superadmin.users') }}" class="text-secondary mr-2"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                                <h3 class="card-title">Form {{ $subtitle }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('superadmin.users.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="nama_petugas">Nama Petugas</label>
                                            <input type="text" name="nama_petugas" id="nama_petugas"
                                                class="form-control @error('nama_petugas') is-invalid @enderror"
                                                value="{{ old('nama_petugas', $data->name) }}" placeholder="Nama Petugas">
                                            @error('nama_petugas')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $data->email) }}" placeholder="example@example.com">
                                            @error('email')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_hp">Nomor HP</label>
                                            <input type="text" name="nomor_hp" id="nomor_hp"
                                                class="form-control @error('nomor_hp') is-invalid @enderror"
                                                value="{{ old('nomor_hp', $data->nomor_hp) }}" placeholder="+62 ...">
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
                                                value="{{ old('alamat', $data->alamat) }}" placeholder="Jl. Example">
                                            @error('alamat')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <div class="my-2">
                                                <img src="{{ asset($data->foto) }}" alt="foto" width="250">
                                            </div>
                                            <div class="custom-file">
                                                <input type="hidden" name="foto_lama" value="{{ $data->foto }}">
                                                <input type="file" name="foto"
                                                    class="custom-file-input @error('foto') is-invalid @enderror"
                                                    id="foto">
                                                <label class="custom-file-label text-muted" for="foto">Pilih
                                                        foto baru</label>
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
                                    Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- @include('plugins.select2-js') --}}
@endpush
