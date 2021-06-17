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

    p, h3{
        text-align: center;
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
        <img src="<?php echo base_url();?>assets/images/logo/logo.png" class="center" style="width:150px; hight:auto;">
        <br>
        <br>
        <img src="<?php echo base_url();?>assets/siaran/<?= $image; ?>" class="center" style="width:400px; hight:auto;">
        <br>
        <p><?= $description; ?></p>
        <br>
        <br>
        <p>Diskusi dengan tim kami :</p>
        <h3>+62 853-1182-9222</h3>
    </div>
</body>
</html>