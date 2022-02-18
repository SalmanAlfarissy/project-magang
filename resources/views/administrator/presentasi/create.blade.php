<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.presentasi-store') }}" method="POST" id="add-presentasi">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">New Pengajuan Presentasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="nama" required>
              <option value="">== Nama ==</option>
              @foreach ($data as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
            <span class="errors text-danger nama-error"></span>
          </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Judul Project" name="judul" required>
            <span class="fa fa-leanpub form-control-feedback"></span>
            <span class="errors text-danger judul-error"></span>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="store()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>


