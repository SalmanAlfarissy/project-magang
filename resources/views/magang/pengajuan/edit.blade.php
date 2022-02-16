<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('magang.pengajuan-update',$data->id) }}" method="POST" id="edit-pengajuan">
        @csrf
        <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Edit Pengajuan Presentasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ session('magang.name') }}" required disabled>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <span class="errors text-danger name-error"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Judul Project" name="judul" required value="{{ $data->judul }}">
                <span class="fa fa-leanpub form-control-feedback"></span>
                <span class="errors text-danger name-error"></span>
            </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="update()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>


