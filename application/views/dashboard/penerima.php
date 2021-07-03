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
                  <h3><b>List Penerima</b></h3>
                </div>
                <div class="col-md-6">
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="pelanggan" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr class="text-center">
                  <th>No.</th>
                  <th>Status</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Email</th>
                  <th>Telepon</th>
                  <th>Alamat</th>
                  <th>Provinsi</th>
                  <th>Kabupaten/Kota</th>
                  <th>Kecamatan</th>
                  <?php if($role_id == 1): ?>
                  <th>Aksi</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach($penerima as $row): ?>
                    <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td><?= ($row['status'] == 1 ? 'Umum' : 'Mahasiswa'); ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['phone']; ?></td>
                    <td><?= $row['address']; ?></td>
                    <td><?= $row['state']; ?></td>
                    <td><?= $row['city']; ?></td>
                    <td><?= $row['district']; ?></td>
                    <?php if($role_id == 1): ?>
                      <td class="text-center">
                        <a href="<?= base_url('dashboard/deletePenerima/').$row['id']; ?>" title="Klik untuk menghapus"><i class="far fa-trash-alt text-danger"></i></a>
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
  });
</script>
</body>
</html>
