<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link"><i class="fas fa-home"></i> Pergi Ke Beranda</a>
        </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            @if (Auth::user()->role == 'superadmin')
            <a href="{{ route('superadmin.pengaturan') }}" class="nav-link py-0">
            @elseif (Auth::user()->role == 'admin_kabkota')
            <a href="{{ route('admin-kabkota.pengaturan') }}"  class="nav-link py-0">
            @elseif (Auth::user()->role == 'admin_kecamatan')
            <a href="{{ route('admin-kecamatan.pengaturan') }}"  class="nav-link py-0">
            @elseif (Auth::user()->role == 'mitra')
            <a href="{{ route('mitra.pengaturan') }}"  class="nav-link py-0">
            @elseif (Auth::user()->role == 'admin_desakel')
            <a href="{{ route('admin-desakel.pengaturan') }}"  class="nav-link py-0">
            @endif
                <div class="d-flex align-items-center">
                    <img src="{{ asset(Auth::user()->foto) }}" class="img-circle elevation-1" width="30" height="30" alt="User Image">
                    <div class="d-flex flex-column ml-2">
                        <span class="text-sm text-bold">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-muted">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="nav-link btn py-0 show_confirm_logout">
                    <i class="fas fa-sign-out-alt"></i> 
                </button>
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

@push('scripts')
    <script>
        $('.show_confirm_logout').click(function(event) {
        var form =  $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Ini akan mengeluarkan anda dari halaman ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Logout!',
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
