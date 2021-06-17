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
                        <label for="exampleInputPassword1">Kategori Keluhan<span class="text-danger">*</span></label>
                        <select class="form-control" name="category" required>
                            <option value="" selected disabled>--Pilih Kategori Keluhan--</option>
                            <option value="Produk">Produk</option>
                            <option value="Pelayanan">Pelayanan</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Status</label>
                          <select class="form-control" name="status" id="status">
                              <option value="" selected disabled>--Pilih Status--</option>
                              <option value="Menunggu Tindakan">Menunggu Tindakan</option>
                              <option value="Proses">Proses</option>
                              <option value="Selesai">Selesai</option>
                          </select>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Tanggal Mulai<span class="text-danger">*</span></label>
                      <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Tanggal Akhir<span class="text-danger">*</span></label>
                      <input type="date" class="form-control" id="end_date" name="end_date" required>
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
    <strong>Copyright &copy; 2021 <a href="<?php echo base_url();?>gerai" target="_blank">Gerai Fashion</a>.</strong>
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

  function proses(ele){

    let id = $(ele).attr('data-id');
    let url = '<?= base_url(); ?>Dashboard/prosesKeluhan';

    $.ajax({
      url : url,
      method : 'POST',
      data: {id: id},
      dataType: 'json',
      beforeSend: function() { $('#wait,#label-wait').show(); },
      complete: function() { $('#wait,#label-wait').hide(); },
      success : function(res){
        window.location.href = "<?= base_url(); ?>"+res.link;
      }, error : function(err){
        console.log(err)
      }
    });
  }

  function selesai(ele){

    let id = $(ele).attr('data-id');
    $('#complaint_id').val(id);
    $('#modal_tindakan').modal('show');
    $('#wait,#label-wait').show();
}

</script>
</body>
</html>
