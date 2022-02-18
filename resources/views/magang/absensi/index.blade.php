@extends('layouts.magang.dashboard')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Absensi
        {{-- <small>Control panel</small> --}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Absensi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $hadir }}</h3>

              <p>Hadir</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue-gradient">
            <div class="inner">
              <h3>{{ $telat }}<sup style="font-size: 20px"></sup></h3>

              <p>Telat</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{ $izin+$sakit }}<sup style="font-size: 20px"></sup></h3>

                <p>Izin</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ $absen }}<sup style="font-size: 20px"></sup></h3>

                <p>Absen</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>
      <div class="col-md-6">

        @if (!empty($data))
        <section class="content">
            <div class="callout callout-info">
                <h4>Reminder!</h4>
                Absensi Hari ini Sudah di ambil!!
            </div>
        </section>
        @else
        <!-- Application buttons -->
        <div class="box">
          <div class="box-header">
            <h3 style="text-align: right;"><a href="https://time.is/Pekanbaru" id="time_is_link" rel="nofollow" style="font-size:36px"></a>
                <span>{{ date('l, d / M / Y') }}</span><br/>
                <span id="Pekanbaru_z41c"></span></h3>
          </div>

          <div class="box-body" style="text-align: center;">

            <a class="btn btn-app" href="{{ route('magang.hadir') }}">
              <i class="fa fa-check-square-o"></i> hadir
            </a>
            <button type="button" onclick="izin(1)" class="btn btn-app">
              <i class="fa fa-hand-paper-o"></i> Izin
            </button>
            <button type="button" class="btn btn-app" onclick="sakit(1)">
              <i class="fa fa-medkit"></i> Sakit
            </button>

            <form id="izin" style="display: none;" enctype="multipart/form-data" method="POST" action="{{ route('magang.izin') }}">
                @csrf
                <label>Izin</label>
                <div class="form-group" style="text-align: left;">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="3" name="keterangan" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group" style="text-align: left;">
                    <label for="exampleInputFile">Surat</label>
                    <input type="file" id="exampleInputFile" name="surat_izin">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-danger" onclick="izin(0)">Cencel</button>
                </div>
            </form>

            <form id="sakit" method="POST" action="{{ route('magang.sakit') }}" style="display: none;" enctype="multipart/form-data">
                @csrf
                <label>Sakit</label>
                <div class="form-group" style="text-align: left;">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="3" name="keterangan" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group" style="text-align: left;">
                    <label for="exampleInputFile">Surat</label>
                    <input type="file" id="exampleInputFile" name="surat_izin">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-danger" onclick="sakit(0)">Cencel</button>
                </div>
            </form>


          </div>
          <!-- /.box-body -->
        </div>
        @endif
        <!-- /.box -->
      </div>

    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  @include('layouts.js.dashboar')
    <script src="//widget.time.is/t.js"></script>
    <script>
    time_is_widget.init({Pekanbaru_z41c:{}});
    </script>

<script>

    function izin(i)
    {
        if(i==1)
            document.getElementById("izin").style.display="block";
        else
            document.getElementById("izin").style.display="none";
    }

    function sakit(s)
    {
        if(s==1)
            document.getElementById("sakit").style.display="block";
        else
            document.getElementById("sakit").style.display="none";
    }
</script>

@endsection
