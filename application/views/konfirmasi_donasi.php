
<section id="permohonan" class="contact" style="margin-top:50px;">
    <div class="container">
        
    <div class="section-title" data-aos="fade-up">
        <h2>Konfirmasi Donasi</h2>
        <p>Konfimasi pada sistem bahwa donasi anda telah diserahkan</p>
        <p>kepada penerima donasi agar tidak ada orang lain yang meminta donasi buku tersebut lagi</p>
    </div>
    <div class="row justify-content-center" data-aos="fade-up">
        <div class="col-md-10">
          <small><?php echo $this->session->flashdata('message'); ?></small>
          <form action="<?= base_url('app/simpanKonfDonasi'); ?>" method="post" enctype="multipart/form-data" >
            <div class="form-row">
              <div class="col-md-6 form-group">
                <label for="">Tanggal Penyerahan</label>
                <input type="date" name="delivery_date" class="form-control" id="delivery_date" required/>
                <input type="hidden" name="receiver_id" class="form-control" id="receiver_id"/>
                <div class="validate"></div>
              </div>
              <div class="col-md-6 form-group">
                <label for="">Buku Donasi Anda</label>
                <select name="book_id" id="book_id" class="form-control" required>
                    <option value="" selected disabled>-- Pilih Buku Donasi --</option>
                    <?php foreach($donasi as $item): ?>
                        <option value="<?= $item->id; ?>"><?= $item->title; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <label for="">Telepon Penerima</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">+62</span>
                        </div>
                        <input type="number" class="form-control" onblur="getPenerimaDonasi(this)"  id="phone" name="phone" required>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Nama Penerima</label>
                    <input type="text" class="form-control" name="name" id="name" readonly />
                    <small style="margin-top: 0; color:red;" id="msgPhone">Telepon penerima donasi tidak terdaftar</small>
                </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 form-group">
                    <label for="">Dokumentasi <small class="text-danger msg-image-1">* Max. 2 MB (jpg/jpeg/png)</small></label>
                    <input type="file" class="form-control" id="image" name="image" required>
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-group">
              <label for="">Lokasi Penyerahan</label>
              <textarea class="form-control" name="location" id="location" rows="3" required></textarea>
              <div class="validate"></div>
            </div>
            <div class="mb-3">
            </div>
            <div class="text-center"><button class="btn btn-primary" type="submit" id="btnKonfDonasi" disabled>Konfirmasi</button></div>
          </form>
        </div>

      </div>

    </div>
  </section>