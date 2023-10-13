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
                <div class="col-12 col-lg-7">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            @if (Auth::user()->role == 'admin_desakel')
                                                <a href="{{ route('admin-desakel.peraturan-desa') }}"
                                                    class="text-secondary mr-2">
                                                @elseif (Auth::user()->role == 'admin_kabkota')
                                                    <a href="{{ route('admin-kabkota.peraturan-desa') }}"
                                                        class="text-secondary mr-2">
                                                    @elseif (Auth::user()->role == 'admin_kecamatan')
                                                        <a href="{{ route('admin-kecamatan.peraturan-desa') }}"
                                                            class="text-secondary mr-2">
                                                        @elseif (Auth::user()->role == 'mitra')
                                                            <a href="{{ route('mitra.peraturan-desa') }}"
                                                                class="text-secondary mr-2">
                                                            @else
                                                                <a href="{{ route('superadmin.peraturan-desa') }}"
                                                                    class="text-secondary mr-2">
                                            @endif
                                            <i class="fas fa-arrow-alt-circle-left"></i>
                                            </a>
                                            <h3 class="card-title">{{ $subtitle }}</h3>
                                        </div>
                                        <span class="border-bottom d-inline d-md-none my-2 m-md-0"></span>
                                        <div class="d-flex align-items-center">
                                            <span class="mb-0 small">Diajukan oleh </span>
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
                                                <div class="px-3 py-2 rounded border border-primary" style="background-color: rgba(0, 123, 255, .2)">
                                                    <p class="mb-0">{{ $result->jenis_peraturan->jenis_aturan }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Isi Peraturan</label>
                                                <div class="px-3 py-2 rounded border border-primary" style="background-color: rgba(0, 123, 255, .2)">
                                                    <p class="mb-0">{{ $result->isi_peraturan }}</p>
                                                </div>
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

                                    @if (Auth::user()->role == 'admin_desakel' || Auth::user()->role == 'superadmin')
                                        <div class="row mt-4">

                                            @foreach (['kabkota', 'kecamatan', 'mitra'] as $tipe)
                                                @if ($result->{"status_admin_$tipe"} == 2)
                                                    <div class="col-12">
                                                        @if (Auth::user()->role == 'admin_desakel')
                                                            <form class="mb-2"
                                                                action="{{ route('admin-desakel.hasil-review.status', $result->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="1">
                                                                <input type="hidden" name="tipe_admin"
                                                                    value="admin_{{ $tipe }}">
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-warning btn-block konfirmasi_periksa_{{ $tipe }}">
                                                                    <i class="fas fa-external-link-alt"></i> Tinjau Hasil Tinjauan dari
                                                                    @if ($tipe == 'kabkota')
                                                                        Admin Kabupaten/Kota
                                                                    @elseif ($tipe == 'kecamatan')
                                                                        Admin Kecamatan
                                                                    @elseif ($tipe == 'mitra')
                                                                        Admin Mitra
                                                                    @endif
                                                                </button>
                                                            </form>
                                                        @elseif (Auth::user()->role == 'superadmin')
                                                            <form class="mb-2"
                                                                action="{{ route('superadmin.detail-review', $result->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="tipe_admin"
                                                                    value="admin_{{ $tipe }}">
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-info btn-block">
                                                                    <i class="fas fa-info-circle"></i> Detail Tinjauan
                                                                    @if ($tipe == 'kabkota')
                                                                        Admin Kabupaten/Kota
                                                                    @elseif ($tipe == 'kecamatan')
                                                                        Admin Kecamatan
                                                                    @elseif ($tipe == 'mitra')
                                                                        Admin Mitra
                                                                    @endif
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                @elseif ($result->{"status_admin_$tipe"} == 3 || $result->{"status_admin_$tipe"} == 4)
                                                    <div class="col-12">
                                                        <form class="mb-2"
                                                            action="{{ Auth::user()->role == 'superadmin' ? route('superadmin.detail-review', $result->id) : route('admin-desakel.detail-review', $result->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="tipe_admin"
                                                                value="admin_{{ $tipe }}">
                                                            <button type="submit"
                                                                class="btn btn-sm 
                                                                @if ($result->{"status_admin_$tipe"} == 3)
                                                                    btn-info 
                                                                @else
                                                                    btn-success 
                                                                @endif
                                                                btn-block">
                                                                <i class="fas fa-info-circle"></i> Detail Tinjauan
                                                                @if ($tipe == 'kabkota')
                                                                    Admin Kabupaten/Kota
                                                                @elseif ($tipe == 'kecamatan')
                                                                    Admin Kecamatan
                                                                @elseif ($tipe == 'mitra')
                                                                    Admin Mitra
                                                                @endif
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    @endif

                                    @if ($result->status_admin_kabkota == 3 && $result->status_admin_kecamatan == 3 && $result->status_admin_mitra == 3)
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <a href="{{ route('admin-desakel.evaluasi', $result->id) }}"
                                                    class="btn btn-sm btn-primary btn-block mb-2"><i
                                                        class="fas fa-pen-alt"></i> Evaluasi Peraturan Desa</a>
                                            </div>
                                            <div class="col-12">
                                                <form action="{{ route('admin-desakel.selesai', $result->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success btn-block konfirmasi_selesai"><i
                                                            class="fas fa-check"></i> Evaluasi Peraturan Desa Selesai
                                                        ?</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (count($data_log_pd) > 0)
                        <div class="col-12">
                            <div class="my-3">
                                <hr class="m-0">
                                <div class="px-2 py-2">
                                    <div class="d-flex flex-column flex-md-row justify-content-between aling-items-center my-2">
                                        <h6 class="m-0"><i class="fas fa-th-list"></i>&nbsp; Log Peraturan Desa Sebelumnya</h6>
                                        <p class="mt-2 mb-0 m-md-0 small">Total Log : {{ count($data_log_pd) }}</p>
                                    </div>
                                </div>
                                <hr class="m-0">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    @foreach ($data_log_pd as $key => $dlpd)
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <div class="d-flex align-items-center">
                                                    <span class="text-white mr-2">
                                                        <i class="far fa-circle fa-xs"></i>
                                                    </span>
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapse{{ $key }}">
                                                        {{ $dlpd->judul_peraturan }}
                                                    </a>
                                                </div>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $key }}" class="collapse">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Desa Kelurahan</label>
                                                            <p>{{ $dlpd->user->desa_kelurahan->nama_desa }}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Judul Peraturan</label>
                                                            <p>{{ $dlpd->judul_peraturan }}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jenis Peraturan</label>
                                                            <p>{{ $dlpd->jenis_peraturan->jenis_aturan }}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Isi Peraturan</label>
                                                            <p>{{ $dlpd->isi_peraturan }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>File</label>
                                                            <div>
                                                                <a href="@if ($dlpd->file != null) {{ asset($dlpd->file) }} @else # @endif" 
                                                                    @if ($dlpd->file != null)
                                                                    target="_blank"
                                                                    @endif
                                                                    class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-file-alt"></i> File Peraturan
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Penyusun</label>
                                                            <p>{{ $dlpd->nama_penyusun }}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <div>
                                                                <span class="badge badge-primary">Evaluasi</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if (Auth::user()->role == 'admin_desakel' || Auth::user()->role == 'superadmin')
                    <div class="col-12 col-lg-5">
                        <div class="my-3 my-lg-0 mb-lg-3">
                            <hr class="m-0">
                            <div class="px-2 py-2">
                                <div class="d-flex flex-column flex-md-row justify-content-between aling-items-center my-2">
                                    <h6 class="m-0"><i class="fas fa-info-circle"></i>&nbsp; Riwayat Tinjauan Peraturan Desa</h6>
                                    <p class="mt-2 mb-0 m-md-0 small">Total Tinjauan : {{ count($result->review_peraturan_desa) + count($data_log_rpd) }}</p>
                                </div>
                            </div>
                            <hr class="m-0">
                        </div>
                        <!-- The time line -->
                        <div class="timeline mb-0">
                            <!-- timeline item -->
                            @foreach ($result->review_peraturan_desa->sortByDesc('updated_at') as $rpd)
                                <div>
                                    <i class="fas fa-info bg-warning"></i>
                                    <div class="timeline-item">

                                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between border-bottom px-2 py-2">
                                            <div>
                                                <p class="timeline-header font-weight-bold mb-0">
                                                    @if ($rpd->user->role == 'admin_kabkota')
                                                        Admin Kabupaten/Kota
                                                    @elseif ($rpd->user->role == 'admin_kecamatan')
                                                        Admin Kecamatan
                                                    @elseif ($rpd->user->role == 'mitra')
                                                        Admin Mitra
                                                    @endif
                                                </p>
                                                <p class="mb-0 small text-muted">
                                                    @if ($rpd->user->role == 'admin_kabkota')
                                                        {{ $rpd->user->kabupaten_kota->nama_kabupaten_kota }} -
                                                    @elseif ($rpd->user->role == 'admin_kecamatan')
                                                        {{ $rpd->user->kecamatan->nama_kecamatan }} -
                                                    @endif
                                                    {{ $rpd->user->name }}
                                                </p>
                                            </div>
                                            <span class="border-bottom d-inline d-md-none my-2 m-md-0"></span>
                                            <div class="small text-muted">
                                                <span class="time mr-1"><i class="fas fa-clock"></i>
                                                    {{ $rpd->updated_at->format('H:i') }}</span>
                                                <span class="time"><i class="fas fa-calendar"></i>
                                                    {{ $rpd->updated_at->format('d F Y') }}</span>
                                            </div>
                                        </div>

                                        <div class="timeline-body">
                                            <div class="form-group">
                                                <label>Catatan</label>
                                                <p class="mb-0">{{ $rpd->catatan }}</p>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex">                                                    
                                                    <a href="@if ($rpd->file != null) {{ asset($rpd->file)}} @else # @endif" class="btn btn-sm btn-outline-primary mr-2">
                                                        <i class="fas fa-file-alt"></i>
                                                        File Tinjauan
                                                    </a>
                                                    <a href="{{ $rpd->link_tautan }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-link"></i>
                                                        Link Tautan
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if (count($data_log_rpd) > 0)
                            @foreach ($data_log_rpd->sortByDesc('updated_at') as $dlrpd)
                                <div class="timeline-dlrpd">
                                    <i class="fas fa-info bg-warning timeline-icon-dlrpd"></i>
                                    <div class="timeline-item timeline-item-dlrpd">

                                        <div class="d-flex align-items-center justify-content-between border-bottom px-2 py-2">
                                            <div>
                                                <p class="timeline-header font-weight-bold mb-0">
                                                    @if ($dlrpd->user->role == 'admin_kabkota')
                                                        Admin Kabupaten/Kota
                                                    @elseif ($dlrpd->user->role == 'admin_kecamatan')
                                                        Admin Kecamatan
                                                    @elseif ($dlrpd->user->role == 'mitra')
                                                        Admin Mitra
                                                    @endif
                                                </p>
                                                <p class="mb-0 small text-muted">
                                                    @if ($dlrpd->user->role == 'admin_kabkota')
                                                        {{ $dlrpd->user->kabupaten_kota->nama_kabupaten_kota }} -
                                                    @elseif ($dlrpd->user->role == 'admin_kecamatan')
                                                        {{ $dlrpd->user->kecamatan->nama_kecamatan }} -
                                                    @endif 
                                                    {{ $dlrpd->user->name }}
                                                </p>
                                            </div>
                                            <div class="small text-muted">
                                                <span class="time"><i class="fas fa-clock"></i>
                                                    {{ $dlrpd->updated_at->format('H:i') }}</span>
                                                <span class="time"><i class="fas fa-calendar"></i>
                                                    {{ $dlrpd->updated_at->format('d F Y') }}</span>
                                            </div>
                                        </div>

                                        <div class="timeline-body">
                                            <div class="form-group">
                                                <label>Catatan</label>
                                                <p class="mb-0">{{ $dlrpd->catatan }}</p>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex">                                                    
                                                    <a href="@if ($dlrpd->file != null) {{ asset($dlrpd->file)}} @else # @endif" class="btn btn-sm btn-outline-primary mr-2">
                                                        <i class="fas fa-file-alt"></i>
                                                        File Tinjauan
                                                    </a>
                                                    <a href="{{ $dlrpd->link_tautan }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-link"></i>
                                                        Link Tautan
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                        @if (count($data_log_rpd) > 0)
                        <div class="text-center mb-5">
                            <button id="show-more-button" class="btn btn-sm btn-link btn-block">Show More</button>
                            <button id="show-less-button" class="btn btn-sm btn-link btn-block" style="display: none;">Show Less</button>
                        </div>
                        @endif
                    </div>
                @endif

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

            $('.konfirmasi_selesai').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                        title: 'Konfirmasi untuk menyelesaikan Evaluasi Peraturan Desa',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Selesai!',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
            });

            $('.konfirmasi_periksa_kabkota').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                        title: 'Konfirmasi untuk memeriksa Hasil Tinjauan',
                        html: '<p>Hasil Tinjauan dari Admin Kabupaten/Kota.<br> Ini akan dilanjutkan ke tahapan selanjutnya!</p>',
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

            $('.konfirmasi_periksa_kecamatan').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                        title: 'Konfirmasi untuk memeriksa Hasil Tinjauan',
                        html: '<p>Hasil Tinjauan dari Admin Kecamatan.<br> Ini akan dilanjutkan ke tahapan selanjutnya!</p>',
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

            $('.konfirmasi_periksa_mitra').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                        title: 'Konfirmasi untuk memeriksa Hasil Tinjauan',
                        html: '<p>Hasil Tinjauan dari Admin Mitra.<br> Ini akan dilanjutkan ke tahapan selanjutnya!</p>',
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
            
        let visibleItems = 0; // Number of items to initially display
        let timeline = document.querySelectorAll('.timeline-dlrpd');
        let showMoreButton = document.getElementById('show-more-button');
        let showLessButton = document.getElementById('show-less-button');

        function toggleTimelineItems() {
            timeline.forEach((item, index) => {
                if (index < visibleItems) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });

            if (visibleItems < timeline.length) {
                showMoreButton.style.display = 'block';
                showLessButton.style.display = 'none';
            } else {
                showMoreButton.style.display = 'none';
                showLessButton.style.display = 'block';
            }
        }

        toggleTimelineItems();

        showMoreButton.addEventListener('click', () => {
            visibleItems += 5; // Increase the number of visible items when the "Show More" button is clicked
            toggleTimelineItems();
        });

        showLessButton.addEventListener('click', () => {
            visibleItems = 0; // Reset the number of visible items to the initial value when the "Show Less" button is clicked
            toggleTimelineItems();
        });
        </script>
    @endpush
@endif
