@if ($result->status_admin_mitra == '0')
    <span class="badge badge-secondary">
        Belum Ditinjau
    </span>
@elseif ($result->status_admin_mitra == '1')
    <span class="badge badge-warning">
        Sedang Ditinjau
    </span>
@elseif ($result->status_admin_mitra == '2')
    <span class="badge badge-info">
        Selesai Ditinjau
    </span>
@elseif ($result->status_admin_mitra == '3')
    <span class="badge badge-primary">
        Evaluasi
    </span>
@else
    <span class="badge badge-success">
        Selesai
    </span>
@endif
