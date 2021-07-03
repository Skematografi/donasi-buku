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
        text-align: center;

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
        <img src="<?php echo base_url();?>assets/images/logo/library.jpg" class="center" style="width:200px; hight:auto;">
        <p>Dear <?= $name;?>,</p>
        <p>Terima kasih telah menjadi bagian dari kami.</p> 
        <p>Berikut password baru anda :</p>
        <br>
        <br>
        <table style="border:1px solid #bebebe; text-align: center; padding:80px; margin-left: auto; margin-right: auto;">
            <tr>
                <td><?= $password;?></td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>Salam Hangat Kami,</p>
        <br>
        <p>Gudang Buku</p>
    </div>
</body>
</html>