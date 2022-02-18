@extends('layouts.administrator.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List Absensi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Absensi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <div class="col-sm-9">
                        <a href="{{ route('admin.absensi') }}" style="width: 10%; margin: 5px;" class="btn btn-block btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                        <h3 class="box-title" style="margin: 5px">Nama : {{ $dataMagang->nama }}</h3>

                    </div>
                    <div class="col-sm-3">
                        <table style="margin: 5px;">
                            <tr>
                                <td style="padding-left: 7px;"><a href="" class="btn btn-block btn-primary" data-toggle="modal" onclick="create({{ $dataMagang->id_user }})"><i class="fa fa-plus"></i> Absensi</a></td>
                                <td style="padding-left: 7px;"><form action="{{ route('admin.absensi-cetak') }}" target="_blank">
                                    <input type="text" name="id_user" value="{{ $dataMagang->id_user }}" hidden>
                                    <button type="submit" class="btn btn-block btn-info"><i class="fa fa-print"></i> Cetak</button></td></td>
                                    </form>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="add-row" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th style="width: 5%">No</th>
                          <th>Tanggal</th>
                          <th>Jam</th>
                          <th>Status</th>
                          <th>Keterangan</th>
                          <th>Surat Izin</th>
                          <th style="width: 10%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index=>$item )
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->jam }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ (empty($item->keterangan)) ? '-' : $item->keterangan }}</td>
                                    <td>{{ (empty($item->surat_izin)) ? '-' : $item->surat_izin }}</td>
                                    <td>
                                        <button type="button" onclick="show({{ $item->id }})" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-social-icon btn-google" onclick="destroy({{ $item->id }},'{{ $item->nama }}')"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Surat Izin</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                        </tfoot>
                      </table>

                </div>
                <!-- /.box-body -->
              </div>

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  {{-- form --}}

  <div id="page"></div>

  {{-- end form --}}

  {{-- @include('administrator.admin.create') --}}
  @include('layouts.js.table')

  <script >
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function create(id){
        $.get("{{ url('/administrator/absensi/create') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalRegisterForm").modal('show');
        });
    }

    function store() {
        let dataform = $('#add-absensi').serialize();

            $.ajax({
                type: $('#add-absensi').attr('method'),
                url: $('#add-absensi').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    swal({
                            title: "Proses Success!!",
                            text: "Absensi Success di Ditambah..",
                            icon: "success",
                            button: "Ok",
                        }).then((button) => {
                            location.reload();
                        });

                },
                error: function(err){
                    if(err.responseJSON.errors.status){
                        $(".status-error").show().text(err.responseJSON.errors.status[0]);
                    }
                }
            });
    }

    function show(id){
        $.get("{{ url('/administrator/absensi/show') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalEditForm").modal('show');
        });
    }

    function update() {
        let dataform = $('#edit-absensi').serialize();

            $.ajax({
                type: $('#edit-absensi').attr('method'),
                url: $('#edit-absensi').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    swal({
                            title: "Proses Success!!",
                            text: "Absensi Success di Update..",
                            icon: "success",
                            button: "Ok",
                        }).then((button) => {
                            location.reload();
                        });

                },
                error: function(err){
                    if(err.responseJSON.errors.status){
                        $(".status-error").show().text(err.responseJSON.errors.status[0]);
                    }
                }
            });
    }

    function destroy(id,nama) {

        swal({
            title: "Apakah kamu ingin menghapus Absensi, "+nama+" ?",
            text: "Data yang sudah di hapus tidak bisa di kembalikan!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type:"get",
                    url:"{{ url('administrator/absensi/destroy') }}/" + id,
                    success: function(res){
                        console.log(res);
                            swal("Absensi '" +nama+"' berhasil di hapus!!", {
                            icon: "success",
                        }).then((button)=>{
                            location.reload();
                        });
                    }
                });

            } else {
                swal("Absensi '"+nama+"' batal di hapus!!");
            }
        });

    }

</script>

@endsection
