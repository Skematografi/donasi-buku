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
                  <h3><b>Produk</b></h3>
                </div>
                <div class="col-md-6">
                <?php if(!in_array($this->session->userdata('role_id'),[2,3])): ?>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah"  style="float:right;" onclick="cleanForm()">Tambah</button>
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
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Berat (gr)</th>
                        <th>Ukuran</th>
                        <th>Harga (Rp)</th>
                        <th>Stok</th>
                        <?php if(!in_array($this->session->userdata('role_id'),[2,3])): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; foreach($products as $row): ?>
                      <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo $row['code']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo str_replace(',','<br>',$row['description']); ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td class="text-center"><img src="<?php echo base_url();?>assets/produk/<?php echo $row['image'];?>" style="width:70px; height: 70px;"></td>
                        <td class="text-center"><?php echo $row['weight']; ?></td>
                        <td class="text-center"><?php echo $row['size']; ?></td>
                        <td class="text-center"><?php echo number_format($row['price'],2,',','.'); ?></td>
                        <td class="text-center"><?php echo ($row['stock'] > 0 ? $row['stock'] :  '<span class="badge badge-danger">Habis</span>'); ?></td>
                        <?php if(!in_array($this->session->userdata('role_id'),[2,3])): ?>
                        <td class="text-center"><?php echo $row['action']; ?></td>
                        <?php endif; ?>
                      </tr>
                      <?php endforeach; ?>
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
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="<?php echo base_url();?>" target="_blank">Clothing Brand Colonizer.co</a>.</strong>
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
  });

  function editProduct(ele){

    let id = $(ele).attr('data-id');
    let url = '<?= base_url(); ?>Dashboard/edit_produk';

    $.ajax({
      url : url,
      method : 'POST',
      data: {id: id},
      dataType: 'json',
      success : function(res){

        cleanForm();
        $('#title_modal_product').empty().append('Update Produk');
        $('.msg-image-1').hide();
        $('.msg-image-2').show();
        $('#image').attr('required', false);

        $('#code').val(res[0].code).attr('readonly', true);
        $('#name').val(res[0].name);
        $('#description').val(res[0].description);
        $('#category').val(res[0].category);
        // $('#image').val(res[0].image);
        $('#size').val(res[0].size);
        $('#weight').val(res[0].weight);
        $('#price').val(res[0].price);
        $('#stock').val(res[0].stock);
        $('#product_id').val(res[0].id);
        $('#submit').val('Update');

        $('#modal_tambah').modal('show');

      }, error : function(err){
        console.log(err)
      }
    });
  }

  function deleteProduct(ele){

    let id = $(ele).attr('data-id');
    let url = '<?= base_url(); ?>Dashboard/hapus_produk';

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
    $('.msg-image-1').show();
    $('.msg-image-2').hide();
    $('#image').attr('required', true);
    $('#code').attr('readonly', false);
    $('#code, #name, #description,#category,#image,#size,#weight,#price,#stock,#product_id').val('');
    $('#title_modal_product').empty().append('Tambah Produk');
    $('#submit').val('Simpan');
  }
</script>
</body>
</html>
