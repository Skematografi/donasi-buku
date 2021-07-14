<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <small><?php echo $this->session->flashdata('message'); ?></small>
          <div class="card">
            <div class="card-header">
              <h3><b>Laporan Buku</b></h3>
            </div>
            <!-- /.card-header -->
           
            <form method="post" action="<?php echo base_url('dashboard/cetakLaporan'); ?>" target="_blank" autocomplete="off">
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Jenis Buku <span class="text-danger">*</span></label>
                          <select class="form-control" name="category" onchange="getStatus(this)" required>
                              <option value="" selected disabled>--Pilih Jenis Buku--</option>
                              <option value="Donasi">Buku Donasi</option>
                              <option value="Kebutuhan">Kebutuhan Buku</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status" onchange="openStart()" required disabled>
                                <option value="" selected disabled>--Pilih Status--</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="start_date" onchange="openEnd()" name="start_date" required disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal Akhir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required disabled>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Cetak Laporan</button>
              </div>
            </form>

          </div>

          <div class="card">
            <div class="card-header">
              <h3><b>Laporan User</b></h3>
            </div>
            <!-- /.card-header -->
           
            <form method="post" action="<?php echo base_url('dashboard/cetakLaporanUser'); ?>" target="_blank" autocomplete="off">
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Jenis User <span class="text-danger">*</span></label>
                          <select class="form-control" name="user" onchange="getStatusUser(this)" required>
                              <option value="" selected disabled>--Pilih Jenis User--</option>
                              <option value="3">Donatur</option>
                              <option value="4">Penerima Donasi</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status User <span class="text-danger">*</span></label>
                            <select class="form-control" name="status_user" id="status_user" onchange="getLabelStatus(this)" required disabled>
                                <option value="" selected disabled>--Pilih Status User--</option>
                            </select>
                            <input type="hidden" id="label_status" name="label_status">
                        </div>
                    </div>
                  </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-warning">Cetak Laporan</button>
              </div>
            </form>

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-right">
    <strong>Copyright &copy; 2021 <a href="<?php echo base_url();?>" target="_blank">Gudang Buku</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#pelanggan').DataTable();
    $('#wait,#label-wait').hide(); 
  });

  function getStatus(ele){

    let jenis = $(ele).val();

    $('#status').empty().append('<option value="" selected disabled>--Pilih Status--</option>');

    if(jenis == 'Donasi'){
      $('#status').append('<option value="Donasi">Masih Tersedia</option><option value="Donasi Selesai">Tidak Ada</option>');
    } else {
      $('#status').append('<option value="Kebutuhan">Belum Terpenuhi</option><option value="Kebutuhan Selesai">Sudah Terpenuhi</option>');
    }

    $('#status').attr('disabled', false);
  }

  function openStart(){
    $('#start_date').attr('disabled', false);
  }

  function openEnd(){
    $('#end_date').attr('disabled', false);
  }


  function getStatusUser(ele){

    let user = $(ele).val();

    $('#status_user').empty().append('<option value="" selected disabled>--Pilih Status User--</option>');

    if(user == '3'){
      $('#status_user').append('<option value="1">Sudah Pernah Donasi</option><option value="0">Belum Pernah Donasi</option><option value="all">Semua</option>');
    } else {
      $('#status_user').append('<option value="1">Sudah Pernah Menerima Donasi</option><option value="0">Belum Pernah Menerima Donasi</option><option value="all">Semua</option>');
    }

    $('#status_user').attr('disabled', false);
  }

  function getLabelStatus(ele){
    let label = $(ele).find('option:selected').text();
    $('#label_status').val(label);
  }

  function getStatusBuku(ele){

    let user = $(ele).val();

    $('#status_buku').empty().append('<option value="" selected disabled>--Pilih Status Buku--</option>');

    if(user == '3'){
      $('#status_buku').append('<option value="1">Tersedia</option><option value="0">Sudah Diserahkan</option><option value="all">Semua</option>');
      $('#status_buku').attr('disabled', false);
    } else if(user == '4'){
      $('#status_buku').append('<option value="1">Sedang dibutuhkan</option><option value="0">Sudah terpenuhi</option><option value="all">Semua</option>');
      $('#status_buku').attr('disabled', false);
    } else {
      $('#status_buku').empty().append('<option value="all">Semua</option>');
      $('#status_buku').attr('disabled', true);
      $('#label_buku').val('Semua');
    }

  }

  function getLabelBuku(ele){
    let label = $(ele).find('option:selected').text();
    $('#label_buku').val(label);
  }

</script>
</body>
</html>
