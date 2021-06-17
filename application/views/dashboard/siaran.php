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
                  <h3><b>Siaran</b></h3>
                </div>
                <div class="col-md-6">
                <?php if(in_array($this->session->userdata('role_id'),[1,2])): ?>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah"  style="float:right;">Tambah</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <table id="tableProduct" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr class="text-center">
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Terkirim</th>
                        <th>Penerima</th>
                        <?php if(in_array($this->session->userdata('role_id'),[1,2])): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach($broadcast as $row): ?>
                    <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td><?= $row['title']; ?></td>
                    <td>
                        <img src="<?php echo base_url();?>assets/siaran/<?= $row['image']; ?>" alt="" style="width:300px;">
                    </td>
                    <td><?= $row['description']; ?></td>
                    <td class="text-center"><?= $row['repeat']; ?> x</td>
                    <td><?= $row['receiver']; ?> Member</td>
                    <td class="text-center">
                        <?= $row['action']; ?><br><br>
                        <div class="text-center">
                            <div class="spinner-border text-secondary" id="wait" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <small id="label-wait">Loading...</small>
                        </div>
                    </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
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
    <strong>Copyright &copy; 2021 <a href="<?php echo base_url();?>" target="_blank">Gerai Fashion</a>.</strong>
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
    $("#tableProduct").DataTable();
    $("#wait,#label-wait").hide();
  });

  
  function hapusSiaran(ele){

    let id = $(ele).attr('data-id');
    let url = '<?= base_url(); ?>Dashboard/hapus_siaran';

    $.ajax({
    url : url,
    method : 'POST',
    data: {id: id},
    dataType: 'json',
    success : function(res){
        window.location.href = "<?= base_url(); ?>"+res.link;
    }, error : function(err){
        console.log(err)
    }
    });

  }

  function kirimSiaran(ele){

    let id = $(ele).attr('data-id');
    let url = '<?= base_url(); ?>Dashboard/kirim_siaran';

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
</script>
</body>
</html>
