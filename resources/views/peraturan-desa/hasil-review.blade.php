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
                                <a href="{{ route('admin-desakel.peraturan-desa') }}">{{ $title }}</a>
                            @elseif (Auth::user()->role == 'admin_kabkota')
                                <a href="{{ route('admin-kabkota.peraturan-desa') }}">{{ $title }}</a>
                            @endif
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
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    @if (Auth::user()->role == 'superadmin')
                                        <a href="{{ route('superadmin.peraturan-desa.detail', $result->peraturan_desa_id) }}"
                                            class="text-secondary mr-2">
                                        @elseif (Auth::user()->role == 'admin_desakel')
                                            <a href="{{ route('admin-desakel.peraturan-desa.detail', $result->peraturan_desa_id) }}"
                                                class="text-secondary mr-2">
                                    @endif
                                    <i class="fas fa-arrow-alt-circle-left"></i>
                                    </a>
                                    <h3 class="card-title">{{ $subtitle }}</h3>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="mb-0 small">Ditinjau oleh </span>
                                    <span class="border-right mx-2"> &nbsp; </span>
                                    <span class="small text-left font-weight-bold">
                                        @if ($result->user->role == 'admin_kabkota')
                                            Admin Kabupaten/Kota
                                        @elseif ($result->user->role == 'admin_kecamatan')
                                            Admin Kecamatan
                                        @elseif ($result->user->role == 'mitra')
                                            Admin Mitra
                                        @endif 
                                        <br>
                                        <span class="font-weight-normal">
                                            @if ($result->user->role == 'admin_kabkota')
                                                {{ $result->user->kabupaten_kota->nama_kabupaten_kota }} -
                                            @elseif ($result->user->role == 'admin_kecamatan')
                                                {{ $result->user->kecamatan->nama_kecamatan }} -
                                            @endif
                                            {{ $result->user->name }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>File</label>
                                        <div>
                                            <a href="@if ($result->file != null) {{ asset($result->file) }} @else # @endif" 
                                                @if ($result->file != null)
                                                target="_blank"
                                                @endif
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-alt"></i>
                                                File Review
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>Link Tautan</label>
                                        <div>
                                            <a href="{{ $result->link_tautan ?? '#' }}" class="btn btn-sm btn-outline-primary">
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
                                            @if ($result->status == '0')
                                                <span class="badge badge-secondary">
                                                    Belum Diperiksa
                                                </span>
                                            @elseif ($result->status == '1')
                                                <span class="badge badge-warning">
                                                    Sedang Diperiksa
                                                </span>
                                            @elseif ($result->status == '2')
                                                <span class="badge badge-info">
                                                    Sudah Diperiksa
                                                </span>
                                            @elseif ($result->status == '3')
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
                                <p>{{ $result->catatan }}</p>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <form action="{{ route('admin-desakel.batal-periksa', $result->id) }}" method="post" class="mr-2">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger btn-block"><i class="fas fa-times"></i> Batal Periksa</button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('admin-desakel.lanjut-evaluasi', $result->id) }}" method="post">
                                        @csrf
                                        @if ($result->user->role == 'admin_kabkota')
                                        <input type="hidden" name="tipe_admin" value="admin_kabkota">
                                        @elseif ($result->user->role == 'admin_kecamatan')
                                        <input type="hidden" name="tipe_admin" value="admin_kecamatan">
                                        @elseif ($result->user->role == 'mitra') 
                                        <input type="hidden" name="tipe_admin" value="mitra">
                                        @endif
                                        <button type="submit" class="btn btn-sm btn-primary btn-block"><i class="fas fa-arrow-right"></i> Lanjut Evaluasi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
