<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-1">
    <!-- Brand Logo -->
    @if (Auth::user()->role == 'superadmin')
        <a href="{{ route('superadmin.dashboard') }}" class="brand-link my-0">
    @elseif (Auth::user()->role == 'admin_kabkota')
        <a href="{{ route('admin-kabkota.dashboard') }}" class="brand-link my-0">
    @elseif (Auth::user()->role == 'admin_kecamatan')
        <a href="{{ route('admin-kecamatan.dashboard') }}" class="brand-link my-0">
    @elseif (Auth::user()->role == 'mitra')
        <a href="{{ route('mitra.dashboard') }}" class="brand-link my-0">
    @elseif (Auth::user()->role == 'admin_desakel')
        <a href="{{ route('admin-desakel.dashboard') }}" class="brand-link my-0">
    @endif
        <img src="{{ asset('assets/front/assets/images/logo2.png') }}" alt="AdminLTE Logo"
            class="elevation-0" width="100%" style="opacity: .8">
        {{-- <span class="brand-text font-weight-light">SIMPERDES</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset(Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="badge text-left pl-0 mt-1"> 
                    @if (Auth::user()->role == 'superadmin')
                        Super Admin
                    @elseif (Auth::user()->role == 'admin_kabkota')
                        Admin Kabupaten/Kota
                        <hr class="py-0 my-0 border-light">
                        <span class="font-weight-normal">{{ Auth::user()->kabupaten_kota->nama_kabupaten_kota }}</span>
                    @elseif (Auth::user()->role == 'admin_kecamatan')
                        Admin Kecamatan
                        <hr class="py-0 my-0 border-light">
                        <span class="font-weight-normal">{{ Auth::user()->kecamatan->nama_kecamatan }}</span>
                    @elseif (Auth::user()->role == 'mitra')
                        Admin Mitra
                    @elseif (Auth::user()->role == 'admin_desakel')
                        Admin Desa/Kelurahan <br>
                        <hr class="py-0 my-0 border-light">
                        <span class="font-weight-normal">{{ Auth::user()->desa_kelurahan->nama_desa }}</span>
                    @endif
                </span>
                @if (Auth::user()->role == 'superadmin')
                <a href="{{ route('superadmin.pengaturan') }}" class="d-block">
                @elseif (Auth::user()->role == 'admin_kabkota')
                <a href="{{ route('admin-kabkota.pengaturan') }}" class="d-block">
                @elseif (Auth::user()->role == 'admin_kecamatan')
                <a href="{{ route('admin-kecamatan.pengaturan') }}" class="d-block">
                @elseif (Auth::user()->role == 'mitra')
                <a href="{{ route('mitra.pengaturan') }}" class="d-block">
                @elseif (Auth::user()->role == 'admin_desakel')
                <a href="{{ route('admin-desakel.pengaturan') }}" class="d-block">
                @endif
                    <span class="text-wrap">{{ Auth::user()->name }}</span>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    @if (Auth::user()->role == 'superadmin')
                        <a href="{{ route('superadmin.dashboard') }}"
                    @elseif (Auth::user()->role == 'admin_kabkota')
                        <a href="{{ route('admin-kabkota.dashboard') }}"
                    @elseif (Auth::user()->role == 'admin_kecamatan')
                        <a href="{{ route('admin-kecamatan.dashboard') }}"
                    @elseif (Auth::user()->role == 'mitra')
                        <a href="{{ route('mitra.dashboard') }}"
                    @elseif (Auth::user()->role == 'admin_desakel')
                        <a href="{{ route('admin-desakel.dashboard') }}"
                    @endif
                        class="nav-link @if ($active == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 'superadmin')
                    <li class="nav-item 
                @if (
                        $active == 'provinsi' ||
                        $active == 'kabupaten-kota' ||
                        $active == 'kecamatan' ||
                        $active == 'desa-kelurahan' ||
                        $active == 'mitra' ||
                        $active == 'jenis-peraturan') menu-open @endif">
                        <a href="#"
                            class="nav-link 
                        @if (
                            $active == 'provinsi' ||
                                $active == 'kabupaten-kota' ||
                                $active == 'kecamatan' ||
                                $active == 'desa-kelurahan' ||
                                $active == 'mitra' ||
                                $active == 'jenis-peraturan') active @endif">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('superadmin.provinsi') }}"
                                    class="nav-link @if ($active == 'provinsi') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Provinsi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('superadmin.kabupaten-kota') }}"
                                    class="nav-link @if ($active == 'kabupaten-kota') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kabupaten Kota</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('superadmin.kecamatan') }}"
                                    class="nav-link @if ($active == 'kecamatan') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kecamatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('superadmin.desa-kelurahan') }}"
                                    class="nav-link @if ($active == 'desa-kelurahan') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Desa Kelurahan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('superadmin.jenis-peraturan') }}"
                                    class="nav-link @if ($active == 'jenis-peraturan') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jenis Peraturan Desa</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('superadmin.users') }}"
                            class="nav-link @if ($active == 'users') active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('superadmin.peraturan-desa') }}" class="nav-link @if ($active == 'peraturan-desa') active @endif">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Peraturan Desa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('superadmin.review-peraturan-desa') }}" class="nav-link @if ($active == 'tinjauan-peraturan-desa') active @endif">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Tinjauan Peraturan Desa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('superadmin.tentang-kami') }}" class="nav-link @if ($active == 'tentang-kami') active @endif">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Tentang Kami
                            </p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'admin_desakel')
                    <li class="nav-item">
                        <a href="{{ route('admin-desakel.peraturan-desa') }}" class="nav-link @if ($active == 'peraturan-desa') active @endif">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Peraturan Desa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin-desakel.perdes') }}" class="nav-link @if ($active == 'perdes') active @endif">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                PERDES
                            </p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'admin_kabkota')
                    <li class="nav-item">
                        <a href="{{ route('admin-kabkota.peraturan-desa') }}" class="nav-link @if ($active == 'peraturan-desa') active @endif">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Peraturan Desa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin-kabkota.review-peraturan-desa') }}" class="nav-link @if ($active == 'tinjauan-peraturan-desa') active @endif">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Tinjauan Peraturan Desa
                            </p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'admin_kecamatan')
                    <li class="nav-item">
                        <a href="{{ route('admin-kecamatan.peraturan-desa') }}" class="nav-link @if ($active == 'peraturan-desa') active @endif">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Peraturan Desa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin-kecamatan.review-peraturan-desa') }}" class="nav-link @if ($active == 'tinjauan-peraturan-desa') active @endif">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Tinjauan Peraturan Desa
                            </p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'mitra')
                    <li class="nav-item">
                        <a href="{{ route('mitra.peraturan-desa') }}" class="nav-link @if ($active == 'peraturan-desa') active @endif">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Peraturan Desa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mitra.review-peraturan-desa') }}" class="nav-link @if ($active == 'tinjauan-peraturan-desa') active @endif">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Tinjauan Peraturan Desa
                            </p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.pengaturan') }}" class="nav-link @if ($active == 'pengaturan-akun') active @endif">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Pengaturan Akun
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 'admin_desakel')
                <li class="nav-item">
                    <a href="{{ route('admin-desakel.pengaturan') }}" class="nav-link @if ($active == 'pengaturan-akun') active @endif">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Pengaturan Akun
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 'admin_kabkota')
                <li class="nav-item">
                    <a href="{{ route('admin-kabkota.pengaturan') }}" class="nav-link @if ($active == 'pengaturan-akun') active @endif">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Pengaturan Akun
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 'admin_kecamatan')
                <li class="nav-item">
                    <a href="{{ route('admin-kecamatan.pengaturan') }}" class="nav-link @if ($active == 'pengaturan-akun') active @endif">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Pengaturan Akun
                        </p>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role == 'mitra')
                <li class="nav-item">
                    <a href="{{ route('mitra.pengaturan') }}" class="nav-link @if ($active == 'pengaturan-akun') active @endif">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Pengaturan Akun
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
