<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    * {
        box-sizing: border-box;
    }

    .row{
        background-color: #ffffff;
        width: 500px;
        margin: auto;
        padding: 30px;
        text-align: justify;

    }
    
    body {
        margin:25px;
        background-color: #ececec;
    }

    .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
    }
    
</style>
</head>
<body>
    <div class="row">
        <img src="<?php echo base_url();?>assets/images/logo/logo.png" class="center" style="width:200px; hight:auto;">
        <p>Dear <?= $informer;?>,</p>
        <p>Keluhan anda tentang <?= $category;?> kami sedang diproses.</p> 
        <p>Mohon maaf, berikut detail keluhan anda :</p>
        <hr>
        <p>Kronologi</p>
        <table style="border:1px solid #cecece; padding:5px;">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?= $created_at;?></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>:</td>
                <td><?= $description;?></td>
            </tr>
            <tr>
                <td>Produk</td>
                <td>:</td>
                <td><?= ($product == NULL ? '-' :  $product);?></td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>Hormat Kami,</p>
        <br>
        <p>Gerai Fashion</p>
    </div>
</body>
</html>