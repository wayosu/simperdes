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
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Alamat</label>
                                <p>{{ $data->alamat ?? '' }}</p>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <p>{{ $data->email ?? '' }}</p>
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <p>{{ $data->telepon ?? '' }}</p>
                            </div>
                            <div class="form-group">
                                <label>Sosial Media</label>
                                <div class="d-flex">
                                    <a href="{{ $data->link_facebook ?? '' }}" class="btn btn-sm text-white mr-2" target="_blank" style="background-color: #1877f2;"><i class="fab fa-facebook"></i></a>
                                    <a href="{{ $data->link_instagram ?? '' }}" class="btn btn-sm text-white mr-2" target="_blank" style="background-color: #c32aa3;"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ $data->link_twitter ?? '' }}" class="btn btn-sm text-white" target="_blank" style="background-color: #1da1f2;"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Google Maps</label>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe src="{{ $data->link_gmaps ?? '' }}" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="embed-responsive-item"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title"><i class="fas fa-info-circle fa-xs"></i> Tentang Kami</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('superadmin.tentang-kami.update', $data->id) }}" method="post">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label>Alamat <span class="text-danger">*</span></label>
                                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $data->alamat ?? '' }}">
                                    @error('alamat')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $data->email ?? '' }}" >
                                    @error('email')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Telepon <span class="text-danger">*</span></label>
                                    <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ $data->telepon ?? '' }}">
                                    @error('telepon')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="link_facebook" class="form-control @error('link_facebook') is-invalid @enderror" value="{{ $data->link_facebook ?? '' }}">
                                    @error('link_facebook')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="link_instagram" class="form-control @error('link_instagram') is-invalid @enderror" value="{{ $data->link_instagram ?? '' }}">
                                    @error('link_instagram')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" name="link_twitter" class="form-control @error('link_twitter') is-invalid @enderror" value="{{ $data->link_twitter ?? '' }}">
                                    @error('link_twitter')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Google Maps <span class="text-danger">*</span></label>
                                    <input type="text" name="link_gmaps" class="form-control @error('link_gmaps') is-invalid @enderror" value="{{ $data->link_gmaps ?? '' }}">
                                    @error('link_gmaps')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <button type="reset" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Reset</button>
                                <button type="submit" class="btn btn-sm btn-success show_confirm"><i class="fas fa-save"></i> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
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
            title: 'Konfirmasi untuk memperbarui informasi tentang kami?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Perbarui!',
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