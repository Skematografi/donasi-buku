
<section id="permohonan" class="contact" style="margin-top:50px;">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
          <h2>Profile</h2>
          <p>Pastikan kontak anda aktif agar donatur atau penerima donasi dapat menghungi anda.</p>
      </div>
      <div class="row justify-content-center" data-aos="fade-up">
          <div class="col-md-10">
            <small><?php echo $this->session->flashdata('message'); ?></small>
            <form action="<?php echo base_url();?>auth/update" method="post" autocomplete="off">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <?php if($role_id == 4): ?>
                      <label for="">Status</label>
                      <select class="form-control" name="status" disabled>
                          <option value="" selected disabled>Pilih Status</option>
                          <option value="Umum" <?= ($profile->type == 'Umum' ? 'selected' : ''); ?>>Umum</option>
                          <option value="Mahasiswa" <?= ($profile->type == 'Umum' ? 'Mahasiswa' : ''); ?>>Mahasiswa</option>
                      </select>
                    <?php endif; ?>
                    <?php if($role_id == 3): ?>
                      <label for="">NPM</label>
                      <input type="number" class="form-control" id="npm" name="npm" value="<?= $profile->npm; ?>" placeholder="NPM" disabled>
                    <?php endif; ?>

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $profile->name; ?>" placeholder="Nama Lengkap" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Telepon</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">+62</span>
                      </div>
                      <input type="number" class="form-control"  id="phone" name="phone" value="<?= substr($profile->phone,2); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $profile->email; ?>" placeholder="Email" value="<?php echo set_value('Email'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select class="form-control" name="gender" required>
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <option value="Pria" <?= ($profile->gender == 'Pria' ? 'selected' : ''); ?>>Pria</option>
                        <option value="Wanita" <?= ($profile->gender == 'Wanita' ? 'selected' : ''); ?>>Wanita</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Provinsi</label>
                    <select class="form-control" name="state" id="state" onchange="getCity(this)" required>
                        <option value="" selected disabled>Pilih Provinsi</option>
                        <?php foreach($locations as $row): ?>
                            <option value="<?= $row['state']; ?>" data-state-id="<?= $row['state_id']; ?>" <?= ($profile->state == $row['state'] ? 'selected' : ''); ?>><?= $row['state']; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Kabipaten/Kota</label>
                    <select class="form-control" name="city" id="city" onchange="getDistrict(this)" required>
                        <option value="<?= $profile->city; ?>" selected><?= $profile->city; ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Kecamatan</label>
                    <select class="form-control" name="district" id="district" required>
                    <option value="<?= $profile->district; ?>" selected><?= $profile->district; ?></option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Alamat" required><?= $profile->address; ?></textarea>
                  </div>
                </div>
              </div>
              <div class="text-center"><button class="btn btn-primary" type="submit">Update Profile</button></div>
            </form>
          </div>
      </div>
    </div>
  </section>