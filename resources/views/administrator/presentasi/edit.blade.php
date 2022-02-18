<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.presentasi-update',$pengajuan->id) }}" method="POST" id="edit-presentasi">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Data User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="form-group has-feedback">
            <input type="text" class="form-control"  value="{{ $pengajuan->name }}" required disabled>
            <span class="fa fa-leanpub form-control-feedback"></span>
            <span class="errors text-danger nama-error"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" value="{{ $pengajuan->judul }}" name="judul" required>
            <span class="fa fa-leanpub form-control-feedback"></span>
            <span class="errors text-danger judul-error"></span>
        </div>

        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="status_pengajuan" required>
              <option value="">== Status ==</option>
              <option value="diterima" @if($pengajuan->status_pengajuan == 'diterima') selected @endif>Diterima</option>
              <option value="pengajuan" @if($pengajuan->status_pengajuan == 'pengajuan') selected @endif>Pengajuan</option>
              <option value="ditolak" @if($pengajuan->status_pengajuan == 'ditolak') selected @endif>Ditolak</option>
            </select>
            <span class="errors text-danger nama-error"></span>
          </div>

          <div class="form-group">
            <label>Nama Penguji</label>
            <select class="form-control select2" style="width: 100%;" name="nama_penguji" required>
              @foreach ($user as $item)
              <option value="{{ $item->id }}" @if($item->id == $presentasi->id_user) selected @endif>{{ $item->name }}</option>
              @endforeach
            </select>
            <span class="errors text-danger nama_penguji-error"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control datepicker" placeholder="Tanggal Presentasi" name="tanggal_presentasi" value="{{
                date('Y-m-d',strtotime($presentasi->tanggal_presentasi)) }}" required>
            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
            <span class="errors text-danger tanggal_presentasi-error"></span>
        </div>

          <div class="form-group">
            <label>Link Zoom</label>
            <textarea class="form-control" rows="3" name="link_zoom" placeholder="Enter ...">{{ $presentasi->link_zoom }}</textarea>
            <span class="errors text-danger link_zoom-error"></span>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="update()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>
{{-- datepicker --}}
<script>
    $(function(){
        $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        useCurrent: false
        });
    });
    </script>

