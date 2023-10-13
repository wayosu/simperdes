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
                            @if (Auth::user()->role == 'admin_desakel')
                                <a href="{{ route('admin-desakel.peraturan-desa') }}">
                                @elseif (Auth::user()->role == 'admin_kabkota')
                                    <a href="{{ route('admin-kabkota.peraturan-desa') }}">
                                    @elseif (Auth::user()->role == 'admin_kecamatan')
                                        <a href="{{ route('admin-kecamatan.peraturan-desa') }}">
                                        @elseif (Auth::user()->role == 'mitra')
                                            <a href="{{ route('mitra.peraturan-desa') }}">
                                            @else
                                                <a href="{{ route('superadmin.peraturan-desa') }}">
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
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    @if (Auth::user()->role == 'admin_desakel')
                                        <a href="{{ route('admin-desakel.perdes') }}" class="text-secondary mr-2">
                                            <i class="fas fa-arrow-alt-circle-left"></i>
                                        </a>
                                    @else
                                        {{-- <a href="{{ route('superadmin.peraturan-desa') }}"
                                                    class="text-secondary mr-2">
                                                    <i class="fas fa-arrow-alt-circle-left"></i>
                                                </a> --}}
                                    @endif
                                    <h3 class="card-title">{{ $subtitle }}</h3>
                                </div>
                                <span class="border-bottom d-inline d-md-none my-2 m-md-0"></span>
                                <div class="d-flex align-items-center">
                                    <span class="mb-0 small">Diunggah oleh </span>
                                    <span class="border-right mx-2"> &nbsp; </span>
                                    <span class="small text-left font-weight-bold">
                                        Admin Desa Kelurahan <br>
                                        <span
                                            class="font-weight-normal">{{ $result->user->desa_kelurahan->nama_desa ?? '' }}
                                            - {{ $result->user->name }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-7">
                                    <div class="form-group">
                                        <label>Judul Peraturan</label>
                                        <p>{{ $result->judul_peraturan }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Peraturan</label>
                                        <p>{{ $result->jenis_peraturan->jenis_aturan }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <a href="{{ asset($result->file) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-alt"></i> File Peraturan
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Penyusun</label>
                                        <p>{{ $result->nama_penyusun }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Isi Peraturan</label>
                                        <div class="px-3 py-2"
                                            style="background-color: rgba(0, 123, 255, .2)">
                                            <p class="mb-0">{{ $result->isi_peraturan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

@if (Auth::user()->role == 'admin_desakel' || Auth::user()->role == 'superadmin')
    @push('scripts')
        <script>
            @if (session('success'))
                Swal.fire(
                    'Berhasil!',
                    '{{ session('success') }}',
                    'success'
                )
            @elseif (session('error'))
                Swal.fire(
                    'Gagal!',
                    '{{ session('error') }}',
                    'error'
                )
            @endif
        </script>
    @endpush
@endif
