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
                                            <th width="25%">Catatan</th>
                                            <th width="25%">Judul Peraturan</th>
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
                                                <td>{{ $result->catatan }}</td>
                                                <td>{{ $result->peraturan_desa->judul_peraturan }}</td>
                                                @if (Auth::user()->role == 'admin_kabkota' || Auth::user()->role == 'admin_kecamatan' || Auth::user()->role == 'mitra')
                                                    <td>{{ $result->peraturan_desa->user->desa_kelurahan->nama_desa }}</td>
                                                @endif
                                                <td>
                                                    @if ($result->status == '0')
                                                        <span class="badge badge-secondary">
                                                            Belum Ditinjau
                                                            <span class="font-weight-normal">
                                                                oleh Admin Desa/Kelurahan
                                                                 {{-- {{ $result->peraturan_desa->user->desa_kelurahan->nama_desa }} -
                                                                 {{ $result->peraturan_desa->user->name }} --}}
                                                                </span>
                                                        </span>
                                                    @elseif ($result->status == '1')
                                                        <span class="badge badge-warning">
                                                            Sedang Ditinjau
                                                            <span class="font-weight-normal">oleh Admin Desa/Kelurahan 
                                                                {{-- {{ $result->peraturan_desa->user->name }} - {{ $result->peraturan_desa->user->desa_kelurahan->nama_desa }}  --}}
                                                            </span>
                                                        </span>
                                                    @elseif ($result->status == '2')
                                                        <span class="badge badge-info">
                                                            Selesai Ditinjau
                                                            <span class="font-weight-normal">oleh Admin Desa/Kelurahan 
                                                                {{-- {{ $result->peraturan_desa->user->name }} - {{ $result->peraturan_desa->user->desa_kelurahan->nama_desa }}  --}}
                                                            </span>
                                                        </span>
                                                    @elseif ($result->status == '3')
                                                        <span class="badge badge-primary">
                                                            Evaluasi
                                                            <span class="font-weight-normal">oleh Admin Desa/Kelurahan 
                                                                {{-- {{ $result->peraturan_desa->user->name }} - {{ $result->peraturan_desa->user->desa_kelurahan->nama_desa }}  --}}
                                                            </span>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success">
                                                            Selesai
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        @if (Auth::user()->role == 'admin_kabkota')
                                                        <a href="{{ route('admin-kabkota.review-peraturan-desa.detail', $result->id) }}" class="btn btn-sm text-white btn-info mr-2">
                                                        @elseif (Auth::user()->role == 'admin_kecamatan')
                                                        <a href="{{ route('admin-kecamatan.review-peraturan-desa.detail', $result->id) }}" class="btn btn-sm text-white btn-info mr-2">
                                                        @elseif (Auth::user()->role == 'mitra')
                                                        <a href="{{ route('mitra.review-peraturan-desa.detail', $result->id) }}" class="btn btn-sm text-white btn-info mr-2">
                                                        @else
                                                        <a href="{{ route('superadmin.review-peraturan-desa.detail', $result->id) }}" class="btn btn-sm text-white btn-info mr-2">
                                                        @endif
                                                            <i class="fas fa-info-circle"></i> Detail
                                                        </a>
                                                        @if (Auth::user()->role == 'admin_kabkota')
                                                        <form method="POST" action="{{ route('admin-kabkota.review-peraturan-desa.destroy', $result->id) }}">
                                                        @elseif (Auth::user()->role == 'admin_kecamatan')
                                                        <form method="POST" action="{{ route('admin-kecamatan.review-peraturan-desa.destroy', $result->id) }}">
                                                        @elseif (Auth::user()->role == 'mitra')
                                                        <form method="POST" action="{{ route('mitra.review-peraturan-desa.destroy', $result->id) }}">
                                                        @else
                                                        <form method="POST" action="{{ route('superadmin.review-peraturan-desa.destroy', $result->id) }}">
                                                        @endif
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="btn btn-sm btn-danger show_confirm" data-toggle="tooltip" title='Hapus'>
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
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
    </script>
@endpush