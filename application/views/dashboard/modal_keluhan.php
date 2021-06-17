
  <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="title_modal_promo">Tambah Keluhan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <form method="post" id="form_elastis" action="<?php echo base_url('dashboard/tambah_keluhan'); ?>" autocomplete="off">
              <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ID Member <span class="text-danger">*</span></label>
                        <select class="form-control" name="member_id" id="member_id" onchange="getMember(this)" required>
                            <option value="" selected disabled>--Pilih ID Member--</option>
                            <option value="Umum">Umum</option>
                            <?php foreach($member as $row): ?>
                                <option value="<?= $row['id']; ?>" data-name="<?= $row['name']; ?>" data-email="<?= $row['email']; ?>"><?= $row['code']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" required readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" required readonly>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Kategori <span class="text-danger">*</span></label>
                    <select class="form-control" name="category" required>
                        <option value="" selected disabled>--Pilih Kategori--</option>
                        <option value="Produk">Produk</option>
                        <option value="Pelayanan">Pelayanan</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="created_at" name="created_at" required>
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Produk</label>
                        <select class="form-control" name="product_id" id="product_id">
                            <option value="" selected disabled>--Pilih Produk--</option>
                            <?php foreach($product as $row): ?>
                                <option value="<?= $row['id']; ?>" data-state-id="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Simpan">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  
<script>

function getMember(ele){
    let value = $(ele).find('option:selected').val();
    let name = $(ele).find('option:selected').attr('data-name');
    let email = $(ele).find('option:selected').attr('data-email');

    if(value == 'Umum'){
        $('#name').val('').attr('readonly', false).focus();
        $('#email').val('').attr('readonly', false);
    } else {
        $('#name').val(name).attr('readonly', true);
        $('#email').val(email).attr('readonly', true);
    }
}
</script>