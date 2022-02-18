@extends('layouts.administrator.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List Aktivitas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Aktivitas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <div class="col-sm-9">
                        <a href="{{ route('admin.aktivitas') }}" style="width: 10%; margin: 5px;" class="btn btn-block btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                        <h3 class="box-title" style="margin: 5px">Nama : {{ $dataMagang->nama }}</h3>

                    </div>
                    <div class="col-sm-3">
                        <table style="margin: 5px;">
                            <tr>
                                <td style="padding-left: 7px;"><a href="" class="btn btn-block btn-primary" data-toggle="modal" onclick="create({{ $dataMagang->id_user }})"><i class="fa fa-plus"></i> Aktivitas</a></td>
                                <td style="padding-left: 7px;"><form action="{{ route('admin.aktivitas-cetak') }}" target="_blank">
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
                                        <button type="button" onclick="show({{ $item->id }})" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-social-icon btn-google" onclick="destroy({{ $item->id }},'{{ $dataMagang->nama }}')"><i class="fa fa-trash"></i></button>
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
        $.get("{{ url('/administrator/aktivitas/create') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalRegisterForm").modal('show');
        });
    }

    function store() {
        let dataform = $('#add-aktivitas').serialize();

            $.ajax({
                type: $('#add-aktivitas').attr('method'),
                url: $('#add-aktivitas').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    swal({
                            title: "Proses Success!!",
                            text: "Aktivitas Success di Ditambah..",
                            icon: "success",
                            button: "Ok",
                        }).then((button) => {
                            location.reload();
                        });

                },
                error: function(err){
                    if(err.responseJSON.errors.nama_aktivitas){
                        $(".nama_aktivitas-error").show().text(err.responseJSON.errors.nama_aktivitas[0]);
                    }else if(err.responseJSON.errors.deskripsi){
                        $(".deskripsi-error").show().text(err.responseJSON.errors.deskripsi[0]);
                    }else if(err.responseJSON.errors.hasil){
                        $(".hasil-error").show().text(err.responseJSON.errors.hasil[0]);
                    }
                }
            });
    }

    function show(id){
        $.get("{{ url('/administrator/aktivitas/show') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalEditForm").modal('show');
        });
    }

    function update() {
        let dataform = $('#edit-aktivitas').serialize();

            $.ajax({
                type: $('#edit-aktivitas').attr('method'),
                url: $('#edit-aktivitas').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    swal({
                            title: "Proses Success!!",
                            text: "Aktivitas Success di Update..",
                            icon: "success",
                            button: "Ok",
                        }).then((button) => {
                            location.reload();
                        });

                },
                error: function(err){
                    if(err.responseJSON.errors.nama_aktivitas){
                        $(".nama_aktivitas-error").show().text(err.responseJSON.errors.nama_aktivitas[0]);
                    }else if(err.responseJSON.errors.deskripsi){
                        $(".deskripsi-error").show().text(err.responseJSON.errors.deskripsi[0]);
                    }else if(err.responseJSON.errors.hasil){
                        $(".hasil-error").show().text(err.responseJSON.errors.hasil[0]);
                    }
                }
            });
    }

    function destroy(id,nama) {

        swal({
            title: "Apakah kamu ingin menghapus Aktivitas, "+nama+" ?",
            text: "Data yang sudah di hapus tidak bisa di kembalikan!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type:"get",
                    url:"{{ url('administrator/aktivitas/destroy') }}/" + id,
                    success: function(res){
                        console.log(res);
                            swal("Aktivitas '" +nama+"' berhasil di hapus!!", {
                            icon: "success",
                        }).then((button)=>{
                            location.reload();
                        });
                    }
                });

            } else {
                swal("Aktivitas '"+nama+"' batal di hapus!!");
            }
        });

    }

</script>

@endsection
