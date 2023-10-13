@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ $title }}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-success py-2">
                        <h5 class="mb-0">Welcome, <b>{{ Auth::user()->name }}!</b></h5>
                      </div>
                </div>
            </div>

            @if (Auth::user()->role == 'superadmin')
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_provinsi ?? '' }}</h3>

                            <p>Provinsi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-globe-asia"></i>
                        </div>
                        <a href="{{ route('superadmin.provinsi') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $total_kabkota ?? '' }}</h3>

                            <p>Kabupatan Kota</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-archway"></i>
                        </div>
                        <a href="{{ route('superadmin.kabupaten-kota') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_kecamatan ?? '' }}</h3>

                            <p>Kecamatan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-sign"></i>
                        </div>
                        <a href="{{ route('superadmin.kecamatan') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $total_desakel ?? '' }}</h3>

                            <p>Desa Kelurahan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-map-signs"></i>
                        </div>
                        <a href="{{ route('superadmin.desa-kelurahan') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number">{{ $total_user ?? '' }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="fas fa-list"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jenis Peraturan Desa</span>
                            <span class="info-box-number">{{ $total_jpd ?? '' }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="fas fa-file-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Peraturan Desa</span>
                            <span class="info-box-number">{{ $total_pd ?? '' }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="fas fa-file-signature"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Review Peraturan Desa</span>
                            <span class="info-box-number">{{ $total_rpd ?? '' }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
            @endif

            @if (Auth::user()->role == 'admin_kabkota' || Auth::user()->role == 'admin_kecamatan' || Auth::user()->role == 'mitra')
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $total_perdes ?? '' }}</h3>

                            <p>Peraturan Desa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_review ?? '' }}</h3>

                            <p>Review Peraturan Desa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $total_review_perdes_selesai ?? '' }}</h3>

                            <p>Review Peraturan Desa - Selesai</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            @if (Auth::user()->role == 'admin_desakel')
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $total_perdes ?? '' }}</h3>

                            <p>Peraturan Desa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_review_perdes ?? '' }}</h3>

                            <p>Review Peraturan Desa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $total_perdes_selesai ?? '' }}</h3>

                            <p>Peraturan Desa - Selesai</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-bold">Selamat Datang di SIMPERDES</h4>
                            Sistem Informasi Manajemen Peraturan Desa (SIMPERDES) adalah sebuah sistem yang digunakan untuk mengelola dan mengatur peraturan-peraturan di tingkat desa. Sistem ini bertujuan untuk memudahkan proses pengelolaan dan pemantauan peraturan desa, serta memastikan bahwa peraturan-peraturan tersebut dapat diakses dengan mudah oleh masyarakat desa dan pihak terkait.
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
