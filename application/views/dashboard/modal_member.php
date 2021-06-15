
  <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
            <form method="post" id="form_elastis" action="<?php echo base_url('dashboard/tambah_member'); ?>" autocomplete="off">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
                    <input type="hidden" id="member_id" name="member_id">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-control" name="gender" required>
                        <option value="" selected disabled>--Pilih Jenis Kelamin--</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Telepon <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="phone" name="phone" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Provinsi <span class="text-danger">*</span></label>
                        <select class="form-control" name="state" id="state" onchange="getCity(this)" required>
                            <option value="" selected disabled>--Pilih Provinsi--</option>
                            <?php foreach($locations as $row): ?>
                                <option value="<?= $row['state']; ?>" data-state-id="<?= $row['state_id']; ?>"><?= $row['state']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                    <select class="form-control" name="city" id="city" onchange="getDistrict(this)" required disabled>
                        <option value="" selected disabled>--Pilih Kabupaten/Kota--</option>
                    </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kecamatan <span class="text-danger">*</span></label>
                    <select class="form-control" name="district" id="district" required disabled>
                        <option selected disabled>--Pilih Kecamatan--</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Kode Pos</label>
                    <input type="number" class="form-control" id="postal_code" name="postal_code" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
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

function getCity(ele){
    let state_id = $(ele).find('option:selected').attr('data-state-id');
    let url = "<?php echo base_url(); ?>cart/getCityByState";


    $.ajax({
        type : 'POST',
        url : url,
        data : { state_id : state_id},
        success : function(res){

            let array_city = JSON.parse(res);

            $('#city').empty().append('<option selected disabled>--Pilih Kabupaten/Kota--</option>');
            
            array_city.forEach(function(entry){
                $('#city').append('<option value="'+entry['city']+'" data-city-id="'+entry['city_id']+'">'+entry['full_city']+'</option>');
            });

            $('#city').attr('disabled', false);
            $('#district').empty().append('<option selected disabled>--Pilih Kecamatan--</option>');
            $('#district').attr('disabled', true);

        }, error : function(err){
            console.log(err)
        } 
        
    })
}

function getDistrict(ele){
    let city_id = $(ele).find('option:selected').attr('data-city-id');
    let url = "<?php echo base_url(); ?>cart/getDistrictByCity";


    $.ajax({
        type : 'POST',
        url : url,
        data : { city_id : city_id},
        success : function(res){

            let array_district = JSON.parse(res);

            $('#district').empty().append('<option selected disabled>--Pilih Kecamatan--</option>');
            
            array_district.forEach(function(entry){
                $('#district').append('<option value="'+entry['district']+'" data-district-id="'+entry['district_id']+'">'+entry['district']+'</option>');
            });

            $('#district').attr('disabled', false);

        }, error : function(err){
            console.log(err)
        } 
        
    })
}
</script>