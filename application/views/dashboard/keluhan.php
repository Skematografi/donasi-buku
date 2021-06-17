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
              <div class="row">
                <div class="col-md-6">
                  <h3><b>Keluhan</b></h3>
                </div>
                <div class="col-md-6">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah"  style="float:right;" onclick="cleanForm()">Tambah</button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="pelanggan" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr class="text-center">
                  <th>No.</th>
                  <th>Tgl Keluhan</th>
                  <th>Kategori</th>
                  <th>Kronologi</th>
                  <th>Pelapor</th>
                  <th>Status</th>
                  <th>Tindakan</th>
                  <?php if($this->session->userdata('role_id') != 2): ?>
                  <th>Aksi</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach($complaints as $row): ?>
                    <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td><?= $row['category']; ?></td>
                    <td><?= $row['description']; ?></td>
                    <td><?= $row['informer']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td><?= $row['action']; ?></td>
                    <?php if($this->session->userdata('role_id') != 2): ?>
                    <td class="text-center"> 
                      <?= $row['response']; ?><br><br>
                        <div class="text-center" id="wait">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <small id="label-wait">Loading...</small>
                        </div>
                    </td>
                    <?php endif; ?>
                    </tr>
                <?php endforeach;?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
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
}

</script>
</body>
</html>
