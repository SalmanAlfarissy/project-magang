<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MAGANG GCI | Data Magang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @include('layouts.css.form')
  <style>
      .img-rounded {
            border-radius: 50%;
            width: 80px;
            height: 80px;
        }
  </style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>MAGANG</b>GCI</a>
  </div>

  <div class="login-box-body">
    <p class="login-box-msg">Data Magang</p>

    <form action="{{ route('magang.dataMagang-store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="input-group @error('nama') has-error @enderror">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Nama" name="nama" value="{{ session('magang.name') }}">
            </div>
            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <input type="text" name="id" value="{{ session('magang.id') }}" hidden>

        <div class="form-group  @error('tanggal_lahir') has-error @enderror">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right datepicker" placeholder="Tanggal Lahir" name="tanggal_lahir">
            </div>
            @error('tanggal_lahir') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group @error('awal_magang') has-error @enderror">

            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right datepicker"  placeholder="Awal Magang" name="awal_magang">
            </div>
            @error('awal_magang') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group @error('selesai_magang') has-error @enderror">

            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right datepicker" placeholder="Selesai Magang" name="selesai_magang">
            </div>
            @error('selesai_magang') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" rows="3" name="alamat" placeholder="Enter ..."></textarea>
          </div>

        <label>Upload Foto</label>
        <div class="form-group @error('selesai_magang') has-error @enderror">
            <label for="img">
                {{-- <i class="fa fa-user" style="font-size: 24px;
                border:1px solid black;
                padding: 25px; cursor: pointer;">
                </i> --}}
                <img src="{{ asset('dist/img/upload.png') }}" id="chgimg" class="img-rounded" style="cursor: pointer;">
            </label>

            <input type="file" name="foto" id="img" style="display: none; visibility: none;" onchange="getImage(this.value);">
            <div id="display-image"></div>
            @error('foto') <span class="text-danger">{{ $message }}</span> @enderror
        </div>


      {{-- <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <input type="file" id="exampleInputFile" name="foto">

      </div> --}}

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>

            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@include('layouts.js.form')
<script type="text/javascript">
function getImage(imagename)
{
    var newimg=imagename.replace(/^.*\\/,"");
    $('#display-image').html(newimg);
}
</script>
</body>
</html>
