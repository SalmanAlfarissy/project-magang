<table class="table table-striped" id="add-row">
    <tr>
        <th style="width: 30%">Nama</th>
        <td style="width: 70%">{{ session('magang.name') }}</td>

    </tr>
    <tr>
        <th style="width: 30%">Judul Project</th>
        <td style="width: 70%">{{ (!empty($data->judul)) ? $data->judul : '-' }}</td>

    </tr>
    <tr>
        <th style="width: 30%">Tanggal Pengajuan</th>
        <td style="width: 70%">{{ (!empty($data->tanggal_pengajuan)) ? $data->tanggal_pengajuan : '-' }}</span></td>
    </tr>
    <tr>
        <th style="width: 30%">Status</th>
        <td style="width: 70%"><span class="badge
            @if(!empty($data))
                @if($data->status_pengajuan == 'diterima') bg-green @elseif($data->status_pengajuan == 'pengajuan') bg-orange @else bg-red @endif
            @endif
            ">{{ (empty($data->status_pengajuan)) ? '-' : $data->status_pengajuan }}</span></td>
    </tr>

  </table>
