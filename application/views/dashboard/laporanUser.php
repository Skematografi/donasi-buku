<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Laporan User Gudang Buku</title>
    <style>
    *{
    font-family:'Courier New', Courier, monospace;
    }
    #customers {
    /* font-family: Arial, Helvetica, sans-serif; */
    border-collapse: collapse;
    width: 100%;
    font-size: 12px;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #fff8eb;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #FFac14;
    color: #ffffff;
    }

    
</style>
</head>
<body>
<!-- <img src="<?= base_url();?>assets/images/logo/logo.png" style="width:200px; hight:auto;"> -->

    <h1 style="text-align: center; margin-bottom:50px;">LAPORAN USER - GUDANG BUKU</h1>
    <div style="display: flex; white-space: nowrap; font-size:15px;">
        <div style="text-align: left;">
            <small>Jenis User : <b style="color:#ff6500;"><?= $jenis; ?></b></small>
        </div>
        <div style="text-align: right;">
            <small>Status User : <b style="color:#ff6500;"><?= $label_status; ?></b></small>
        </div>
    </div>
    <table id="customers" class="table table-bordered table-striped table-responsive">
        <thead>
        <tr class="text-center">
            <th width="5%">No.</th>
            <?php if($jenis == 'Donatur'): ?>
                <th width="20%">NPM</th>
            <?php else:?>
                <th width="20%">Status</th>
            <?php endif;?>
            <th width="20%">Nama</th>
            <th width="10%">Jenis Kelamin</th>
            <th width="25%">Kontak</th>
            <?php if($jenis == 'Donatur'): ?>
                <th width="20%">Donasi Buku</th>
            <?php else:?>
                <th width="20%">Menerima Donasi</th>
            <?php endif;?>
        </tr>
        </thead>
        <tbody>
        <?php if(count($report) > 0): ?>
            <?php $i=1; foreach($report as $row): ?>
                <tr>
                    <td style="text-align: center;"><?= $i++; ?></td>
                    <?php if($jenis == 'Donatur'): ?>
                        <td><?= $row['npm']; ?></td>
                    <?php else:?>
                        <td><?= $row['type']; ?></td>
                    <?php endif;?>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['contact']; ?></td>
                    <?php if($jenis == 'Donatur'): ?>
                        <td style="text-align: center;">
                            <?php
                                $a = (int) $row['total_sender'];
                                $b = (int) $row['total_donasi'];

                                if($a != 0 && $b != 0){
                                    echo $a.'X<br><small><b>Donasi Buku ke Penerima Donasi</b></small><br><br>';
                                    echo $b.'X<br><small><b>Donasi Buku</b></small>';
                                } else if($a == 0 && $b != 0) {
                                    echo $b.'X<br><small><b>Donasi Buku</b></small>';
                                } else if($a != 0 && $b == 0) {
                                    echo $a.'X<br><small><b>Donasi ke Penerima Donasi</b></small><br><br>';
                                } else {
                                    echo '-';
                                }
                            ?>
                        </td>
                    <?php else:?>
                       <td style="text-align: center;"><?= ($row['total_receiver'] == '0' ? '-' : $row['total_receiver'].' X' ); ?></td>
                    <?php endif;?>
                </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr>
                <td colspan="6" style="text-align: center;">Data tidak ditemukan.</td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</body>
</html>