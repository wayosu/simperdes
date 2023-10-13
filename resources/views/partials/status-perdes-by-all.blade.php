{{-- @if ($result->status_admin_kabkota == '3' && $result->status_admin_kecamatan == '3' && $result->status_admin_mitra == '3')
    <span class="badge badge-primary">
        Telah di Evaluasi Oleh Admin Desa Kelurahan - {{ $result->desa_kelurahan->nama_desa }} - {{ $result->user->name }}
    </span> --}}
@if ($result->status_admin_kabkota == '4' && $result->status_admin_kecamatan == '4' && $result->status_admin_mitra == '4')
    <span class="badge badge-success">
        Selesai
    </span>
@else
    @if ($result->status_admin_kabkota == '0')
        <span class="badge badge-secondary">
            Belum Ditinjau
            <span class="font-weight-normal">oleh Admin Kab. Kota</span>
        </span>
    @elseif ($result->status_admin_kabkota == '1')
        <span class="badge badge-warning">
            Sedang Ditinjau
            <span class="font-weight-normal">oleh Admin Kab. Kota</span>
        </span>
    @elseif ($result->status_admin_kabkota == '2')
        <span class="badge badge-warning">
            Selesai Ditinjau
            <span class="font-weight-normal">oleh Admin Kab. Kota</span>
            Silahkan Ditinjau
        </span>
    @elseif ($result->status_admin_kabkota == '3')
        <span class="badge badge-info">
            Tinjauan
            <span class="font-weight-normal">dari Admin Kabupaten Kota</span>
            Sedang Dievaluasi
        </span>
    @else
        <span class="badge badge-success">
            Selesai
            <span class="font-weight-normal">oleh Admin Kab. Kota</span>
        </span>
    @endif

    @if ($result->status_admin_kecamatan == '0')
        <span class="badge badge-secondary">
            Belum Ditinjau
            <span class="font-weight-normal">oleh Admin Kecamatan</span>
        </span>
    @elseif ($result->status_admin_kecamatan == '1')
        <span class="badge badge-warning">
            Sedang Ditinjau
            <span class="font-weight-normal">oleh Admin Kecamatan</span>
        </span>
    @elseif ($result->status_admin_kecamatan == '2')
        <span class="badge badge-warning">
            Selesai Ditinjau
            <span class="font-weight-normal">oleh Admin Kecamatan</span>
            Silahkan Ditinjau
        </span>
    @elseif ($result->status_admin_kecamatan == '3')
        <span class="badge badge-info">
            Tinjauan
            <span class="font-weight-normal">dari Admin Kecamatan</span>
            Sedang Dievaluasi
        </span>
    @else
        <span class="badge badge-success">
            Selesai
            <span class="font-weight-normal">oleh Admin Kecamatan</span>
        </span>
    @endif

    @if ($result->status_admin_mitra == '0')
        <span class="badge badge-secondary">
            Belum Ditinjau
            <span class="font-weight-normal">oleh Admin Mitra</span>
        </span>
    @elseif ($result->status_admin_mitra == '1')
        <span class="badge badge-warning">
            Sedang Ditinjau
            <span class="font-weight-normal">oleh Admin Mitra</span>
        </span>
    @elseif ($result->status_admin_mitra == '2')
        <span class="badge badge-warning">
            Selesai Ditinjau
            <span class="font-weight-normal">oleh Admin Mitra</span>
            Silahkan Ditinjau
        </span>
    @elseif ($result->status_admin_mitra == '3')
        <span class="badge badge-info">
            Tinjauan
            <span class="font-weight-normal">dari Admin Mitra</span>
            Sedang Dievaluasi
        </span>
    @else
        <span class="badge badge-success">
            Selesai
            <span class="font-weight-normal">oleh Admin Mitra</span>
        </span>
    @endif
@endif

