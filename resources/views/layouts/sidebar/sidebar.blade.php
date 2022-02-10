<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
            <a href="{{ route('admin.das') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
              </span>
            </a>
        </li>

        <li class="{{ ($page=='user') ? 'active' : '' }}">
            <a href="{{ route('admin.user') }}">
              <i class="fa fa-user-secret"></i> <span>User</span>
              <span class="pull-right-container">
              </span>
            </a>
        </li>

        <li>
          <a href="#">
            <i class="fa fa-dashboard"></i> <span> Magang </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.html"><i class="fa fa-circle-o"></i> Recipient Magang </a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> List Magang </a></li>
          </ul>
        </li>

        <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>List Absensi</span>
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



      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>