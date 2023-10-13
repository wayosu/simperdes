    <!-- Pre-header Starts -->
    <div class="pre-header">
        <div class="container">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <div>
                    <ul class="info">
                        <li><a href="mailto:{{ $tentang_kami->email ?? '' }}"><i class="fa fa-envelope"></i>{{ $tentang_kami->email ?? '' }}</a></li>
                        <li><a href="tel:{{ $tentang_kami->telepon ?? '' }}"><i class="fa fa-phone"></i>{{ $tentang_kami->telepon ?? '' }}</a></li>
                    </ul>
                </div>
                <div>
                    <ul class="social-media">
                        <li><a href="{{ $tentang_kami->link_facebook ?? '' }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ $tentang_kami->link_instagram ?? '' }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="{{ $tentang_kami->link_twitter ?? '' }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-header End -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="/" class="logo">
                            <img src="{{ asset('assets/front/assets/images/logo3.png') }}" alt="logo">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Beranda</a></li>
                            <li class="scroll-to-section"><a href="#about">Tentang Kami</a></li>
                            <li class="scroll-to-section"><a href="#peraturan-desa">Peraturan Desa</a></li>
                            <li class="scroll-to-section"><a href="#contact">Kontak</a></li>
                            <li class="scroll-to-section">
                                <div class="border-first-button">
                                    @auth
                                        @if (Auth::user()->role == 'superadmin')
                                            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
                                        @elseif (Auth::user()->role == 'admin_desakel')
                                            <a href="{{ route('admin-desakel.dashboard') }}">Dashboard</a>
                                        @elseif (Auth::user()->role == 'admin_kabkota')
                                            <a href="{{ route('admin-kabkota.dashboard') }}">Dashboard</a>
                                        @elseif (Auth::user()->role == 'mitra')
                                            <a href="{{ route('admin-desakel.dashboard') }}">Dashboard</a>
                                        @endif
                                    @else
                                    <a href="{{ route('login') }}">Masuk</a>
                                    @endauth
                                </div>
                            </li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
