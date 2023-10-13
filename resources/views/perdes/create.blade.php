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
                        <li class="breadcrumb-item "><a href="{{ route('admin-desakel.perdes') }}">{{ $title }}</a></li>
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
                                <a href="{{ route('admin-desakel.perdes') }}" class="text-secondary mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                                <h3 class="card-title">Form {{ $subtitle }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin-desakel.perdes.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="judul_peraturan">Judul Peraturan <span class="text-danger">*</span></label>
                                    <input type="text" name="judul_peraturan" id="judul_peraturan" class="form-control @error('judul_peraturan') is-invalid @enderror" value="{{ old('judul_peraturan') }}" placeholder="...">
                                    @error('judul_peraturan')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jenis_peraturan">Jenis Peraturan <span class="text-danger">*</span></label>
                                    <select name="jenis_peraturan_id" id="jenis_peraturan_id" class="form-control select2 @error('jenis_peraturan_id') is-invalid @enderror" style="width: 100%;">
                                        <option value="" hidden disabled selected>-- Pilih Jenis Peraturan --</option>
                                        @foreach ($jenis_peraturans as $result)
                                            <option value="{{ $result->id }}">{{ $result->jenis_aturan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_peraturan_id')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="isi_peraturan">Isi Peraturan <span class="text-danger">*</span></label>
                                    <textarea name="isi_peraturan" id="isi_peraturan" class="form-control @error('isi_peraturan') is-invalid @enderror"></textarea>
                                    @error('isi_peraturan')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>File <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="file_peraturan"
                                            class="custom-file-input @error('file_peraturan') is-invalid @enderror"
                                            id="file_peraturan">
                                        <label class="custom-file-label text-muted" for="file_peraturan">Pilih
                                            file</label>
                                    </div>
                                    @error('file_peraturan')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_penyusun">Nama Penyusun <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penyusun" id="nama_penyusun" class="form-control @error('nama_penyusun') is-invalid @enderror" value="{{ old('nama_penyusun') }}" placeholder="...">
                                    @error('nama_penyusun')
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