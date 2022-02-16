<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('magang.pengajuan-store') }}" method="POST" id="add-pengajuan">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Pengajuan Presentasi</h4>
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


