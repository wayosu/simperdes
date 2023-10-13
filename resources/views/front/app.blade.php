<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Sistem Informasi Peraturan Desa</title>
    <link rel="icon" href="{{ asset('assets/front/assets/images/logo.png') }}" type="image/png" sizes="16x16">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/templatemo-digimedia-v3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/owl.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
      .page-link {
        color: #4da6e7;
      }

      .pagination > li > a:focus,
      .pagination > li > a:hover,
      .pagination > li > span:focus,
      .pagination > li > span:hover
      {
          color: #fff !important;
          background-color: #4da6e7 !important;
          border-color: none !important;
      }


      .pagination > .active > .page-link {
          background: #4da6e7 !important;
          color: #fff;
          border-color: #4da6e7 !important;
      }
    </style>
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  @include('front.header')

  @yield('content')

  @include('front.footer')


  <!-- Scripts -->
  <script src="{{ asset('assets/front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/front/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/front/assets/js/animation.js') }}"></script>
  <script src="{{ asset('assets/front/assets/js/imagesloaded.js') }}"></script>
  <script src="{{ asset('assets/front/assets/js/custom.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>


  <script>
      $(function () {
        $("#example1").DataTable();
      });

      @if (session('success'))
        Swal.fire(
            'Berhasil!',
            '{{ session('success') }}',
            'success'
        )
      @endif
  </script>

</body>
</html>