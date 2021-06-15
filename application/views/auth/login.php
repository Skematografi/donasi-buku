
<body class="hold-transition login-page bg-dark">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body" style="border-radius: 20px;">
      <img src="<?php echo base_url();?>assets/images/logo/logo.png" alt="AdminLTE Logo" class="brand-image mb-3 mx-auto d-block" style=" width:200px; height:70px; opacity: .8;">
      <p class="login-box-msg"></p>
      <?php echo $this->session->flashdata('message'); ?>
      <form action="<?php echo base_url();?>auth" method="post" autocomplete="off">
        <div class="form-group">
          <input type="username" id="username" name="username" class="form-control text-center" placeholder="Username" autofocus="autofocus" value="<?php echo set_value('username'); ?>" required>
          
          <!-- <?php echo form_error('username','<small class="text-danger pl-3">','</small>'); ?> -->
        </div>
        <div class="form-group">
          <input type="password" id="password" name="password" class="form-control text-center" placeholder="Password" required="">
          <!-- <?php echo form_error('password','<small class="text-danger pl-3">','</small>'); ?> -->
          
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" style="background-color: #ff00de;">Login</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

