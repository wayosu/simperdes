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
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title">Data {{ $title }}</h3>
                                <a href="{{ route('superadmin.provinsi.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table id="example1" class="table table-sm table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="75%">Provinsi</th>
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($provinsis as $result)  
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $result->nama_provinsi }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('superadmin.provinsi.edit', $result->id) }}"
                                                    class="btn btn-sm text-white btn-warning mr-2"><i
                                                    class="fas fa-edit"></i> Edit</a>
                                                    <form method="POST" action="{{ route('superadmin.provinsi.destroy', $result->id) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn btn-sm btn-danger show_confirm" data-toggle="tooltip" title='Hapu'><i
                                                            class="fas fa-trash"></i> Hapus</button>
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
        @endif

        $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
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
