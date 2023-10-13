@extends('front.app')

@section('content')
    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6>Selamat Datang Di</h6>
                                        <h2>Sistem Informasi Peraturan Desa</h2>
                                        <p style="text-align: justify;">Sistem Informasi Manajemen Peraturan Desa
                                            (SIMPERDES) adalah sebuah sistem yang digunakan untuk mengelola dan mengatur
                                            peraturan-peraturan di tingkat desa.</p>
                                    </div>
                                    {{-- <div class="col-lg-12">
                    <div class="border-first-button scroll-to-section">
                        <a href="#contact">Free Quote</a>
                    </div>
                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <!-- <img src="assets/images/slider-dec-v3.png" alt=""> -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">

                                            <h5 class="text-uppercase fw-bold d-block text-white px-3 py-2" style="background-color: #786aea;">Peraturan Desa</h5>
                                        </div>

                                        <div class="card text-start border-0 shadow">
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <th scope="col">Peraturan Desa</th>
                                                            <th scope="col">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($three_latest_data) > 0)
                                                            @foreach ($three_latest_data as $tld)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $tld->judul_peraturan }}</td>
                                                                <td>
                                                                    <a href="{{ route('unduh', ['filename' => str_replace('uploads/peraturan-desa/file/', '', $tld->file)]) }}" class="btn btn-primary btn-sm border-0" style="background-color: #786aea;">
                                                                        <i class="fa fa-download"></i> Unduh
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                                <td>
                                                    <a href="#peraturan-desa" class="btn btn-link btn-sm float-start" style="color: #786aea;">
                                                        Lihat Peraturan Lainnya <i class="fa fa-long-arrow-right"></i>
                                                    </a>
                                                </td>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-left-image  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="{{ asset('assets/front/assets/images/about-dec-v3.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center  wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <div class="about-right-content">
                                <div class="section-heading">
                                    <h6>Tentang Kami</h6>
                                    <h4>Apa itu <em>Simperdes</em> ?</h4>
                                    <div class="line-dec"></div>
                                </div>
                                <p>Sistem Informasi Manajemen Peraturan Desa (SIMPERDES) adalah sebuah sistem yang digunakan untuk mengelola dan mengatur peraturan-peraturan di tingkat desa. Sistem ini bertujuan untuk memudahkan proses pengelolaan dan pemantauan peraturan desa, serta memastikan bahwa peraturan-peraturan tersebut dapat diakses dengan mudah oleh masyarakat desa dan pihak terkait.</p>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="peraturan-desa" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Peraturan Mengenai Desa</h6>
                        <h4>Daftar <em>Peraturan Desa</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="naccs">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body p-5">
                                        <div class="thumb">
                                            <div class="left-text">
                                                <h4 class="mb-4">Daftar Peraturan Desa</h4>
                                                <table id="example1" class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">No</th>
                                                            <th>Peraturan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($latest_data) > 0 || count($perdes) > 0)
                                                            @php
                                                                $latest_data_array = $latest_data->toArray();
                                                                $perdes_array = $perdes->toArray();
                                                            @endphp
                                                        
                                                            @foreach ($latest_data_array as $index => $data)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $data['judul_peraturan'] }}</td>
                                                                    <td>
                                                                        <a href="{{ route('unduh', ['filename' => str_replace('uploads/peraturan-desa/file/', '', $data['file'])]) }}" class="btn btn-primary btn-sm border-0" style="background-color: #4da6e7;">
                                                                            <i class="fa fa-download"></i> Unduh
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        
                                                            @foreach ($perdes_array as $index => $data)
                                                                <tr>
                                                                    <td>{{ $index + 1 + count($latest_data_array) }}</td>
                                                                    <td>{{ $data['judul_peraturan'] }}</td>
                                                                    <td>
                                                                        <a href="{{ route('unduh', ['filename' => str_replace('uploads/peraturan-desa/file/', '', $data['file'])]) }}" class="btn btn-primary btn-sm border-0" style="background-color: #4da6e7;">
                                                                            <i class="fa fa-download"></i> Unduh
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="contact" class="contact-us section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Detail Tentang Kami</h6>
                        <h4>Tentang Kami <em>Disini!</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-dec">
                                    <img src="{{ asset('assets/front/assets/images/contact-dec-v3.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div id="map">
                                    <iframe
                                        src="{{ $tentang_kami->link_gmaps ?? '' }}"
                                        width="100%" height="665px" frameborder="0" style="border:0"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="fill-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('assets/front/assets/images/phone-icon.png') }}" alt="">
                                                    <a href="tel:{{ $tentang_kami->telepon ?? '' }}">{{ $tentang_kami->telepon ?? '' }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('assets/front/assets/images/email-icon.png') }}" alt="">
                                                    <a href="mailto:{{ $tentang_kami->email ?? '' }}" class="text-break">{{ $tentang_kami->email ?? '' }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('assets/front/assets/images/location-icon.png') }}" alt="">
                                                    <a href="#">{{ $tentang_kami->alamat ?? '' }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
