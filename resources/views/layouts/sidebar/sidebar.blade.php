<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ session('admin.name') }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {{ session('admin.level') }}</a>
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

        <li class="treeview {{ ($page == 'recipient' || $page == 'list') ? 'menu-open' : '' }}" style="height: auto;">
          <a href="#">
            <i class="fa fa-user-plus"></i> <span> Magang </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ ($page == 'recipient' || $page == 'list') ? 'display: block;' : '' }}">
            <li class="{{ ($page == 'recipient') ? 'active' : '' }}"><a href="{{ route('admin.recipient') }}"><i class="fa fa-circle-o"></i> Recipient Magang </a></li>
            <li class="{{ ($page == 'list') ? 'active' : '' }}"><a href="{{ route('admin.list') }}"><i class="fa fa-circle-o"></i> List Magang </a></li>
          </ul>
        </li>

        <li class="{{ ($page == 'absensi') ? 'active' : '' }}">
            <a href="{{ route('admin.absensi') }}">
              <i class="fa fa-calendar-check-o"></i> <span>List Absensi</span>
              <span class="pull-right-container">
              </span>
            </a>
        </li>

        <li class="{{ ($page == 'aktivitas') ? 'active' : '' }}">
          <a href="{{ route('admin.aktivitas') }}">
            <i class="fa fa-list-alt"></i> <span>Aktivitas</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="{{ ($page == 'presentasi') ? 'active' : '' }}">
            <a href="{{ route('admin.presentasi') }}">
              <i class="fa fa-pie-chart"></i> <span>Presentasi</span>
              <span class="pull-right-container">
              </span>
            </a>
        </li>



      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
