<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.recipient-update',$data->id) }}" method="POST" id="edit-recipient">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Approver Magang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body mx-3">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Name" name="name" required value="{{ $data->name }}" disabled>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="errors text-danger name-error"></span>
        </div>

        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="status" required>
              <option value="" @if($data->status == '') selected @endif>== Pilih Level ==</option>
              <option value="pengajuan" @if($data->status == 'pengajuan') selected @endif>Pengajuan</option>
              <option value="diterima" @if($data->status == 'diterima') selected @endif>Diterima</option>
              <option value="ditolak" @if($data->status == 'ditolak') selected @endif>Ditolak</option>
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
            <textarea class="form-control" rows="3" name="deskripsi" placeholder="Enter ...">{{ $data->deskripsi }}</textarea>
            <span class="errors text-danger deskripsi-error"></span>
        </div>


      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="update()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>


