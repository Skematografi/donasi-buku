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
              <h3><b>Laporan</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="<?php echo base_url('dashboard/cetakLaporan'); ?>" target="_blank" autocomplete="off">
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
              <!-- /.card-body -->
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

</script>
</body>
</html>
