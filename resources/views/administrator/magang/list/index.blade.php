@extends('layouts.administrator.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Magang
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.das') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Magang</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header" style="width: 10%;">
                <div class="form-group">
                    <table>
                        <tr>
                            <td><a href="" class="btn btn-block btn-primary" data-toggle="modal" onclick="create()"><i class="fa fa-plus"></i> Magang</a></td>
                            <td style="padding-left: 7px;"><a href="{{ route('admin.list-cetak') }}" class="btn btn-block btn-info" target="_blank"><i class="fa fa-print"></i> Cetak</a></td></td>

                        </tr>
                    </table>

                </div>
                {{-- <a href="{{ route('admin.user-create') }}" class="btn btn-block btn-primary "> <i class="fa fa-plus"></i> User </a> --}}
                {{-- <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm">Launch
                    Modal Register Form</a> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="read">

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

    $(document).ready(function() {
        read();

    });


    function create(){
        $.get("{{ route('admin.list-create') }}",{}, function(data,status){
            $("#page").html(data);
            $("#modalRegisterForm").modal('show');
        });
    }

    function read(){
        $.get("{{ route('admin.list-read') }}",{}, function(data,status){
            $("#read").html(data);
            $('#add-row').DataTable({
            "pageLength":5,
        });
        });
    }

    function store() {
        let dataform = $('#add-list').serialize();

            $.ajax({
                type: $('#add-list').attr('method'),
                url: $('#add-list').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data list Success di Tambahkan..",
                            icon: "success",
                            button: "Ok",
                        });
                },
                error: function(err){
                    if(err.responseJSON.errors.name){
                        $(".name-error").show().text(err.responseJSON.errors.name[0]);
                    }else if(err.responseJSON.errors.username){
                        $(".username-error").show().text(err.responseJSON.errors.username[0]);
                    }else if(err.responseJSON.errors.password){
                        $(".password-error").show().text(err.responseJSON.errors.password[0]);
                    }
                }
            });
    }

    function show(id){
        $.get("{{ url('/administrator/magang/list/show') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalEditForm").modal('show');
        });
    }

    function update() {
        let dataform = $('#edit-list').serialize();

            $.ajax({
                type: $('#edit-list').attr('method'),
                url: $('#edit-list').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data list Success di Update..",
                            icon: "success",
                            button: "Ok",
                        });
                },
                error: function(err){
                    if(err.responseJSON.errors.name){
                        $(".name-error").show().text(err.responseJSON.errors.name[0]);
                    }else if(err.responseJSON.errors.username){
                        $(".username-error").show().text(err.responseJSON.errors.username[0]);
                    }
                }
            });
    }

    function data(id){
        $.get("{{ url('/administrator/magang/list/data') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalEditForm").modal('show');
        });
    }

    function updateData() {
        let dataform = $('#edit-data').serialize();
        // return console.log(dataform);

            $.ajax({
                type: $('#edit-data').attr('method'),
                url: $('#edit-data').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Akun Success di Update..",
                            icon: "success",
                            button: "Ok",
                        });
                },
                error: function(err){
                    if(err.responseJSON.errors.alamat){
                        $(".alamat-error").show().text(err.responseJSON.errors.alamat[0]);
                    }else if(err.responseJSON.errors.awal_magang){
                        $(".awal_magang-error").show().text(err.responseJSON.errors.awal_magang[0]);
                    }else if(err.responseJSON.errors.selesai_magang){
                        $(".selesai_magang-error").show().text(err.responseJSON.errors.selesai_magang[0]);
                    }
                }
            });
    }

    function destroy(id,username) {

        swal({
            title: "Apakah kamu ingin menghapus data, "+username+" ?",
            text: "Data yang sudah di hapus tidak bisa di kembalikan!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type:"get",
                    url:"{{ url('administrator/magang/list/destroy') }}/" + id,
                    success: function(res){
                        console.log(res);
                            swal("Data list dengan Username '" +username+"' berhasil di hapus!!", {
                            icon: "success",
                        });
                        read();
                    }
                });

            } else {
                swal("Data list dengan Username '"+username+"' batal di hapus!!");
            }
        });

    }

</script>

@endsection
