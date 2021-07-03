
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>


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

            $('#city').empty().append('<option selected disabled>Pilih Kabupaten/Kota</option>');
            
            array_city.forEach(function(entry){
                $('#city').append('<option value="'+entry['city']+'" data-city-id="'+entry['city_id']+'">'+entry['full_city']+'</option>');
            });

            $('#city').attr('disabled', false);
            $('#district').empty().append('<option selected disabled>Pilih Kecamatan</option>');
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

            $('#district').empty().append('<option selected disabled>Pilih Kecamatan</option>');
            
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

</body>
</html>