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
                        <li class="breadcrumb-item "><a href="{{ route('superadmin.desa-kelurahan') }}">{{ $title }}</a></li>
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
                                <a href="{{ route('superadmin.desa-kelurahan') }}" class="text-secondary mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                                <h3 class="card-title">Form {{ $subtitle }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('superadmin.desa-kelurahan.update', $data->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="nama_desa_kelurahan">Nama Desa Kelurahan</label>
                                    <input type="text" name="nama_desa_kelurahan" id="nama_desa_kelurahan" class="form-control @error('nama_desa_kelurahan') is-invalid @enderror" value="{{ old('nama_desa_kelurahan', $data->nama_desa) }}" placeholder="...">
                                    @error('nama_desa_kelurahan')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_kepala_desa">Nama Kepala Desa</label>
                                    <input type="text" name="nama_kepala_desa" id="nama_kepala_desa" class="form-control @error('nama_kepala_desa') is-invalid @enderror" value="{{ old('nama_kepala_desa', $data->nama_kepala_desa) }}" placeholder="...">
                                    @error('nama_kepala_desa')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan_id">Kecamatan</label>
                                    <select name="kecamatan_id" id="kecamatan_id" class="form-control select2 @error('kecamatan_id') is-invalid @enderror" style="width: 100%;">
                                        <option value="" hidden disabled selected>-- Pilih Kabupaten Kota --</option>
                                        @foreach ($kecamatans as $result)
                                            <option value="{{ $result->id }}" @if($data->kecamatan_id == $result->id) selected @endif>{{ $result->nama_kecamatan }}, {{ $result->kabupaten_kota->nama_kabupaten_kota }}, {{ $result->kabupaten_kota->provinsi->nama_provinsi }}</option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan_id')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <button type="reset" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Reset</button>
                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Simpan</button>
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
@endpush