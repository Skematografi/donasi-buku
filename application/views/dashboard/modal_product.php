
  <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="title_modal_product"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <form method="post" id="form_elastis" enctype="multipart/form-data" action="<?php echo base_url('dashboard/do_upload'); ?>" autocomplete="off">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kode Produk <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="code" name="code" maxlength="7" required>
                    <input type="hidden" id="product_id" name="product_id">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="100" autofocus required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Kategori <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="category" name="category" rows="3" placeholder="Gunakan tanda (,) koma untuk pemisah" required></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Gunakan tanda (,) koma untuk pemisah" required></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Gambar <span class="text-danger">*</span></label>
                        <input type="file" id="image" name="image" required><br>
                        <small class="text-danger msg-image-1">* Max. 2 MB (jpg/jpeg/png)</small>
                        <small class="text-info msg-image-2">Tidak Perlu diupload ulang jika tidak ingin mengganti gambar</small>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Harga <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="price" min="1000" name="price" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ukuran <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="size" maxlength="5" name="size" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Berat (gr)<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="weight" min="100" max="1000000" name="weight" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Stok <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="stock" min="1" name="stock" required>
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