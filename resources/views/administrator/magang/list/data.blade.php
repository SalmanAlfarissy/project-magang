<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.data-update',$data->id) }}" method="POST" id="edit-data">

        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Data Magang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nama" name="name" value="{{ $data->name }}" required disabled>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="errors text-danger nama-error"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control datepicker" placeholder="Awal Magang" name="awal_magang" required value="{{ $data->awal_magang }}">
            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
            <span class="errors text-danger awal_magang-error"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control datepicker" placeholder="Selesai Magang" name="selesai_magang" required value="{{ $data->selesai_magang }}">
            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
            <span class="errors text-danger selesai_magang-error"></span>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" rows="3" name="alamat" placeholder="Enter ...">{{ $data->alamat }}</textarea>
            <span class="errors text-danger alamat-error"></span>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="updateData()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>

    {{-- datepicker --}}
    <script>
        $(function(){
            $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            useCurrent: false
            });
        });
        </script>
  </div>
</div>


