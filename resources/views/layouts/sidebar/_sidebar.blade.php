<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/magang/'.session('magang.foto')) }}" class="img-circle" alt="User Image" style="width: 50px; height: 50px;">
        </div>
        <div class="pull-left info">
          <p>{{ session('magang.name') }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {{ session('magang.level') }}</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="{{ ($page=='dashboard') ? 'active' : '' }}">
            <a href="{{ route('magang.das') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
              </span>
            </a>
        </li>

        @if ($status->status == 'diterima')
        <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Absensi</span>
              <span class="pull-right-container">
              </span>
            </a>
        </li>

        <li>
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Aktivitas</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Pengajuan Presentasi</span>
              <span class="pull-right-container">
              </span>
            </a>
        </li>

        @endif

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
