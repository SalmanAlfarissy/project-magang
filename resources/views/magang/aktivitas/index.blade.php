@extends('layouts.magang.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Aktivitas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Aktivitas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header" style="width: 10%;">
                <a href="" class="btn btn-block btn-primary" data-toggle="modal" onclick="create()"><i class="fa fa-plus"></i> Activitas</a>
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
        $.get("{{ route('magang.aktivitas-create') }}",{}, function(data,status){
            $("#page").html(data);
            $("#modalRegisterForm").modal('show');
        });
    }

    function read(){
        $.get("{{ route('magang.aktivitas-read') }}",{}, function(data,status){
            $("#read").html(data);
            $('#add-row').DataTable({
            "pageLength":5,
        });
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
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Aktivitas Success di Tambahkan..",
                            icon: "success",
                            button: "Ok",
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
        $.get("{{ url('/magang/aktivitas/show') }}/" + id,{}, function(data,status){
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
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Aktivitas Success di Update..",
                            icon: "success",
                            button: "Ok",
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

</script>

@endsection
