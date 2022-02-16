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
        <li class="active">Recipient</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header" style="width: 10%;">
                <div class="form-group">
                    <a href="" class="btn btn-block btn-primary" data-toggle="modal" onclick="create()"><i class="fa fa-plus"></i> Recipient</a>
                </div>
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

    function read(){
        $.get("{{ route('admin.recipient-read') }}",{}, function(data,status){
            $("#read").html(data);
            $('#add-row').DataTable({
            "pageLength":5,
        });
        });
    }

    function create(){
        $.get("{{ route('admin.recipient-create') }}",{}, function(data,status){
            $("#page").html(data);
            $("#modalRegisterForm").modal('show');
        });
    }

    function store() {
        let dataform = $('#add-recipient').serialize();

            $.ajax({
                type: $('#add-recipient').attr('method'),
                url: $('#add-recipient').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Recipient Success di Tambahkan..",
                            icon: "success",
                            button: "Ok",
                        });
                },
                error: function(err){
                    if(err.responseJSON.errors.id_user){
                        $(".id_user-error").show().text(err.responseJSON.errors.id_user[0]);
                    }else if(err.responseJSON.errors.status){
                        $(".status-error").show().text(err.responseJSON.errors.status[0]);
                    }else if(err.responseJSON.errors.deskripsi){
                        $(".deskripsi-error").show().text(err.responseJSON.errors.deskripsi[0]);
                    }
                }
            });
    }

    function show(id){
        $.get("{{ url('/administrator/magang/recipient/show') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalEditForm").modal('show');
        });
    }

    function update() {
        let dataform = $('#edit-recipient').serialize();

            $.ajax({
                type: $('#edit-recipient').attr('method'),
                url: $('#edit-recipient').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Recipient Success di Update..",
                            icon: "success",
                            button: "Ok",
                        });
                },
                error: function(err){
                    if(err.responseJSON.errors.status){
                        $(".status-error").show().text(err.responseJSON.errors.status[0]);
                    }else if(err.responseJSON.errors.deskripsi){
                        $(".deskripsi-error").show().text(err.responseJSON.errors.deskripsi[0]);
                    }
                }
            });
    }

    function destroy(id,username) {

        swal({
            title: "Apakah kamu ingin menghapus data recipient, "+username+" ?",
            text: "Data yang sudah di hapus tidak bisa di kembalikan!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type:"get",
                    url:"{{ url('administrator/magang/recipient/destroy') }}/" + id,
                    success: function(res){
                        console.log(res);
                            swal("Data Recipient dengan Username '" +username+"' berhasil di hapus!!", {
                            icon: "success",
                        });
                        read();
                    }
                });

            } else {
                swal("Data Recipient dengan Username '"+username+"' batal di hapus!!");
            }
        });

    }

</script>

@endsection
