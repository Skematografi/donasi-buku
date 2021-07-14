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
                  <h3><b>List Kebutuhan Buku</b></h3>
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
                  <th>Cover</th>
                  <th width="250px">Buku</th>
                  <th width="300px;">Deskripsi</th>
                  <th>Kategori</th>
                  <th>Jumlah</th>
                  <th>Pemohon</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach($kebutuhan as $row): ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td>
                            <img src="<?php echo base_url();?>assets/buku/<?= $row['image']; ?>" alt="" style="width:100px; opacity: .8;">
                        </td>
                        <td>
                            Judul : <br><b class="text-info"><?= $row['title']; ?></b><br>
                            Penulis : <br><b class="text-info"><?= $row['writer']; ?></b><br>
                            Edisi : <br><b class="text-info"><?= ($row['edition'] == '' ? '-' : $row['edition']); ?></b><br>
                            Tahun : <br><b class="text-info"><?= $row['year']; ?></b><br>
                            Jumlah Hal. : <br><b class="text-info"><?= $row['pages']; ?></b><br>
                            Penerbit : <br><b class="text-info"><?= $row['publisher']; ?></b><br>
                        </td>
                        <td class="text-center"><?= $row['description']; ?></td>
                        <td><?= $row['genre']; ?></td>
                        <td><?= $row['quantity']; ?> Buku</td>
                        <td><?= $row['penerima']; ?></td>
                        <td class="text-center">
                            <?php
                                if($row['status'] == 'Kebutuhan'){
                                    echo '<span class="badge badge-danger">Belum Terpenuhi</span>';
                                } else {
                                    echo '<span class="badge badge-success">Sudah Terpenuhi</span>';
                                    echo '<br>Donatur : <b>'.$row['sender'].'</b><br>';
                                    echo 'Telp. : <b>0'.substr($row['sender_phone'], 2).'</b><br>';
                                    echo 'Lokasi : <b>'.$row['location'].'</b><br><br>';
                                    echo '<img src="'.base_url().'assets/dokumentasi/'.$row['dokumentasi'].'" alt="" style="width:200px; opacity: .8;">';
                                
                                }
                            ?>
                        </td>
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
