
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card" style="width: 500px; margin:auto; right:80px;">
    <div class="card-header">
      <h2 class=" text-center">DAFTAR PENERIMA DONASI</h2>
    </div>
    <div class="card-body register-card-body">
      <!-- <img src="<?php echo base_url();?>assets/images/logo/logo.png" alt="AdminLTE Logo" class="brand-image mb-3 mx-auto d-block" style=" width:100px; opacity: .8;"> -->
      <?php echo $this->session->flashdata('message'); ?>
      <form action="<?php echo base_url();?>auth/registerPenerima" method="post" autocomplete="off">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <select class="form-control" name="status" required>
                  <option value="" selected disabled>Pilih Status</option>
                  <option value="Umum">Umum</option>
                  <option value="Mahasiswa">Mahasiswa</option>
              </select>
              <input type="hidden" id="role" name="role" value="4">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">+62</span>
              </div>
              <input type="number" class="form-control"  id="phone" name="phone" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('Email'); ?>" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <select class="form-control" name="gender" required>
                  <option value="" selected disabled>Pilih Jenis Kelamin</option>
                  <option value="Pria">Pria</option>
                  <option value="Wanita">Wanita</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <select class="form-control" name="state" id="state" onchange="getCity(this)" required>
                  <option value="" selected disabled>Pilih Provinsi</option>
                  <?php foreach($locations as $row): ?>
                      <option value="<?= $row['state']; ?>" data-state-id="<?= $row['state_id']; ?>"><?= $row['state']; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <select class="form-control" name="city" id="city" onchange="getDistrict(this)" required disabled>
                  <option value="" selected disabled>Pilih Kabupaten/Kota</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <select class="form-control" name="district" id="district" required disabled>
                  <option selected disabled>Pilih Kecamatan</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <textarea class="form-control" id="address" name="address" rows="3" placeholder="Alamat" required></textarea>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="password" class="form-control" id="password1" name="password1" placeholder="Password" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password" required>
              </div>
            </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
        </div>

      </form>
    </div>

    <div class="card-footer">
      <a href="<?php echo base_url();?>"> Kembali ke Website</a>
    </div>
  </div>

</div>

