@extends('layouts.app')

@push('styles')
    @include('plugins.datatables-css')
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
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if (Auth::user()->role == 'admin_desakel')
                                <div class="d-flex align-items-center justify-content-between">
                                    <h3 class="card-title">Data {{ $title }}</h3>
                                    <a href="{{ route('admin-desakel.peraturan-desa.create') }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                                </div>
                            @else
                                <h3 class="card-title">Data {{ $title }}</h3>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-sm table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="25%">Judul Peraturan</th>
                                            <th width="15%">Jenis Peraturan</th>
                                            <th width="15%">Nama Penyusun</th>
                                            @if (Auth::user()->role == 'admin_kabkota' || Auth::user()->role == 'admin_kecamatan' || Auth::user()->role == 'mitra')
                                                <th width="17%">Desa Kelurahan</th>
                                            @endif
                                            <th width="10%">Status</th>
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $result)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $result->judul_peraturan }}</td>
                                                <td>{{ $result->jenis_peraturan->jenis_aturan }}</td>
                                                <td>{{ $result->nama_penyusun }}</td>
                                                @if (Auth::user()->role == 'admin_kabkota' ||
                                                        Auth::user()->role == 'admin_kecamatan' ||
                                                        Auth::user()->role == 'mitra')
                                                    <td>{{ $result->user->desa_kelurahan->nama_desa }}</td>
                                                @endif
                                                <td>
                                                    @if (Auth::user()->role == 'admin_kabkota')
                                                        @include('partials.status-perdes-by-kabkota')
                                                    @elseif (Auth::user()->role == 'admin_kecamatan')
                                                        @include('partials.status-perdes-by-kecamatan')
                                                    @elseif (Auth::user()->role == 'mitra')
                                                        @include('partials.status-perdes-by-mitra')
                                                    @else
                                                        @include('partials.status-perdes-by-all')
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        @if (Auth::user()->role == 'superadmin')
                                                            <a href="{{ route('superadmin.peraturan-desa.detail', $result->id) }}" class="btn btn-sm text-white btn-info mr-2">
                                                                <i class="fas fa-info-circle"></i> Detail
                                                            </a>
                                                        @elseif (Auth::user()->role == 'admin_desakel')
                                                            <a href="{{ route('admin-desakel.peraturan-desa.detail', $result->id) }}" class="btn btn-sm text-white btn-info mr-2">
                                                                <i class="fas fa-info-circle"></i> Detail
                                                            </a>
                                                            <a href="{{ route('admin-desakel.peraturan-desa.edit', $result->id) }}" class="btn btn-sm text-white btn-warning mr-2">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <form method="POST" action="{{ route('admin-desakel.peraturan-desa.destroy', $result->id) }}">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button type="submit" class="btn btn-sm btn-danger show_confirm" data-toggle="tooltip" title='Hapus'>
                                                                    <i class="fas fa-trash"></i> Hapus
                                                                </button>
                                                            </form>
                                                        @elseif (Auth::user()->role == 'admin_kabkota')
                                                            @if ($result->status_admin_kabkota == '0')
                                                                <form action="{{ route('admin-kabkota.peraturan-desa.status', $result->id) }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="1">
                                                                    <button type="submit" class="btn btn-sm text-white btn-warning konfirmasi_periksa"><i class="fas fa-search"></i> Tinjau</button>
                                                                </form>
                                                            @elseif ($result->status_admin_kabkota == '1')
                                                                <a href="{{ route('admin-kabkota.peraturan-desa.review', $result->id) }}" class="btn btn-sm btn-warning mr-2">
                                                                    <i class="fas fa-edit"></i> Tinjau Peraturan Desa
                                                                </a>
                                                            @else
                                                                <a href="{{ route('admin-kabkota.peraturan-desa.detail', $result->id) }}" class="btn btn-sm text-white btn-info mr-2">
                                                                    <i class="fas fa-info-circle"></i> Detail
                                                                </a>
                                                            @endif
                                                        @elseif (Auth::user()->role == 'admin_kecamatan')
                                                            @if ($result->status_admin_kecamatan == '0')
                                                                <form action="{{ route('admin-kecamatan.peraturan-desa.status', $result->id) }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="1">
                                                                    <button type="submit" class="btn btn-sm text-white btn-warning konfirmasi_periksa"><i class="fas fa-search"></i> Tinjau</button>
                                                                </form>
                                                            @elseif ($result->status_admin_kecamatan == '1')
                                                                <a href="{{ route('admin-kecamatan.peraturan-desa.review', $result->id) }}" class="btn btn-sm btn-warning mr-2">
                                                                    <i class="fas fa-edit"></i> Tinjau Peraturan Desa
                                                                </a>
                                                            @else
                                                                <a href="{{ route('admin-kecamatan.peraturan-desa.detail', $result->id) }}" class="btn btn-sm text-white btn-info mr-2">
                                                                    <i class="fas fa-info-circle"></i> Detail
                                                                </a>
                                                            @endif
                                                        @elseif (Auth::user()->role == 'mitra')
                                                            @if ($result->status_admin_mitra == '0')
                                                                <form action="{{ route('mitra.peraturan-desa.status', $result->id) }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="1">
                                                                    <button type="submit" class="btn btn-sm text-white btn-warning konfirmasi_periksa"><i class="fas fa-search"></i> Tinjau</button>
                                                                </form>
                                                            @elseif ($result->status_admin_mitra == '1')
                                                                <a href="{{ route('mitra.peraturan-desa.review', $result->id) }}" class="btn btn-sm btn-warning mr-2">
                                                                    <i class="fas fa-edit"></i> Tinjau Peraturan Desa
                                                                </a>
                                                            @else
                                                                <a href="{{ route('mitra.peraturan-desa.detail', $result->id) }}" class="btn btn-sm text-white btn-info mr-2">
                                                                    <i class="fas fa-info-circle"></i> Detail
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @include('plugins.datatables-js')

    <script>
        @if (Auth::user()->role == 'admin_kabkota' || Auth::user()->role == 'admin_kecamatan' || Auth::user()->role == 'mitra')
            $('.konfirmasi_periksa').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                        title: 'Konfirmasi untuk meninjau Peraturan Desa?',
                        text: 'Ini akan dilanjutkan ke tahapan Tinjauan Peraturan Desa!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Tinjau!',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
            });
        @endif

        @if (Auth::user()->role == 'admin_desakel')
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
            $('.show_confirm').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Ini akan menghapus data yang dipilih!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
            });
        @endif
    </script>
@endpush
