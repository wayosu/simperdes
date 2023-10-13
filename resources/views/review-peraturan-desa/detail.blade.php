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
                        <li class="breadcrumb-item ">
                            @if (Auth::user()->role == 'superadmin')
                                <a href="{{ route('superadmin.review-peraturan-desa') }}">
                            @elseif (Auth::user()->role == 'admin_kabkota')
                                <a href="{{ route('admin-kabkota.review-peraturan-desa') }}">
                            @elseif (Auth::user()->role == 'admin_kecamatan')
                                <a href="{{ route('admin-kecamatan.review-peraturan-desa') }}">
                            @elseif (Auth::user()->role == 'mitra')
                                <a href="{{ route('mitra.review-peraturan-desa') }}">
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

            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    @if (Auth::user()->role == 'superadmin')
                                        <a href="{{ route('superadmin.review-peraturan-desa') }}" class="text-secondary mr-2">
                                    @elseif (Auth::user()->role == 'admin_kabkota')
                                        <a href="{{ route('admin-kabkota.review-peraturan-desa') }}" class="text-secondary mr-2">
                                    @elseif (Auth::user()->role == 'admin_kecamatan')
                                        <a href="{{ route('admin-kecamatan.review-peraturan-desa') }}" class="text-secondary mr-2">
                                    @elseif (Auth::user()->role == 'mitra')
                                        <a href="{{ route('mitra.review-peraturan-desa') }}" class="text-secondary mr-2">
                                    @endif
                                        <i class="fas fa-arrow-alt-circle-left"></i>
                                    </a>
                                    <h3 class="card-title">Detail Peraturan Desa</h3>
                                </div>
                                <span class="border-bottom d-inline d-md-none my-2 m-md-0"></span>
                                <div class="d-flex align-items-center">
                                    <span class="mb-0 small">Diajukan oleh</span>
                                    <span class="border-right mx-2"> &nbsp; </span>
                                    <span class="small text-left font-weight-bold">
                                        Admin Desa Kelurahan <br>
                                        <span class="font-weight-normal">{{ $result->user->desa_kelurahan->nama_desa ?? '' }} - {{ $result->user->name }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
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
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <a href="@if ($result->file != null) {{ asset($result->file) }} @else # @endif" 
                                                @if ($result->file != null)
                                                target="_blank"
                                                @endif
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
                                                @include('partials.status-perdes-by-all')
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (
                    ($result->status_admin_kabkota == '2' || $result->status_admin_kecamatan == '2' || $result->status_admin_mitra == '2') ||
                    ($result->status_admin_kabkota == '3' || $result->status_admin_kecamatan == '3' || $result->status_admin_mitra == '3') ||
                    ($result->status_admin_kabkota == '4' || $result->status_admin_kecamatan == '4' || $result->status_admin_mitra == '4')
                )
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="text-secondary mr-2">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <h3 class="card-title">{{ $subtitle }}</h3>
                                        </div>
                                        <span class="border-bottom d-inline d-md-none my-2 m-md-0"></span>
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
                                            <span class="mb-0 mr-2">Tinjauan Dari </span>
                                            <span class="badge badge-primary">{{ Auth::user()->name }}</span>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label>File</label>
                                                <div>
                                                    <a href="@if ($review->file != null) {{ asset($review->file)}} @else # @endif" 
                                                        @if ($review->file != null)
                                                        target="_blank" 
                                                        @endif
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-file-alt"></i>
                                                        File Tinjauan
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label>Link Tautan</label>
                                                <div>
                                                    <a href="{{ $review->link_tautan }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-link"></i>
                                                        Link Tautan
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div>
                                                    @if ($review->status == '0')
                                                        <span class="badge badge-secondary">
                                                            Belum Ditinjau
                                                            <span class="font-weight-normal">by {{ $review->peraturan_desa->user->name }}</span>
                                                        </span>
                                                    @elseif ($review->status == '1')
                                                        <span class="badge badge-warning">
                                                            Sedang Ditinjau
                                                            <span class="font-weight-normal">by {{ $review->peraturan_desa->user->name }}</span>
                                                        </span>
                                                    @elseif ($review->status == '2')
                                                        <span class="badge badge-info">
                                                            Selesai Ditinjau
                                                            <span class="font-weight-normal">by {{ $review->peraturan_desa->user->name }}</span>
                                                        </span>
                                                    @elseif ($review->status == '3')
                                                        <span class="badge badge-danger">
                                                            Evaluasi
                                                            <span class="font-weight-normal">by {{ $review->peraturan_desa->user->name }}</span>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success">
                                                            Selesai
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <p>{{ $review->catatan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            @if (count($log_review) > 0)
                                <div class="my-3">
                                    <hr class="m-0">
                                    <div class="px-2 py-2">
                                        <div class="d-flex flex-column flex-md-row justify-content-between aling-items-center my-2">
                                            <h6 class="m-0"><i class="fas fa-th-list"></i>&nbsp; Log Tinjauan Peraturan Desa Sebelumnya</h6>
                                            <p class="mt-2 mb-0 m-md-0 small">Total Log : {{ count($log_review) }}</p>
                                        </div>
                                    </div>
                                    <hr class="m-0">
                                </div>
                                @foreach ($log_review as $key => $lr)
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse{{ $key }}">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex aling-items-center">
                                                        <span class="text-white mr-2">
                                                            <i class="far fa-circle fa-xs"></i>
                                                        </span>
                                                        <span>
                                                            Tinjauan {{ $key + 1 }}
                                                        </span>
                                                    </div>
                                                    <span class="text-sm">
                                                        <i class="fas fa-calendar-alt fa-sm"></i> {{ $lr->updated_at->format('d M Y H:i') }}
                                                    </span>
                                                </div>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{ $key }}" class="collapse">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group">
                                                        <label>File</label>
                                                        <div>
                                                            <a href="@if ($lr->file != null) {{ asset($lr->file)}} @else # @endif" 
                                                                @if ($lr->file != null) 
                                                                    target="_blank" 
                                                                @endif
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-file-alt"></i>
                                                                File Tinjauan
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Link Tautan</label>
                                                        <div>
                                                            <a href="{{ $lr->link_tautan }}" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-link"></i>
                                                                Link Tautan
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <div>
                                                            @if ($lr->status == '0')
                                                                <span class="badge badge-secondary">
                                                                    Belum Ditinjau
                                                                </span>
                                                            @elseif ($lr->status == '1')
                                                                <span class="badge badge-warning">
                                                                    Sedang Ditinjau
                                                                </span>
                                                            @elseif ($lr->status == '2')
                                                                <span class="badge badge-info">
                                                                    Selesai Ditinjau
                                                                </span>
                                                            @elseif ($lr->status == '3')
                                                                <span class="badge badge-danger">
                                                                    Evaluasi
                                                                </span>
                                                            @else
                                                                <span class="badge badge-success">
                                                                    Selesai
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Catatan</label>
                                                <p>{{ $lr->catatan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
