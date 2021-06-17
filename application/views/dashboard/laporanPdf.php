<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Laporan Keluhan</title>
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
    background-color: #818181 ;
    color: white;
    }
    
</style>
</head>
<body>
<!-- <img src="<?= base_url();?>assets/images/logo/logo.png" style="width:200px; hight:auto;"> -->

    <h2 style="text-align: center;">LAPORAN KELUHAN</h2>
    <div style="display: flex; white-space: nowrap; font-size:15px;">
        <div style="text-align: left;">
            <small>Nama Perusahaan : Gerai Fashion</small>
        </div>
        <div style="text-align: right;">
            <small>Periode : <?= date_format($start,"d/m/Y").' - '.date_format($end,"d/m/Y"); ?></small>
        </div>
    </div>
    <div style="display: flex; white-space: nowrap; font-size:15px;">
        <div style="text-align: left;">
            <small>Pencetak : <?= $this->session->userdata('username'); ?></small>
        </div>
        <div style="text-align: right;">
            <small>Tanggal Laporan : <?= date('d/m/Y'); ?></small>
        </div>
    </div>
    <table id="customers" class="table table-bordered table-striped table-responsive">
        <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Pelapor</th>
            <th>Kronologi</th>
            <th>Tindakan</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $i=1; 
            if(isset($report)):
            foreach($report as $row): ?>
        <tr>
            <td style="text-align: center;"><?= $i++; ?></td>
            <td>
                <?php
                    $now = date_create($row->created_at);
                    echo date_format($now, 'd/m/Y H:m:s'); 
                ?>
            </td>
            <td><?= $row->category; ?></td>
            <td>
                ID Member : <br><b><?= $row->member_code; ?></b><br>
                Nama : <br><b><?= $row->informer; ?></b><br>
                E-mail : <br><b><?= $row->email; ?></b>
            </td>
            <td>
                Deskripsi : <br><b style="color:red;"><?= $row->description; ?></b><br><br>
                Produk : <br><br><b><?= ($row->product_name == NULL ? '-' : $row->product_name); ?></b>
            </td>
            <td>
                Deskripsi : <br><b style="color:blue;"><?= $row->action; ?></b><br><br>
                Tgl. Tindakan : <br><b style="color:blue;"><?= $row->action_date; ?></b>
            </td>
            <td><?= $row->status; ?></td>
        </tr>
        <?php
            endforeach; 
            endif;
        ?>
        </tbody>
    </table>
</body>
</html>