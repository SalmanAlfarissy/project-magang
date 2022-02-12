<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.user-store') }}" method="POST" id="add-user">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">New User Administrator</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Name" name="name" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="errors text-danger name-error"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="errors text-danger username-error"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" class="form-control" id="myInput" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <input type="checkbox" class="minimal" onclick="showpass()"><span> Show Password</span><br/>
            <span class="errors text-danger password-error"></span>
        </div>

        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="level" required>
              <option value="" selected="selected">== Pilih Level ==</option>
              <option value="administrator">Administrator</option>
              <option value="pimpinan">Pimpinan</option>
              <option value="staf">Staf</option>
            </select>
            <span class="errors text-danger level-error"></span>
          </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="store()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
  </div>
</div>


