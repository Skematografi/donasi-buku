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
                  <h3><b>Member</b></h3>
                </div>
                <div class="col-md-6">
                <?php if($this->session->userdata('role_id') != 3): ?>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah"  style="float:right;" onclick="cleanForm()">Tambah</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="pelanggan" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr class="text-center">
                  <th>No.</th>
                  <th>ID Member</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Telepon</th>
                  <th>Email</th>
                  <th>Alamat</th>
                  <th>Provinsi</th>
                  <th>Kabupaten/Kota</th>
                  <th>Kecamatan</th>
                  <?php if($this->session->userdata('role_id') != 3): ?>
                  <th>Aksi</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach($members as $row): ?>
                <tr>
                  <td class="text-center"><?= $i++; ?></td>
                  <td><?= $row['code']; ?></td>
                  <td><?= $row['name']; ?></td>
                  <td><?= $row['gender']; ?></td>
                  <td><?= $row['phone']; ?></td>
                  <td><?= $row['email']; ?></td>
                  <td><?= $row['address']; ?></td>
                  <td><?= $row['state']; ?></td>
                  <td><?= $row['city']; ?></td>
                  <td><?= $row['district']; ?></td>
                  <?php if($this->session->userdata('role_id') != 3): ?>
                  <td class="text-center"><?= $row['action']; ?></td>
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
  });

  function editPromo(ele){

    let id = $(ele).attr('data-id');
    let url = '<?= base_url(); ?>Dashboard/edit_member';
    let form = $('#form_elastis').serialize();

    $.ajax({
      url : url,
      method : 'POST',
      data: {id: id},
      dataType: 'json',
      success : function(res){

        cleanForm();
        $('#title_modal_promo').empty().append('Update Member');

        $('#member_id').val(res[0].id);
        $('#name').val(res[0].name);
        $('#email').val(res[0].email);
        $('#phone').val(res[0].phone);
        $('#postal_code').val(res[0].postal_code);
        $('#address').val(res[0].address);
        $('#submit').val('Update');

        $('#modal_tambah').modal('show');

      }, error : function(err){
        console.log(err)
      }
    });
  }

  function deletePromo(ele){

    let id = $(ele).attr('data-id');
    let url = '<?= base_url(); ?>Dashboard/hapus_member';

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

  function cleanForm(){
    $('#name, #email,#phone,#postal_code,#address,#member_id').val('');
    $('#title_modal_promo').empty().append('Tambah Member');
    $('#submit').val('Simpan');
  }
</script>
</body>
</html>
