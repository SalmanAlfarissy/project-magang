<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.user-update',$data->id) }}" method="POST" id="edit-user">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Data User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Name" name="name" required value="{{ $data->name }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="errors text-danger name-error"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" value="{{ $data->username }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="errors text-danger username-error"></span>
        </div>

        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="level" required>
              <option value="" @if($data->level == '') selected @endif>== Pilih Level ==</option>
              <option value="administrator" @if($data->level == 'administrator') selected @endif>Administrator</option>
              <option value="pimpinan" @if($data->level == 'pimpinan') selected @endif>Pimpinan</option>
              <option value="staf" @if($data->level == 'staf') selected @endif>Staf</option>
            </select>
            <span class="errors text-danger level-error"></span>
          </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="update()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>


