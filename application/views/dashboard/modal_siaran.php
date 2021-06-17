
  <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="title_modal_product">Tambah Siaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <form method="post" id="form_elastis" enctype="multipart/form-data" action="<?php echo base_url('dashboard/tambah_siaran'); ?>" autocomplete="off">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Judul <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="title" name="title" maxlength="100" rows="2" required></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Gambar <span class="text-danger">*</span></label>
                        <input type="file" id="image" name="image" required><br>
                        <small class="text-danger msg-image-1">* Max. 2 MB (jpg/jpeg/png)</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
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