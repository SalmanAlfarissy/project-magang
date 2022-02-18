<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.absensi-update',$data->id) }}" method="POST" id="edit-absensi">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Absensi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="nama" required disabled>
                <option value="">== Nama ==</option>
              @foreach ($absensi as $item )
                <option {{ ($item->id == $data->id) ? 'selected' : '' }}>{{ $item->nama }}</option>
              @endforeach
            </select>
            <span class="errors text-danger id_user-error"></span>
          </div>

        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="status" required>
              <option value="">== Pilih Status ==</option>
              <option value="hadir" @if($data->status == 'hadir') selected @endif>Hadir</option>
              <option value="telat" @if($data->status == 'telat') selected @endif>Telat</option>
              <option value="izin" @if($data->status == 'izin') selected @endif>Izin</option>
              <option value="sakit" @if($data->status == 'sakit') selected @endif>Sakit</option>
              <option value="absen" @if($data->status == 'absen') selected @endif>Absen</option>
            </select>
            <span class="errors text-danger status-error"></span>
          </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="update()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>


