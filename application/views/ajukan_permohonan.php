
<section id="permohonan" class="contact" style="margin-top:50px;">
    <div class="container">
        
    <div class="section-title" data-aos="fade-up">
        <h2>Permohonan Buku</h2>
        <p>Masukan kebutuhan buku anda</p>
        <p>agar donatur dapat melihat kebutuhan buku anda dan tunggu donar menghubungi anda</p>
    </div>
    <div class="row justify-content-center" data-aos="fade-up">
        <div class="col-md-10">
          <small><?php echo $this->session->flashdata('message'); ?></small>
          <form action="<?= base_url('app/simpanKebutuhan'); ?>" method="post" enctype="multipart/form-data" >
            <div class="form-row">
              <div class="col-md-6 form-group">
                <input type="text" name="title" class="form-control" id="title" placeholder="Judul Buku" required/>
                <div class="validate"></div>
              </div>
              <div class="col-md-6 form-group">
                <input type="text" class="form-control" name="writer" id="writer" placeholder="Penulis" required />
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 form-group">
                <input type="text" name="edition" class="form-control" id="edition" placeholder="Edisi (opsional)"/>
                <div class="validate"></div>
              </div>
              <div class="col-md-6 form-group">
                <input type="text" class="form-control" name="genre" id="genre" placeholder="Kategori" required />
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 form-group">
                <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Penerbit (opsional)" />
                <div class="validate"></div>
              </div>
              <div class="col-md-6 form-group">
                <input type="number" name="year" class="form-control" id="year" placeholder="Tahun" required/>
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 form-group">
                <input type="number" name="pages" class="form-control" id="pages" placeholder="Jumlah Halaman" required/>
                <div class="validate"></div>
              </div>
              <div class="col-md-6 form-group">
                <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Jumlah Kebutuhan" required/>
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 form-group">
                    <label for="">Gambar Sampul <small class="text-danger msg-image-1">* Max. 2 MB (jpg/jpeg/png)</small></label>
                    <input type="file" class="form-control" id="image" name="image" required>
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="description" id="description" rows="5" placeholder="Deskripsi" required></textarea>
              <div class="validate"></div>
            </div>
            <div class="mb-3">
            </div>
            <div class="text-center"><button class="btn btn-primary" type="submit">Kirim Permohonan</button></div>
          </form>
        </div>

      </div>

    </div>
  </section>