<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('magang.aktivitas-update',$data->id) }}" method="POST" id="edit-aktivitas">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Aktivitas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="nama_aktivitas" required>
              <option value="">== Pilih Aktivitas ==</option>
              <option value="project" @if($data->nama_aktivitas == 'project') selected @endif>Project</option>
              <option value="lain-lain" @if($data->nama_aktivitas == 'lain-lain') selected @endif>Lain-Lain</option>
            </select>
            <span class="errors text-danger nama_aktivitas-error"></span>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" rows="3" name="deskripsi" placeholder="Enter ...">{{ $data->deskripsi }}</textarea>
            <span class="errors text-danger deskripsi-error"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="number" class="form-control" placeholder="Hasil" name="hasil" value="{{ $data->hasil }}">
            <span class="form-control-feedback">%</span>
            <span class="errors text-danger hasil-error"></span>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="update()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>


