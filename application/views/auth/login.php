
<body class="hold-transition login-page bg-light">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card shadow">
    <div class="card-header">
      <h3 class="text-center">SILAHKAN MASUK</h3>
    </div>
    <div class="card-body login-card-body" style="border-radius: 20px;">
      <img src="<?php echo base_url();?>assets/images/logo/library.jpg" alt="AdminLTE Logo" class="brand-image mb-3 mx-auto d-block" style=" width:200px; opacity: .8;">
      <p class="login-box-msg"></p>
      <?php echo $this->session->flashdata('message'); ?>
      <form action="<?php echo base_url();?>auth" method="post" autocomplete="off">
        <div class="form-group">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" autofocus="autofocus" value="<?php echo set_value('email'); ?>" required>
          
          <!-- <?php echo form_error('email','<small class="text-danger pl-3">','</small>'); ?> -->
        </div>
        <div class="form-group">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
          <!-- <?php echo form_error('password','<small class="text-danger pl-3">','</small>'); ?> -->
          
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
        </div>
          <label for="" class="mt-2">Belum punya akun?</label><br>
          <a href="<?php echo base_url();?>auth/registerDonatur">Daftar Donatur</a><br>
          <a href="<?php echo base_url();?>auth/registerPenerima">Daftar Penerima Donasi</a><br><br>
          <a href="<?php echo base_url();?>auth/forget_password">Lupa password?</a><br>
      </form>
    </div>
    <div class="card-footer">
      <a href="<?php echo base_url();?>"> Kembali ke Website</a>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

