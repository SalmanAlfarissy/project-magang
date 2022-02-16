<table id="add-row" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th style="width: 5%">No</th>
      <th>Aktivitas</th>
      <th>Deskripsi</th>
      <th>Hasil (%)</th>
      <th style="width: 10%">Aksi</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($data as $index=>$item )
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->nama_aktivitas }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>{{ $item->hasil }}%</td>
                <td>
                    @if(date('Y-m-d',strtotime($item->created_at)) == $date)
                        <button type="button" onclick="show({{ $item->id }})" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-edit"></i></button>
                    @endif

                </td>
            </tr>
        @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th style="width: 5%">No</th>
        <th>Aktivitas</th>
        <th>Deskripsi</th>
        <th>Hasil (%)</th>
        <th style="width: 10%">Aksi</th>
    </tr>
    </tfoot>
  </table>
