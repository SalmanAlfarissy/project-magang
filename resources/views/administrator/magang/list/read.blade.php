<table id="add-row" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th style="width: 5%">No</th>
      <th>Nama</th>
      <th>Awal Magang</th>
      <th>Selesai Magang</th>
      <th>Alamat</th>
      <th style="width: 15%">Aksi</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($data as $index=>$item )
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->awal_magang }}</td>
                <td>{{ $item->selesai_magang }}</td>
                <td>{{ $item->alamat }}</td>
                <td>
                    <button type="button" onclick="data({{ $item->id }})" class="btn btn-social-icon btn-info"><i class="fa fa-user-plus"></i></button>
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
        <th>Awal Magang</th>
        <th>Selesai Magang</th>
        <th>Alamat</th>
        <th style="width: 15%">Aksi</th>
    </tr>
    </tfoot>
  </table>
