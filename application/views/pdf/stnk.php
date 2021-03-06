<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <title>Pdf</title>

    <style>
      h2, h3, span, td, p{
        font-family: 'Poppins', sans-serif;
      }
    </style>
  </head>
  <body>
    <!-- header -->
    <!-- <img src="<?= base_url('assets/'); ?>img/pdf_logo.jpg" width="30" height="30" class="d-inline-block align-top" alt=""> -->
    <h2>Pratama Jaya Putra</h2>
    <p style="margin-top: -15px;margin-bottom: -15px"><?= $type ?> - <?= $service ?></p>
    <p style="margin-bottom: -15px"><?php 
        if($fullname != '' && $phone != '') echo $fullname.' ('.$phone.')';
        elseif ($fullname != '' && $phone == '') echo $fullname;
        elseif ($fullname == '' && $phone != '') echo $phone;
    ?></p>
    <p style="margin-bottom: -15px"><?= $category.' - '.strtoupper($nopol) ?></p>
    <p style="margin-bottom: -15px">Jatuh Tempo Pajak : <?= $jatuh_tempo ?></p>
    <p>Jatuh Tempo STNK : <?= $jatuh_tempo_stnk ?></p>
    <hr/>
    <!-- content -->
    <br/>
    <span>Rincian Biaya :</span>
    <table border="0">
      <tr>
        <td style="padding-right: 400px"></td>
        <td style="text-align:right"></td>
      </tr>
      <?php 
        foreach ($pajak_ar as $pj) {
           echo '<tr>
              <td>Pajak '.$pj.'</td>
              <td style="text-align:right">Rp '.number_format($last_pajak_, 2, ',', '.').'</td>
            </tr>';
          }
      ?>  
      <?php 
        if(stristr($service, '5') === false){
          
        }
        else
        {
          echo ' <tr>
            <td>Legalisir Cek Fisik</td>
            <td style="text-align:right">Rp 150.000,00</td>
          </tr>';
        }
      ?>
      <tr>
        <td>ACC BPKB Leasing</td>
        <td style="text-align:right">Rp <?= number_format($acc_bpkb_leasing, 2, ',', '.') ?></td>
      </tr>
      
      <?php 
        if($b_adm_skp > 0){
          echo ' <tr>
            <td>Admin SKP/Tunggakan</td>
            <td style="text-align:right">Rp '.number_format($b_adm_skp, 2, ',', '.').'</td>
          </tr>';
        }
      ?>
      <?php 
        if($d_jatuh_tempo > 0){
          echo '<tr>
            <td>Denda Jatuh Tempo</td>
            <td style="text-align:right">Rp '.number_format($d_jatuh_tempo, 2, ',', '.').'</td>
          </tr>';
        }
      ?>
      <?php 
        if($d_jr > 0){
          echo '<tr>
            <td>Denda Jasa Raharja</td>
            <td style="text-align:right">Rp '.number_format($d_jr, 2, ',', '.').'</td>
          </tr>';
        }
      ?>
      <tr>
        <td>Jasa Raharja</td>
        <td style="text-align:right">Rp <?= number_format($jr, 2, ',', '.') ?></td>
      </tr>
      <?php 
        if($adm_stnk > 0){
          echo '<tr>
            <td>Administrasi STNK</td>
            <td style="text-align:right">Rp '.number_format($adm_stnk, 2, ',', '.').'</td>
          </tr>';
        }
      ?>
      <?php 
        if($tnkb > 0){
          echo '<tr>
            <td>TNKB</td>
            <td style="text-align:right">Rp '.number_format($tnkb, 2, ',', '.').'</td>
          </tr>';
        }
      ?>
      <tr>
        <?php 
          if(stristr($service, '5') === false)
          {
            echo '<td>Biaya Jasa</td><td style="text-align:right">Rp '.number_format($total, 2, ',', '.').'</td>';
          }
          else
          {
            $total = $total - 150000;
            echo '<td>Biaya Jasa</td><td style="text-align:right">Rp '.number_format($total, 2, ',', '.').'</td>';
          }
        ?>
      </tr>
      <tr>
        <td><hr/></td>
        <td><hr/></td>
      </tr>
      <tr>
        <td><h3>Total</h3></td>
        <td style="text-align:right"><h3>Rp <?= number_format($total_all, 2, ',', '.') ?></h3></td>
      </tr>
    </table>

    <br/>
    <br/>
    <p style="font-size:8px">*Biaya terlampir diatas hanya sebagai estimasi sementara. Jika ada biaya tambahan, akan dikonfirmasi sebelumnya.</p>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <hr/>
    <div style="text-align:center">
      <span style="font-size:9px;">Pratama Jaya Putra | </span>
      <span style="font-size:9px;text-align:center">Jl. H. Alwi Rt. 04/ 01 No. 26, Kel. Tanjung Barat, Jakarta Selatan, Indonesia | </span>
      <span style="font-size:9px;text-align:center">Telp. 0813 8174 1192</span>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>