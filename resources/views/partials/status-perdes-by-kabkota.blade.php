@if ($result->status_admin_kabkota == '0')
    <span class="badge badge-secondary">
        Belum Ditinjau
    </span>
@elseif ($result->status_admin_kabkota == '1')
    <span class="badge badge-warning">
        Sedang Ditinjau
    </span>
@elseif ($result->status_admin_kabkota == '2')
    <span class="badge badge-info">
        Selesai Ditinjau
    </span>
@elseif ($result->status_admin_kabkota == '3')
    <span class="badge badge-primary">
        Evaluasi
    </span>
@else
    <span class="badge badge-success">
        Selesai
    </span>
@endif