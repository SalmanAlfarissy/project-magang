<table id="add-row" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th style="width: 5%">No</th>
      <th>Status</th>
      <th>Nama</th>
      <th>Judul Project</th>
      <th>Tanggal Pengajuan</th>
      <th>Tanggal Presentasi</th>
      <th>Link Zoom</th>
      <th style="width: 15%">Aksi</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($data as $index=>$item )
            <tr>
                <td>{{ $index+1 }}</td>
                <td><span class="badge
                    @if(!empty($item))
                        @if($item->status_pengajuan == 'diterima') bg-green @elseif($item->status_pengajuan == 'pengajuan') bg-orange @else bg-red @endif
                    @endif
                    ">{{ (empty($item->status_pengajuan)) ? '-' : $item->status_pengajuan }}</span></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->tanggal_pengajuan }}</td>
                <td>{{ $item->tanggal_presentasi }}</td>
                <td>{{ $item->link_zoom }}</td>
                <td>
                    <button type="button" onclick="approv({{ $item->id }})" class="btn btn-social-icon btn-primary"><i class="fa fa-pie-chart"></i></button>
                    <button type="button" onclick="show({{ $item->id }})" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-social-icon btn-google" onclick="destroy({{ $item->id }},'{{ $item->username }}')"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th style="width: 5%">No</th>
        <th>Nama</th>
        <th>Judul Project</th>
        <th>Tanggal Pengajuan</th>
        <th>Tanggal Presentasi</th>
        <th>Link Zoom</th>
        <th style="width: 15%">Aksi</th>
    </tr>
    </tfoot>
  </table>
