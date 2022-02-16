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
            <div class="box-header" style="width: 10%;">
                <table>
                    <tr>
                        <td><a href="" class="btn btn-block btn-primary" data-toggle="modal" onclick="create()"><i class="fa fa-plus"></i> Absensi</a></td>
                        <td style="padding-left: 7px;"><a href="#" class="btn btn-block btn-info"><i class="fa fa-print"></i> Cetak</a></td></td>
                    </tr>
                </table>
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
        $.get("{{ route('admin.absensi-create') }}",{}, function(data,status){
            $("#page").html(data);
            $("#modalRegisterForm").modal('show');
        });
    }

    function read(){
        $.get("{{ route('admin.absensi-read') }}",{}, function(data,status){
            $("#read").html(data);
            $('#add-row').DataTable({
            "pageLength":5,
        });
        });
    }

    function store() {
        let dataform = $('#add-user').serialize();

            $.ajax({
                type: $('#add-user').attr('method'),
                url: $('#add-user').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data User Success di Tambahkan..",
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
                    }else if(err.responseJSON.errors.level){
                        $(".level-error").show().text(err.responseJSON.errors.level[0]);
                    }
                }
            });
    }

    function show(id){
        $.get("{{ url('/administrator/user/show') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalEditForm").modal('show');
        });
    }

    function update() {
        let dataform = $('#edit-user').serialize();

            $.ajax({
                type: $('#edit-user').attr('method'),
                url: $('#edit-user').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data User Success di Update..",
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
                    }else if(err.responseJSON.errors.level){
                        $(".level-error").show().text(err.responseJSON.errors.level[0]);
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
                    url:"{{ url('administrator/user/destroy') }}/" + id,
                    success: function(res){
                        console.log(res);
                            swal("Data User dengan Username '" +username+"' berhasil di hapus!!", {
                            icon: "success",
                        });
                        read();
                    }
                });

            } else {
                swal("Data User dengan Username '"+username+"' batal di hapus!!");
            }
        });

    }

</script>

@endsection
