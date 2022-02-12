<table id="add-row" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th style="width: 5%">No</th>
      <th>Nama</th>
      <th>Username</th>
      <th>Level</th>
      <th style="width: 10%">Aksi</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($data as $index=>$item )
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->level }}</td>
                <td>
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
        <th>Username</th>
        <th>Level</th>
        <th style="width: 10%">Aksi</th>
    </tr>
    </tfoot>
  </table>
