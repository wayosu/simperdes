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
                        <li class="breadcrumb-item "><a href="{{ route('superadmin.kabupaten-kota') }}">{{ $title }}</a></li>
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
                                <a href="{{ route('superadmin.kabupaten-kota') }}" class="text-secondary mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                                <h3 class="card-title">Form {{ $subtitle }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('superadmin.kabupaten-kota.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_kabupaten_kota">Nama Kabupaten Kota</label>
                                    <input type="text" name="nama_kabupaten_kota" id="nama_kabupaten_kota" class="form-control @error('nama_kabupaten_kota') is-invalid @enderror" value="{{ old('nama_kabupaten_kota') }}" placeholder="...">
                                    @error('nama_kabupaten_kota')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="provinsi_id">Provinsi</label>
                                    <select name="provinsi_id" id="provinsi_id" class="form-control select2 @error('provinsi_id') is-invalid @enderror" style="width: 100%;">
                                        <option value="" hidden disabled selected>-- Pilih Provinsi --</option>
                                        @foreach ($provinsis as $result)
                                            <option value="{{ $result->id }}">{{ $result->nama_provinsi }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi_id')
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