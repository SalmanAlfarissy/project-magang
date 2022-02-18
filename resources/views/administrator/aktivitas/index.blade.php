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

                    <h3 class="box-title">Daftar Magang</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="add-row" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th style="width: 5%">No</th>
                          <th>Username</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th style="width: 10%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index=>$item )
                            <tr>

                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <a href="{{ route('admin.aktivitas-data',$item->id) }}" class="btn btn-social-icon btn-primary"><i class="fa fa-list-alt"></i></a>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Alamat</th>
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

  {{-- @include('administrator.admin.create') --}}
  @include('layouts.js.table')


@endsection
