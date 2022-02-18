@extends('layouts.administrator.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Presentasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Presentasi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header" style="width: 15%;">
                <a href="" class="btn btn-block btn-primary" data-toggle="modal" onclick="create()"><i class="fa fa-plus"></i> Pengajuan</a>
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
        $.get("{{ route('admin.presentasi-create') }}",{}, function(data,status){
            $("#page").html(data);
            $("#modalRegisterForm").modal('show');
        });
    }


    function read(){
        $.get("{{ route('admin.presentasi-read') }}",{}, function(data,status){
            $("#read").html(data);
            $('#add-row').DataTable({
            "pageLength":5,
        });
        });
    }

    function store() {
        let dataform = $('#add-presentasi').serialize();

            $.ajax({
                type: $('#add-presentasi').attr('method'),
                url: $('#add-presentasi').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Presentasi Success di Tambahkan..",
                            icon: "success",
                            button: "Ok",
                        });
                },
                error: function(err){
                    if(err.responseJSON.errors.nama){
                        $(".nama-error").show().text(err.responseJSON.errors.nama[0]);
                    }else if(err.responseJSON.errors.judul){
                        $(".judul-error").show().text(err.responseJSON.errors.judul[0]);
                    }
                }
            });
    }

    function approv(id){
        $.get("{{ url('/administrator/presentasi/approv') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalRegisterForm").modal('show');
        });
    }

    function save() {
        let dataform = $('#add-presentasi').serialize();

            $.ajax({
                type: $('#add-presentasi').attr('method'),
                url: $('#add-presentasi').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Presentasi Success di Tambahkan..",
                            icon: "success",
                            button: "Ok",
                        });
                },
                error: function(err){
                    if(err.responseJSON.errors.status_pengajuan){
                        $(".status_pengajuan-error").show().text(err.responseJSON.errors.status_pengajuan[0]);
                    }else if(err.responseJSON.errors.tanggal_presentasi){
                        $(".tanggal_presentasi-error").show().text(err.responseJSON.errors.tanggal_presentasi[0]);
                    }else if(err.responseJSON.errors.link_zoom){
                        $(".link_zoom-error").show().text(err.responseJSON.errors.link_zoom[0]);
                    }
                }
            });
    }

    function show(id){
        $.get("{{ url('/administrator/presentasi/show') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalEditForm").modal('show');
        });
    }

    function update() {
        let dataform = $('#edit-presentasi').serialize();

            $.ajax({
                type: $('#edit-presentasi').attr('method'),
                url: $('#edit-presentasi').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Presentasi Success di Update..",
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
                    url:"{{ url('administrator/presentasi/destroy') }}/" + id,
                    success: function(res){

                        console.log(res);
                            swal("Data Presentasi dengan Username '" +username+"' berhasil di hapus!!", {
                            icon: "success",
                        });
                        read();
                    }
                });

            } else {
                swal("Data Presentasi dengan Username '"+username+"' batal di hapus!!");
            }
        });
    }

</script>

@endsection
