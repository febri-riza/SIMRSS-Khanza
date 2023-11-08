<?php
 //fitur update kamar aplicare ini adalah penyempurnaan dari kontribusi Mas Tirta dari RSUK Ciracas Jakarta Timur
 session_start();
 require_once('conf/conf.php');
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
 header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT"); 
 header("Cache-Control: no-store, no-cache, must-revalidate"); 
 header("Cache-Control: post-check=0, pre-check=0", false);
 header("Pragma: no-cache"); // HTTP/1.0
 date_default_timezone_set("Asia/Bangkok");
 $tanggal= mktime(date("m"),date("d"),date("Y"));
 $jam=date("H:i");
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="assets/img/rs.png" type="image/x-icon">
    <link href="css/default.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="conf/validator.js"></script>
    <meta http-equiv="refresh" content="300"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>Informasi Ketersediaan Kamar</title>
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
        
        .warnatabel{
            text-align: center;
        }
        #warnatabel {
          /*animation: glowing 2s infinite;*/
          text-align: center;
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
            
        .center-cell {
            text-align: center;
        }

        #left-cell {
            text-align: left;
        }
        .bisa {
          padding: 0 .75rem;
        }
        .ukuran {
            font-size: 19px;
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
            <div class="col s12" id="header-instansi">
                <div class="fakecard deep-orange accent-3 white-text">
                    <div class="fakecard-content">
                        <?php
        $setting    = mysqli_fetch_array(bukaquery("select setting.logo from setting"));
        echo "   
           <table width='100%' align='center' border='0' class='tbl_form' cellspacing='0' cellpadding='0'>
                  <tr>
                        <td  width='10%' align='right' valign='center'>
                                <img width='90' height='90' src='data:image/jpeg;base64,". base64_encode($setting['logo']). "'/>
                        </td>
                        <td>
                           <center class='cell'>
                                  <font size='6' color='#FFFFFF' face='Tahoma'><p><b>KETERSEDIAAN KAMAR & JADWAL PRAKTEK DOKTER</p></b></font>
                                  
                                  
                           </center>
                        </td>   
                        <td  width='23%' align='left' class='white-text ukuran'>
                        <p><i class='material-icons'>perm_contact_calendar</i>
                        $hari1,$tanggal1 $bulan1 $tahun1</p> 
                        <p><i class='material-icons md-12 ukuran'>query_builder</i> 
                        <a href='' class='white-text' id='jam'></a></p>
                        </td>  
                 </tr>
          </table> "; 
    ?>
                    </div>
                </div>
            </div>
        </div>
            <!-- Row END -->
    </div>

<div class="container-fluid">
    <div class="col s12 row">
        <div class="col s3">
	        <table width='100%' class="default" id="warnatabel">
        	     <tr class='first-row'>
                      <td width='50%'><div class='center-cell'><b>NAMA KAMAR</b></div></td>
                      <td width='30%'><div class='center-cell'><b>KAPASITAS</b></div></td>
                      <td width='20%'><div class='center-cell'><b>BED KOSONG</b></div></td>
                 </tr> 

                    <?php
                    $_sql = "SELECT
                                bangsal.nm_bangsal,
                                aplicare_ketersediaan_kamar.tersedia,
                                aplicare_ketersediaan_kamar.kapasitas
                            FROM aplicare_ketersediaan_kamar
                            JOIN bangsal ON aplicare_ketersediaan_kamar.kd_bangsal = bangsal.kd_bangsal
                            WHERE aplicare_ketersediaan_kamar.kd_bangsal <> 'BP001'
                            ORDER BY nm_bangsal ASC";
                    
                    $hasil = bukaquery($_sql);
                    
                    while ($data = mysqli_fetch_array($hasil)) {
                        echo "<tr class='isi7fake'>
                                <td class='center-cell'>" . $data['nm_bangsal'] . "</td>
                                <td class='center-cell'>
                                      <b>" . $data['kapasitas'] . "</b>
                                </td>
                                <td class='center-cell'>
                                      <b>" . $data['tersedia'] . "</b>
                                </td>
                            </tr> ";
                    }
                    ?>
            </table>
	        </div>
    	    <div class="col s9">
    	        <table width='100%' class="default" id="warnatabel">
            	     <tr class='first-row'>
                          <td width='42%'><div align='center'><b>NAMA DOKTER</b></div></td>
                          <td width='33%'><div align='center'><b>POLIKLINIK</b></div></td>
                          <td width='12.5%'><div align='center'><b>JAM MULAI</b></div></td>
                          <td width='12.5%'><div align='center'><b>JAM SELESAI</b></div></td>
                          <td width='5%'><div align='center'><b>REGISTER</b></div></td>
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
            		       and jadwal.kd_poli=poliklinik.kd_poli where jadwal.hari_kerja='$namahari' ORDER BY nm_poli ASC" ;  
            		$hasil=bukaquery($_sql);
            
            		while ($data = mysqli_fetch_array ($hasil)){
            			echo "<tr class='isi7fake'>
                                            <td id='left-cell'>".$data['nm_dokter']."</a></td>
                                            <td id='left-cell'>".$data['nm_poli']."</td>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script> 
</body>
