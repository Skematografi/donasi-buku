
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <img src="<?php echo base_url();?>assets/images/logo/library.jpg" alt="AdminLTE Logo" class="brand-image mb-3 mx-auto d-block" style=" width:200px; height:70px; opacity: .8;">
      <p class="login-box-msg">Masukan email anda</p>
      <?php echo $this->session->flashdata('message'); ?>
      <form action="<?php echo base_url();?>auth/reset_password" method="post" autocomplete="off">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Permintaan Password Baru</button>
          </div>
          <!-- /.col -->
        </div>
        <label for="" class="mt-2">Sudah punya akun?</label><br>
        <a href="<?php echo base_url();?>auth">Masuk</a>
      </form>
    </div>
    <div class="card-footer">
      <a href="<?php echo base_url();?>"> Kembali ke Website</a>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

