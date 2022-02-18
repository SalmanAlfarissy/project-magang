<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.absensi-store') }}" method="POST" id="add-absensi">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">New Absensi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" required disabled>
              <option value="{{ $data->id }}">{{ $data->name }}</option>
            </select>
            <span class="errors text-danger id_user-error"></span>
            <input type="text" name="nama" value="{{ $data->id }}" hidden>
          </div>

        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="status" required>
              <option value="" selected="selected">== Pilih Status ==</option>
              <option value="hadir">Hadir</option>
              <option value="telat">Telat</option>
              <option value="izin">Izin</option>
              <option value="sakit">Sakit</option>
              <option value="absen">Absen</option>
            </select>
            <span class="errors text-danger status-error"></span>
          </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="store()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>


