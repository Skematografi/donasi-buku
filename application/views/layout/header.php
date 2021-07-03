<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Gudang Buku</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url();?>assets/images/favicon.png" rel="icon">
  <link href="<?php echo base_url();?>assets/images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url();?>assets/vendor/style.css" rel="stylesheet">
  <style>
        .icon-whatsapp {
            position: fixed;
            z-index: 2147483647;
        }
        #whatsapp {
            border-radius: 2px;
            bottom: 15px;
            box-shadow: 0 0 10px rgb(0 0 0 / 5%);
            color: #fff;
            font-size: 28px;
            height: 45px;
            line-height: 49px;
            position: fixed;
            right: 15px;
            text-align: center;
            transition: all 0.3s ease 0s;
            width: 45px;
            z-index: 200;
        }
    </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="<?php echo base_url();?>">Gudang Buku</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="<?php echo base_url();?>assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="<?= ($nav == 'home' ? 'active' : ''); ?>"><a href="<?php echo base_url();?>">Home</a></li>
          <?php if(in_array($role_id, array(1,4))): ?>
            <li class="<?= ($nav == 'tersedia' ? 'active' : ''); ?>"><a href="<?php echo base_url('app/bukuTersedia');?>">Buku Tersedia</a></li>
            <li class="<?= ($nav == 'permohonan' ? 'active' : ''); ?>"><a href="<?php echo base_url('app/permohonan');?>">Permohonan Buku</a></li>
            <li class="<?= ($nav == 'konfirmasi' ? 'active' : ''); ?>"><a href="<?php echo base_url('app/konfirmasiKebutuhan');?>">Konfirmasi</a></li>
            
          <?php endif; ?>

          <?php if(in_array($role_id, array(1,3))): ?>
            <li class="<?= ($nav == 'kebutuhan' ? 'active' : ''); ?>"><a href="<?php echo base_url('app/kebutuhanBuku');?>">Kebutuhan Buku</a></li>
            <li class="<?= ($nav == 'donasi' ? 'active' : ''); ?>"><a href="<?php echo base_url('app/donasi');?>">Donasi</a></li>
            <li class="<?= ($nav == 'konfirmasi' ? 'active' : ''); ?>"><a href="<?php echo base_url('app/konfirmasiDonasi');?>">Konfirmasi</a></li>
           
          <?php endif; ?>

          <?php if($role_id == ''): ?>
              <li class="<?= ($nav == 'tersedia' ? 'active' : ''); ?>"><a href="<?php echo base_url('app/bukuTersedia');?>">Buku Tersedia</a></li>
              <li class="<?= ($nav == 'kebutuhan' ? 'active' : ''); ?>"><a href="<?php echo base_url('app/kebutuhanBuku');?>">Kebutuhan Buku</a></li>
              <li><button type="button" onclick="login()" class="btn btn-block btn-outline-info mt-2 pl-3 pr-3">Masuk</button></li>
          <?php endif; ?>
          <?php if($role_id != ''): ?>
            <li class="<?= ($nav == 'profile' ? 'active' : ''); ?>"><a href="<?php echo base_url('app/profile');?>">Profile</a></li>
            <li><a href="<?php echo base_url('auth/logout');?>">Keluar</a></li>
          <?php endif; ?>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
  <main id="main">