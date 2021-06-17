

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-secondary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
      <img src="<?php echo base_url();?>assets/images/logo/logo.png" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><small></small></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?>assets/images/avatar/muslimah.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0);" class="d-block" style="color:#000;"><?php echo $this->session->userdata('full_name');?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url();?>dashboard" class="nav-link <?= ( $this->session->userdata('sidebar') == 'dashboard' ? 'active' : '' );?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>dashboard/produk" class="nav-link <?= ( $this->session->userdata('sidebar') == 'produk' ? 'active' : '' );?>">
              <i class="fas fa-list nav-icon"></i>
              <p>Produk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>dashboard/member" class="nav-link <?= ( $this->session->userdata('sidebar') == 'member' ? 'active' : '' );?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Member
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>dashboard/keluhan" class="nav-link <?= ( $this->session->userdata('sidebar') == 'keluhan' ? 'active' : '' );?>">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Keluhan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>dashboard/siaran" class="nav-link <?= ( $this->session->userdata('sidebar') == 'siaran' ? 'active' : '' );?>">
              <i class="nav-icon fas fa-send"></i>
              <p>
                Siaran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>dashboard/laporan" class="nav-link <?= ( $this->session->userdata('sidebar') == 'laporan' ? 'active' : '' );?>">
              <i class="nav-icon fas fa-file-text"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?php echo base_url();?>auth/logout" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>Keluar</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
