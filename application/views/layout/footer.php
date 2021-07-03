    </main> 
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Gudang Buku</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->
<!-- 
  <a href="https://api.whatsapp.com/send?phone=6283896117890&text=Assalamualaikum%20Wr.%20Wb.%20Admin%20Gerai%20Fashion" target="_blank" class="icon-whatsapp">
      <img src="<?php echo base_url();?>assets/images/logo/whatsapp.png" alt="icon whatsapp" id="whatsapp" >
  </a> -->

  <!-- <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a> -->

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url();?>assets/vendor/main.js"></script>

  <script>

    $(function(){
      $('#msgPhone').hide();
    });

    function login(){
      window.location.href = "<?= base_url('Auth'); ?>";
    }

    function logout(){
      window.location.href = "<?= base_url('Auth/logout'); ?>";
    }
  </script>

    
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

    function getPenerimaDonasi(ele){
      let phone = $(ele).val();
      let url = "<?php echo base_url(); ?>app/getPenerimaDonasi";

      $.ajax({
          type : 'POST',
          url : url,
          data : { phone : phone},
          success : function(res){
            let data = JSON.parse(res);

            if(data == null){
              $('#name, #receiver_id').val('');
              $('#msgPhone').show();
              $('#btnKonfDonasi').attr('disabled', true);
            } else {
              $('#receiver_id').val(data.id);
              $('#name').val(data.name);
              $('#msgPhone').hide();
              $('#btnKonfDonasi').attr('disabled', false);
            }

          }, error : function(err){
              console.log(err)
          } 
          
      })
    }

    function getDonatur(ele){
      let phone = $(ele).val();
      let url = "<?php echo base_url(); ?>app/getDonatur";

      $.ajax({
          type : 'POST',
          url : url,
          data : { phone : phone},
          success : function(res){
            let data = JSON.parse(res);

            if(data == null){
              $('#name, #sender_id').val('');
              $('#msgPhone').show();
              $('#btnKonfDonasi').attr('disabled', true);
            } else {
              $('#sender_id').val(data.id);
              $('#name').val(data.name);
              $('#msgPhone').hide();
              $('#btnKonfDonasi').attr('disabled', false);
            }

          }, error : function(err){
              console.log(err)
          } 
          
      })
    }
  </script>

</body>

</html>