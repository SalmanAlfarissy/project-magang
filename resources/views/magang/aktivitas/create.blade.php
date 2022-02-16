<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('magang.aktivitas-store') }}" method="POST" id="add-aktivitas">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">New Aktivitas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
            <div class="form-group">
                <select class="form-control select2" style="width: 100%;" name="nama_aktivitas" required>
                  <option value="" selected>== Pilih Aktivitas ==</option>
                  <option value="project">Project</option>
                  <option value="lain-lain">Lain-Lain</option>
                </select>
                <span class="errors text-danger nama_aktivitas-error"></span>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" rows="3" name="deskripsi" placeholder="Enter ..."></textarea>
                <span class="errors text-danger deskripsi-error"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="number" class="form-control" placeholder="Hasil" name="hasil">
                <span class="form-control-feedback">%</span>
                <span class="errors text-danger hasil-error"></span>
            </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="store()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>


