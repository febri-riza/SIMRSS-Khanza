<?php
 session_start();
 require_once('conf/conf.php');
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
 header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT"); 
 header("Cache-Control: no-store, no-cache, must-revalidate"); 
 header("Cache-Control: post-check=0, pre-check=0", false);
 header("Pragma: no-cache"); // HTTP/1.0
 $tanggal= mktime(date("m"),date("d"),date("Y"));
 date_default_timezone_set('Asia/Jakarta');
 $jam=date("H:i");
?>
<head>
    <link rel="icon" href="assets/img/rs.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="conf/validator.js"></script>
    <meta http-equiv="refresh" content="60"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    
    <title>Jadwal Praktek Dokter</title>
    <script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
    <script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/jquery-ui.css"  media="screen,projection"/>
    <link href="css/default.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/marquee.css" />
    <link rel="stylesheet" href="assets/css/example.css" />
    <link rel="stylesheet" href="assets/css/ok.css" />
    <style type="text/css">
        .bg::before {
            content: '';
            background-color: #ffffff;
            background-image: url('./assets/img/operasi.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: scroll;
            position: fixed;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.10;
            filter:alpha(opacity=10);
        }
        
        .cell {
            vertical-align: top;
        }

        #left-cell {
            text-align: left;
        }
        
        .warna{
            background-color: #326B17;
        }
        
        /* CSS id="data" 
        @keyframes glowing {
          0% {
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
          }
          50% {
            box-shadow: 0 0 20px 10px rgba(0, 0, 0, 0.7);
          }
          100% {
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
          }
        } */
        
        #warnatabel {
            animation: glowing 2s infinite;
        }

        
        #warnatabel {
            box-shadow: -2px -2px 4px rgba(0, 0, 0, 0.5);
        }
        
        #warnatabel .first-row td {
            background-color: #326B17;
            color : white;
            font-weight: bold;
        }

        #warnatabel tr:not(.first-row) td {
            background-color: #E8E8E8;
            color: #000000;
            font-weight: bold;
        }
        
        #center-cell {
            text-align: center;
        }

        #left-cell {
            text-align: left;
        }
        
        .white-text {
            font: 25px tahoma;
        }
        .fakecard {
          position: relative;
          overflow: hidden;
          margin: .5rem 0 .5rem;
          background-color: #fff;
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
          -webkit-border-radius: 2px;
          -moz-border-radius: 2px;
          border-radius: 2px;
          background-clip: padding-box;
        }
        .fakecard-content p {
          margin: 0;
          color: inherit;
        }
    </style>
</head>
<body class="bg">
<!-- Header START -->
<header>
        <?php
        //menentukan hari
        $a_hari1 = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
        $hari1 = $a_hari1[date("N")];

        //menentukan tanggal
        $tanggal1 = date ("j");

        //menentukan bulan
        $a_bulan1 = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
        $bulan1 = $a_bulan1[date("n")];

        //menentukan tahun
        $tahun1 = date("Y"); 
        ?>
</header>
<!-- Header END -->
<main>
<div class="container-fluid">
        <!-- Row START -->
        <div class="row">
            <!-- Fungsi Setting Instansi -->
            <?php $setting=  mysqli_fetch_array(bukaquery("select setting.nama_instansi,setting.alamat_instansi,setting.kabupaten,setting.propinsi,setting.kontak,setting.email,setting.logo from setting"));
            ?>
            
            <div class="col s12" id="header-instansi">
                <div class="fakecard deep-orange accent-3 white-text">
                    <div class="fakecard-content">
                        <?php
        $token      = trim(isset($_GET['iyem']))?trim($_GET['iyem']):NULL;
        $token      = json_decode(encrypt_decrypt($token,"d"),true);
        $kd_poli    = "";
        $kd_dokter  = "";
        if (isset($token["kd_poli"])) {
            $kd_poli    = $token["kd_poli"];
            $kd_dokter  = $token["kd_dokter"];
        }else{
            exit(header("Location: https://www.google.com"));
        }
        
        $kd_poli    = validTeks4($kd_poli,20);
        $kd_dokter  = validTeks4($kd_dokter,20);
            
        $setting    = mysqli_fetch_array(bukaquery("select setting.nama_instansi,setting.alamat_instansi,setting.kabupaten,setting.propinsi,setting.kontak,setting.email,setting.logo from setting"));
        echo "   
           <table width='100%' align='center' border='0' class='tbl_form' cellspacing='0' cellpadding='0'>
                  <tr>
                        <td  width='10%' align='right' valign='center'>
                                <img width='90' height='90' src='data:image/jpeg;base64,". base64_encode($setting['logo']). "'/>
                        </td>
                        <td>
                           <center class='cell'>
                                  <font size='6' color='#FFFFFF' face='Tahoma'><p><b>ANTRIAN ".getOne("select nm_poli from poliklinik where kd_poli='".$kd_poli."'")."</p><p>".getOne("select nm_dokter from dokter where kd_dokter='".$kd_dokter."'")."</p></b></font>
                                  
                           </center>
                        </td>   
                        <td  width='20%' align='left' class='white-text'>
                        <p>$hari1,$tanggal1 $bulan1 $tahun1 <a href='' class='white-text' id='jam'></a></p> 
                        </td>  
                 </tr>
          </table> "; 
    ?>
                    </div>
                </div>
            </div>
        </div>
        
        
<table border='0' cellpadding='0' cellspacing='0' style="width: 100%; margin-top: 10px;">
    <tr style="vertical-align: top;">
      <td width="60%" style="vertical-align: top;">
        <table width='100%' id="warnatabel">
        <tr class='first-row isi7'>
          <td style="width: 2%; text-align: center; vertical-align: middle; padding-top: 10px; padding-bottom: 11px; font-weight: bold; font-size: 20pt; font-family: Tahoma;"><b>NO</b></font></div></td>
          <td style="width: 4%; text-align: center; vertical-align: middle; padding-top: 10px; padding-bottom: 11px; font-weight: bold; font-size: 20pt; font-family: Tahoma;"><b>NO.RAWAT</b></font></div></td>
          <td style="width: 10%; text-align: center; vertical-align: middle; padding-top: 10px; padding-bottom: 11px; font-weight: bold; font-size: 20pt; font-family: Tahoma;"><div align='center'><font size='5'><b>NAMA PASIEN</b></font></div></td>
        </tr>
        <?php  
                $_sql="select reg_periksa.no_reg,reg_periksa.no_rawat,pasien.nm_pasien 
                       from reg_periksa inner join pasien on reg_periksa.no_rkm_medis=pasien.no_rkm_medis
                       where reg_periksa.kd_poli='".$kd_poli."' and reg_periksa.kd_dokter='".$kd_dokter."' 
                       and reg_periksa.tgl_registrasi='".date("Y-m-d", $tanggal)."' and stts='Belum' order by reg_periksa.no_reg" ;  
                $hasil=bukaquery($_sql);

                while ($data = mysqli_fetch_array ($hasil)){
                        echo "<tr class='isi7' id='center-cell' >
                                <td><font size='5' color='black' face='Tahoma'>".$data['no_reg']."</font></td>
                                <td><font color='black' size='5'  face='Tahoma'>".$data['no_rawat']."</font></td>
                                <td><font color='black' size='5'  face='Tahoma'>".$data['nm_pasien']."</font></td>
                            </tr> ";
                }
        ?>
    </table>
    </td>
    <td width="40%" style="vertical-align: top;">
    <table border='0' style="width: 100%"  cellpadding='0' cellspacing='0' id="warnatabel">
            <tr class="head2" border="0">
                <td style="text-align: center; background-color: #326B17; color: #FFFAF8; font-size: 30pt; font-weight: bold; font-family: Tahoma;">PANGGILAN POLI</td>
            </tr>
            <?php 
                $_sql="select * from antripoli where antripoli.kd_poli='".$kd_poli."' and antripoli.kd_dokter='".$kd_dokter."'" ;  
                $hasil=bukaquery($_sql);
                while ($data = mysqli_fetch_array ($hasil)){
                    echo '<tr class="head2" border="0"><td style="text-align: center; color: #DD0000; padding-top: 20px; padding-bottom: 20px; font-size: 197pt; font-weight: bold; font-family: Tahoma;">'.getOne("select concat(reg_periksa.no_reg) from reg_periksa inner join pasien on reg_periksa.no_rkm_medis=pasien.no_rkm_medis where reg_periksa.no_rawat='".$data['no_rawat']."'")."</td></tr>"; 
                    echo '<tr class="head2" border="0"><td style="text-align: center; background-color: #DD0000; color: #FFFAF8; padding-top: 10px; padding-bottom: 10px; font-size: 20pt; font-weight: bold; font-family: Tahoma;">'.getOne("select concat(pasien.nm_pasien) from reg_periksa inner join pasien on reg_periksa.no_rkm_medis=pasien.no_rkm_medis where reg_periksa.no_rawat='".$data['no_rawat']."'")."</td></tr>";
                    if($data['status']=="1"){
                        echo "<audio autoplay='true' src='bell1.wav'>";
                        bukaquery2("update antripoli set antripoli.status='0' where antripoli.kd_poli='".$kd_poli."' and antripoli.kd_dokter='".$kd_dokter."'");
                    }   
                }
            ?>
    </table>
    </td>
    </tr>
</table>

</div>
</main>
<!-- Javascript START -->
<script type="text/javascript" src="assets/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="assets/js/materialize.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script data-pace-options='{ "ajax": false }' src='assets/js/pace.min.js'></script>
<script type="text/javascript" src="assets/js/marquee.js"></script>
<script type="text/javascript">
   window.onload = function() { jam(); }

   function jam() {
    var e = document.getElementById('jam'),
    d = new Date(), h, m, s;
    h = d.getHours();
    m = set(d.getMinutes());
    s = set(d.getSeconds());

    e.innerHTML = h +':'+ m +':'+ s;

    setTimeout('jam()', 1000);
   }

   function set(e) {
    e = e < 10 ? '0'+ e : e;
    return e;
  }
</script>

<script type="text/javascript" src="assets/js/jquery.js"></script> 
</body>
<?php 
  echo "<meta http-equiv='refresh' content='10;URL=?iyem=".encrypt_decrypt("{\"kd_poli\":\"".$kd_poli."\",\"kd_dokter\":\"".$kd_dokter."\"}","e")."'>";
?> 