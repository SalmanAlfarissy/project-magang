@extends('layouts.magang.profile')
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
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img style="width: 100px; height: 100px;" class="profile-user-img img-responsive img-circle" src="{{ asset('dist/img/magang/'.session('magang.foto')) }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ session('magang.name') }}</h3>

              <p class="text-muted text-center">{{ session('magang.level') }}</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <div class="box">
                <div class="col-sm-9"><h3 class="box-title">Data Pengajuan</h3></div>
                <div class="col-sm-3">
                    <table style="margin: 5%; margin-left: 10px;">
                        <tr>
                            @if(!empty($data))
                                <td style="padding: 5px;"><a href="" class="btn btn-block btn-info" data-toggle="modal" onclick="show({{ $data->id }})"><i class="fa fa-edit"></i> Edit</a></td>
                                <td style="padding: 5px;"><a href="" class="btn btn-block btn-danger" data-toggle="modal" onclick="destroy({{ $data->id }},'{{ $data->judul }}')"><i class="fa fa-crosshairs"></i> Batal</a></td>
                            @else
                                <td style="padding: 5px;"><a href="" class="btn btn-block btn-primary" data-toggle="modal" onclick="create()"><i class="fa fa-plus"></i> Pengajuan</a></td>
                            @endif
                        </tr>
                    </table>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" id="read">
                </div>

                <!-- /.box-body -->
            </div>
              <!-- /.box -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>

        <div class="col-md-3"></div>

        <div class="col-md-9">
          <div class="nav-tabs-custom">
            </div>
              <!-- /.box -->
              <div class="box">
                <div class="col-sm-8"><h3 class="box-title">Presentasi</h3></div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 30%">Nama Penguji</th>
                            <td style="width: 70%">{{ (!empty($presen->name)) ? $presen->name : '-' }}</td>

                        </tr>
                        <tr>
                            <th style="width: 30%">Judul Project</th>
                            <td style="width: 70%">{{ (!empty($presen->judul)) ? $presen->judul : '-' }}</td>

                        </tr>
                        <tr>
                            <th style="width: 30%">Tanggal Presentasi</th>
                            <td style="width: 70%">{{ (!empty($presen->tanggal_presentasi)) ? $presen->tanggal_presentasi : '-' }}</span></td>

                        </tr>
                        <tr>
                            <th style="width: 30%">Link Zoom</th>
                            <td style="width: 70%"><a href="{{ (!empty($presen->link_zoom)) ? $presen->link_zoom : '#' }}">{{ (!empty($presen->link_zoom)) ? $presen->link_zoom : '-' }}</a></td>
                        </tr>

                      </table>
                </div>

                <!-- /.box-body -->
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </div>


        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  <div id="page"></div>

  @include('layouts.js.profile')

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
        $.get("{{ route('magang.pengajuan-create') }}",{}, function(data,status){
            $("#page").html(data);
            $("#modalRegisterForm").modal('show');
        });
    }

    function read(){
        $.get("{{ route('magang.pengajuan-read') }}",{}, function(data,status){
            $("#read").html(data);
            $('#add-row').DataTable({
            "pageLength":5,
        });
        });
    }

    function store() {
        let dataform = $('#add-pengajuan').serialize();

            $.ajax({
                type: $('#add-pengajuan').attr('method'),
                url: $('#add-pengajuan').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Pengajuan Success di Tambahkan..",
                            icon: "success",
                            button: "Ok",
                        });
                    location.reload();
                },
                error: function(err){
                    if(err.responseJSON.errors.judul){
                        $(".judul-error").show().text(err.responseJSON.errors.judul[0]);
                    }
                }
            });
    }

    function show(id){
        $.get("{{ url('/magang/presentasi/show') }}/" + id,{}, function(data,status){
            $("#page").html(data);
            $("#modalEditForm").modal('show');
        });
    }

    function update() {
        let dataform = $('#edit-pengajuan').serialize();

            $.ajax({
                type: $('#edit-pengajuan').attr('method'),
                url: $('#edit-pengajuan').attr('action'),
                data: dataform,
                success: function (data) {
                    $(".close").click();
                    read();
                    swal({
                            title: "Proses Success!!",
                            text: "Data Pengajuan Success di Update..",
                            icon: "success",
                            button: "Ok",
                        });
                },
                error: function(err){
                    if(err.responseJSON.errors.judul){
                        $(".judul-error").show().text(err.responseJSON.errors.judul[0]);
                    }
                }
            });
    }

    function destroy(id,judul) {

        swal({
            title: "Apakah kamu ingin membatalkan pengajuan judul , "+judul+" ?",
            text: "Data yang sudah di batalkan tidak bisa di kembalikan!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type:"get",
                    url:"{{ url('magang/presentasi/destroy') }}/" + id,
                    success: function(res){
                        console.log(res);
                            swal("Pembatalan Pengajuan Judul '" +judul+"' berhasil!!", {
                            icon: "success",
                        });
                        read();
                        location.reload();
                    }
                });

            } else {
                swal("Pembatalan pengajuan judul '"+judul+"' gagal!!");
            }
        });

    }

</script>


@endsection
