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
    <link href="css/default.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="conf/validator.js"></script>
    <meta http-equiv="refresh" content="60"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    
    <title>Jadwal Praktek Dokter</title>
    <script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
    <script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/jquery-ui.css"  media="screen,projection"/>
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
        
        .center-cell {
            text-align: center;
        }

        #left-cell {
            text-align: left;
        }
        
        .warna{
            background-color: #326B17 ;
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
            background-color: #326B17 ;
            color : white;
            font-weight: bold;
        }

        #warnatabel tr:not(.first-row) td {
            background-color: #E8E8E8;
            color: #000000;
            font-weight: bold;
        }
        
        .center-cell {
            text-align: center;
        }

        #left-cell {
            text-align: left;
        }
    </style>
</head>
<body class="bg">

<!-- Header START -->
<!-- <header>
<nav class="deep-orange accent-3" id="warna">
    <div class="nav-wrapper" id="warna">
        <ul class="center hide-on-med-and-down" id="nv">
            <li>
                <a href="./" class="ams hide-on-med-and-down"><i class="material-icons md-36">local_hospital</i> Jadwal Praktek Dokter</a>
            </li>
            <li class="right" style="margin-right: 10px;">
                <i class="material-icons">perm_contact_calendar</i>
                <a href="" class="white-text">
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

                      //dan untuk menampilkan nya dengan format contoh Jumat, 22 Februari 2013
                      echo $hari1 . ", " . $tanggal1 ." ". $bulan1 ." ". $tahun1;

                    ?>
                </a>
                <i class="material-icons md-12">query_builder</i>  
                <a href="" class="white-text" id="jam"></a>
          </li>
        </ul>
    </div>
</nav>

</header> -->
<!-- Header END -->

<main>
<div class="container-fluid">
	    <!-- Row START -->
        <div class="row">
            <!-- Fungsi Setting Instansi -->
            <?php $setting=  mysqli_fetch_array(bukaquery("select setting.nama_instansi,setting.alamat_instansi,setting.kabupaten,setting.propinsi,setting.kontak,setting.email,setting.logo from setting"));
            ?>
            <div class="col s12" id="header-instansi">
                <div class="card deep-orange accent-3 white-text">
                    <div class="card-content">
                        <div class="left">
                            <img class="logo" src="data:image/jpeg;base64,<?php echo base64_encode($setting['logo'])?>"/>
                        </div>
                        <h5 class="ins">JADWAL DOKTER <?php echo $setting["nama_instansi"] ?></h5>
                        <p class="almt"><?php echo $setting["alamat_instansi"] ?>, <?php echo $setting["kabupaten"] ?>, <?php echo $setting["propinsi"] ?><p>No. Telpon : <?php echo $setting["kontak"] ?>  E-mail : <?php echo $setting["email"] ?> </p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row END -->
</div>

<div class="container-fluid">
    <div class="col s12 row">
        <div class="col s12">
	<table width='100%' class="default" id="warnatabel">
	     <tr class='first-row'>
              <td width='35%'><div align='center'><font size='5'><b>NAMA DOKTER</b></font></div></td>
              <td width='25%'><div align='center'><font size='5'><b>POLIKLINIK</b></font></div></td>
              <td width='15%'><div align='center'><font size='5'><b>JAM MULAI</b></font></div></td>
              <td width='15%'><div align='center'><font size='5'><b>JAM SELESAI</b></font></div></td>
              <td width='10%'><div align='center'><font size='5'><b>REGISTER</b></font></div></td>
         </tr>

	<?php  
	    $hari=getOne("select DAYNAME(current_date())");
	    $namahari="";
	    if($hari=="Sunday"){
			$namahari="AKHAD";
		}else if($hari=="Monday"){
			$namahari="SENIN";
		}else if($hari=="Tuesday"){
			$namahari="SELASA";
		}else if($hari=="Wednesday"){
			$namahari="RABU";
		}else if($hari=="Thursday"){
			$namahari="KAMIS";
		}else if($hari=="Friday"){
			$namahari="JUMAT";
		}else if($hari=="Saturday"){
			$namahari="SABTU";
		}
		$_sql="Select dokter.nm_dokter,poliklinik.nm_poli,jadwal.jam_mulai,jadwal.jam_selesai,poliklinik.kd_poli, 
		       dokter.kd_dokter from jadwal inner join dokter inner join poliklinik on dokter.kd_dokter=jadwal.kd_dokter 
		       and jadwal.kd_poli=poliklinik.kd_poli where jadwal.hari_kerja='$namahari'" ;  
		$hasil=bukaquery($_sql);

		while ($data = mysqli_fetch_array ($hasil)){
			echo "<tr class='isi7'>
                                <td class='left-cell'><a href='antrian.php?iyem=".encrypt_decrypt("{\"kd_poli\":\"".$data['kd_poli']."\",\"kd_dokter\":\"".$data['kd_dokter']."\"}","e")."'>".$data['nm_dokter']."</a></td>
                                <td class='center-cell'>".$data['nm_poli']."</td>
                                <td class='center-cell'>".$data['jam_mulai']."</td>
                                <td class='center-cell'>".$data['jam_selesai']."</td>
                                <td class='center-cell'>". getOne("select count(*) from reg_periksa where kd_poli='".$data['kd_poli']."' and kd_dokter='".$data['kd_dokter']."' and tgl_registrasi='".date("Y-m-d", $tanggal)."'")."</td>
			    </tr> ";
		}
	?>
	</table>
	</div>
	</div>
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
