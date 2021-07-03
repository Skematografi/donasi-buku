
  <?php if(in_array($role_id, array('', 1, 2, 3))): ?>
    <section id="buku" class="portfolio section-bg" style="margin-top:50px;">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Kebutuhan Buku</h2>
          <p>Buku-buku ini dibutuhkan oleh penerima donasi</p>
          <p>jika anda ingin berdonasi anda dapat menghubungi kontak yang tertera</p>
        </div>
        <?php 
            if(count($kebutuhan_buku) == 0){
              echo '<div class="alert alert-secondary text-center" role="alert">Tidak ada kebutuhan buku dari penerima donasi.</div>';
            }
        ?>

        <div class="row portfolio-container" data-aos="fade-up">
          <?php foreach($kebutuhan_buku as $item):  ?>
          
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="<?php echo base_url();?>assets/buku/<?= $item['image']; ?>" class="img-fluid" alt="" style="width:500px; height:550px;">
              <div class="portfolio-info">
                <h4><?= $item['title']; ?></h4>
                <div class="portfolio-links">
                  <a href="<?php echo base_url();?>assets/buku/<?= $item['image']; ?>" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="bx bx-show-alt"></i></a>
                  <?php if($role_id != ''): ?>
                    <a href="https://api.whatsapp.com/send?phone=<?= $item['phone']; ?>&text=Hai%20<?= $item['name'].', '; ?>%20Saya%20<?= $this->session->userdata('name'); ?>%20dari%20Gudang%20Buku" target="_blank" title="Hubungi pemohon donasi"><i class="bx bx-phone-call"></i></a>
                  <?php endif; ?>
                </div>
                <br>
                <p>Penulis : <?= $item['writer']; ?></p>
                <p>Edisi : <?= $item['edition'].' - Tahun '.$item['year']; ?></p>
                <p>Genre : <?= $item['genre']; ?></p>
                <p>Jumlah Halaman : <?= $item['pages']; ?> Lembar</p>
                <p>Penerbit : <?= $item['publisher']; ?></p>
                <p>Kebutuhan : <?= $item['quantity']; ?> Buku</p>
                <br>
                <br>
                <br>
                <p>Deskripsi :</p>
                <p><?= $item['description']; ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>
  <?php endif; ?>