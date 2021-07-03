<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Laporan Transaksi Gudang Buku</title>
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

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #3CC4CD ;
    color: white;
    }
    
</style>
</head>
<body>
<!-- <img src="<?= base_url();?>assets/images/logo/logo.png" style="width:200px; hight:auto;"> -->

    <h1 style="text-align: center; margin-bottom:50px;">LAPORAN GUDANG BUKU</h1>
    <div style="display: flex; white-space: nowrap; font-size:15px;">
        <div style="text-align: left;">
            <small>Jenis Buku : <b style="color:#044EBA;"><?= $jenis_buku; ?></b></small>
        </div>
        <div style="text-align: right;">
            <small>Status Buku : <b style="color:#044EBA;"><?= $status_buku; ?></b></small>
        </div>
    </div>
    <div style="display: flex; white-space: nowrap; font-size:15px;">
        <div style="text-align: left;">
            <small>Periode : <?= date_format($start,"d/m/Y").' - '.date_format($end,"d/m/Y"); ?></small>
        </div>
        <div style="text-align: right;">
            <small>Tanggal Laporan : <?= date('d/m/Y'); ?></small>
        </div>
    </div>
    <table id="customers" class="table table-bordered table-striped table-responsive">
        <thead>
        <tr class="text-center">
            <th>No.</th>
            <th width="120px">Buku</th>
            <th width="150px">Deskripsi</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Nama Akun</th>
            <?php
                if(count($report) > 0){
                    if($report[0]['status'] == 'Donasi' || $report[0]['status'] == 'Donasi Selesai'){
                        echo '<th>Penerima Donasi</th>';
                    } else {
                        echo '<th>Donatur</th>';
                    }
                }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php if(count($report) > 0): ?>
            <?php $i=1; foreach($report as $row): ?>
                <tr>
                    <td style="text-align: center;"><?= $i++; ?></td>
                    <td>
                        Judul : <br><b class="text-info"><?= $row['title']; ?></b><br>
                        Penulis : <br><b class="text-info"><?= $row['writer']; ?></b><br>
                        Edisi : <br><b class="text-info"><?= ($row['edition'] == '' ? '-' : $row['edition']); ?></b><br>
                        Tahun : <br><b class="text-info"><?= $row['year']; ?></b><br>
                        Jumlah Hal. : <br><b class="text-info"><?= $row['pages']; ?></b><br>
                        Penerbit : <br><b class="text-info"><?= $row['publisher']; ?></b><br>
                    </td>
                    <td style="text-align: center;"><?= $row['description']; ?></td>
                    <td><?= $row['genre']; ?></td>
                    <td><?= $row['quantity']; ?> Buku</td>
                    <td><?= $row['account_name']; ?></td>
                    <td>
                        <?php
                            if($row['status'] == 'Donasi' || $row['status'] == 'Donasi Selesai'){
                                echo 'Nama : <br><b>'.($row['receiver'] == '' ? '-' : $row['receiver']).'</b><br>';
                                echo 'Telepon : <br><b>'.($row['receiver_phone'] == '' ? '-' : $row['receiver_phone']).'</b><br><br>';
                                echo 'Tgl. Penyerahan : <br><b>'.($row['delivery_date'] == '' ? '-' : $row['delivery_date']).'</b><br>';
                                echo 'Lokasi : <br>'.($row['location'] == '' ? '-' : $row['location']).'';
                            } else {
                                echo 'Nama : <br><b>'.($row['sender'] == '' ? '-' : $row['sender']).'</b><br>';
                                echo 'Telepon : <br><b>'.($row['sender_phone'] == '' ? '-' : $row['sender_phone']).'</b><br><br>';
                                echo 'Tgl. Penyerahan : <br><b>'.($row['delivery_date'] == '' ? '-' : $row['delivery_date']).'</b><br>';
                                echo 'Lokasi : <br>'.($row['location'] == '' ? '-' : $row['location']).'';
                            }
                        ?>
                    </td>
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