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
                        <li class="breadcrumb-item ">
                            @if (Auth::user()->role == 'admin_desakel')
                                <a href="{{ route('admin-desakel.peraturan-desa') }}">
                            @elseif (Auth::user()->role == 'admin_kabkota')
                                <a href="{{ route('admin-kabkota.peraturan-desa') }}">
                            @elseif (Auth::user()->role == 'admin_kecamatan')
                                <a href="{{ route('admin-kecamatan.peraturan-desa') }}">
                            @elseif (Auth::user()->role == 'mitra')
                                <a href="{{ route('mitra.peraturan-desa') }}">
                            @endif
                                {{ $title }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $subtitle }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    @if (Auth::user()->role == 'admin_desakel')
                                        <a href="{{ route('admin-desakel.peraturan-desa') }}" class="text-secondary mr-2">
                                    @elseif (Auth::user()->role == 'admin_kabkota')
                                        <a href="{{ route('admin-kabkota.peraturan-desa') }}" class="text-secondary mr-2">
                                    @elseif (Auth::user()->role == 'admin_kecamatan')
                                        <a href="{{ route('admin-kecamatan.peraturan-desa') }}" class="text-secondary mr-2">
                                    @elseif (Auth::user()->role == 'mitra')
                                        <a href="{{ route('mitra.peraturan-desa') }}" class="text-secondary mr-2">
                                    @endif
                                    <i class="fas fa-arrow-alt-circle-left"></i>
                                    </a>
                                    <h3 class="card-title">Data Peraturan Desa</h3>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="mb-0 small">Diajukan oleh </span>
                                    <span class="border-right mx-2"> &nbsp; </span>
                                    <span class="small text-left font-weight-bold">
                                        Admin Desa Kelurahan <br>
                                        <span class="font-weight-normal">{{ $result->user->desa_kelurahan->nama_desa ?? '' }} - {{ $result->user->name }}</span>
                                    </span>
                                </div>
                                {{-- <div class="d-flex align-items-center">
                                    <span class="mb-0 mr-2">Uploaded by </span>
                                    <span class="badge badge-primary">{{ $result->user->name }}</span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-7">
                                    <div class="form-group">
                                        <label>Desa Kelurahan</label>
                                        <p>{{ $result->user->desa_kelurahan->nama_desa }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Judul Peraturan</label>
                                        <p>{{ $result->judul_peraturan }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Peraturan</label>
                                        <p>{{ $result->jenis_peraturan->jenis_aturan }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Isi Peraturan</label>
                                        <p>{{ $result->isi_peraturan }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <a href="{{ asset($result->file) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary"><i class="fas fa-file-alt"></i> File
                                                Peraturan</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Penyusun</label>
                                        <p>{{ $result->nama_penyusun }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div>
                                            @if (Auth::user()->role == 'admin_kabkota')
                                                @include('partials.status-perdes-by-kabkota')
                                            @elseif (Auth::user()->role == 'admin_kecamatan')
                                                @include('partials.status-perdes-by-kecamatan')
                                            @elseif (Auth::user()->role == 'mitra')
                                                @include('partials.status-perdes-by-mitra')
                                            @else
                                                @include('partials.status-perdes-by-kabkota')
                                                @include('partials.status-perdes-by-kecamatan')
                                                @include('partials.status-perdes-by-mitra')
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="text-secondary mr-2">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                    <h3 class="card-title">{{ $subtitle }}</h3>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="mb-0 small">Ditinjau oleh </span>
                                    <span class="border-right mx-2"> &nbsp; </span>
                                    <span class="small text-left font-weight-bold">
                                        @if (Auth::user()->role == 'admin_kabkota')
                                            Admin Desa Kabupaten/Kota <br>
                                            <span class="font-weight-normal">{{ Auth::user()->kabupaten_kota->nama_kabupaten_kota ?? '' }} - {{  Auth::user()->name }}</span>
                                        @elseif (Auth::user()->role == 'admin_kecamatan')
                                            Admin Desa Kecamatan <br>
                                            <span class="font-weight-normal">{{ Auth::user()->kecamatan->nama_kecamatan ?? '' }} - {{  Auth::user()->name }}</span>
                                        @elseif (Auth::user()->role == 'mitra')
                                            Admin Mitra <br>
                                            <span class="font-weight-normal">{{  Auth::user()->name }}</span>
                                        @endif
                                    </span>
                                </div>
                                {{-- <div class="d-flex align-items-center">
                                    <span class="mb-0 mr-2">Reviewed by </span>
                                    <span class="badge badge-primary">{{ Auth::user()->name }}</span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->role == 'admin_kabkota')
                                <form action="{{ route('admin-kabkota.review-peraturan-desa.store') }}" method="post" enctype="multipart/form-data">
                            @elseif (Auth::user()->role == 'admin_kecamatan')
                                <form action="{{ route('admin-kecamatan.review-peraturan-desa.store') }}" method="post" enctype="multipart/form-data">
                            @elseif (Auth::user()->role == 'mitra')
                                <form action="{{ route('mitra.review-peraturan-desa.store') }}" method="post" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <input type="hidden" name="peraturan_desa_id" value="{{ $result->id }}">
                                <div class="form-group">
                                    <label for="catatan">Catatan <span class="text-danger">*</span></label>
                                    <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" placeholder="Catatan : ....""></textarea>
                                    @error('catatan')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>File</label>
                                    <div class="custom-file">
                                        <input type="file" name="file_review"
                                            class="custom-file-input @error('file_review') is-invalid @enderror"
                                            id="file_review">
                                        <label class="custom-file-label text-muted" for="file_review">Pilih
                                            file</label>
                                    </div>
                                    @error('file_review')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="link_tautan">Link Tautan</label>
                                    <input type="text" name="link_tautan" id="link_tautan" class="form-control @error('link_tautan') is-invalid @enderror" value="{{ old('link_tautan') }}" placeholder="https://">
                                    @error('link_tautan')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <button type="reset" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-paper-plane"></i> Kirim Tinjauan
                                </button>
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

    @if (Auth::user()->role == 'admin_kabkota')
        <script>
            
        </script>
    @endif
@endpush
