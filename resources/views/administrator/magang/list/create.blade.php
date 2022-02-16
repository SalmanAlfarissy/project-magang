<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="modal-content" action="{{ route('admin.list-store') }}" method="POST" id="add-list">
        @csrf
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">New Account Magang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nama" name="name" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="errors text-danger nama-error"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="errors text-danger username-error"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="myInput" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <input type="checkbox" onclick="showpass()"> Show Password
            <span class="errors text-danger password-error"></span>
          </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" onclick="store()" class="btn btn-deep-orange">Save</button>
      </div>
    </form>
    {{-- datepicker --}}
    <script>
    $(function(){
        $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        useCurrent: false
        });
    });
    </script>
  </div>
</div>


