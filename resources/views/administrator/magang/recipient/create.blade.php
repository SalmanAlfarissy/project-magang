<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.recipient-store') }}" method="POST" id="add-recipient">
        @csrf
        <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Add Approver</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body mx-3">
            <div class="form-group">
                <select class="form-control select2" style="width: 100%;" name="id_user" required>
                    <option value="" selected>== Pilih Nama ==</option>
                    @foreach ($magang as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <span class="errors text-danger id_user-error"></span>
            </div>

            <div class="form-group">
                <select class="form-control select2" style="width: 100%;" name="status" required>
                  <option value="" selected>== Pilih Level ==</option>
                  <option value="pengajuan">Pengajuan</option>
                  <option value="diterima">Diterima</option>
                  <option value="ditolak" >Ditolak</option>
                </select>
                <span class="errors text-danger status-error"></span>
            </div>

            {{-- <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="link Wawancara" name="link" required value="{{ $data->name }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <span class="errors text-danger name-error"></span>
            </div> --}}

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" rows="3" name="deskripsi" placeholder="Enter ..."></textarea>
                <span class="errors text-danger deskripsi-error"></span>
            </div>

          </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="store()" class="btn btn-deep-orange">Save</button>
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


