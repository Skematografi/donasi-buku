  <style>
    .to-page {
      cursor: pointer;
    }

    .to-page:hover{
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $donatur->total; ?></h3>

                <p>Donatur</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?= base_url(); ?>dashboard/donatur" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $donasi->total; ?></h3>

                <p>Buku Donasi</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
              <a href="<?= base_url(); ?>dashboard/donasi" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $penerima->total; ?></h3>

                <p>Penerima Donasi</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?= base_url(); ?>dashboard/penerima" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $kebutuhan->total; ?></h3>

                <p>Kebutuhan Buku</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
              <a href="<?= base_url(); ?>dashboard/kebutuhan" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 