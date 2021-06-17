
  <div class="modal fade" id="modal_tindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="title_modal_promo"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <form method="post" action="<?php echo base_url('Dashboard/selesaiKeluhan'); ?>" autocomplete="off">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="action" name="action" rows="3" required></textarea>
                    <input type="hidden" id="complaint_id" name="complaint_id">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>