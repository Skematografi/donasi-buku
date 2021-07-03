
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>Selamat Datang</h1>
      <h2>Gudang Buku adalah Media Donasi & Promosi Buku Mahasiswa</h2>
      <?php
        if($role_id == 4){
          echo '<a href="'.base_url('app/bukuTersedia').'" class="btn-get-started scrollto">Buku Tesedia</a>';
        } else if($role_id == 3) {
          echo '<a href="'.base_url('app/kebutuhanBuku').'" class="btn-get-started scrollto">Kebutuhan Buku</a>';
        } else {
          echo '<a href="'.base_url('auth/registerDonatur').'" class="btn-get-started mr-3">Daftar Donatur</a>';
          echo '<a href="'.base_url('auth/registerPenerima').'" class="btn-get-started">Daftar Penerima Donasi</a>';
        }
      ?>
     
      
    </div>
  </section>