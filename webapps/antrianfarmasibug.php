<?php
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
<!doctype html>
<html lang="en">
<head>
    <title>Antrian Farmasi</title>
    <link rel="icon" href="assets/img/rs.png" type="image/x-icon">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
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
          animation: glowing 2s infinite;
          text-align: center;
        }

        
        #warnatabel {
            box-shadow: -2px -2px 4px rgba(0, 0, 0, 0.5);
        }
        
        #warnatabel .first-row td {
            background-color: #326B17;
            color : white;
            font-weight: bold;
            font-size: 17px;
        }

        #warnatabel tr:not(.first-row) td {
            background-color: #E8E8E8;
            color: #000000;
            font-weight: bold;
            font-size: 17px;
        }
        
        .center-cell {
            text-align: center;
        }

        #left-cell {
            text-align: left;
        }
        
        .center-text {
            text-align: left;
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
        .ukuran {
            font-size: 22px;
        }
        
        /* tabel antrian farmasi */
        .tabelpanggilan td{
            border-right: 1px solid #326B17; 
            text-align: center; 
            background-color: #326B17; 
            color: #FFFAF8; 
            padding-top: 30px; 
            padding-bottom: 30px; 
            font-size: 30pt; 
            font-weight: bold; 
            font-family: Tahoma;
        }
    </style>
    <!-- Global style END -->

</head>
<body class="bg">
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
    
    <main>
        <div class="container-fluid">
        <!-- Row START -->
        <div class="row">
            <!-- Fungsi Setting Instansi -->
            <?php
            $setting = mysqli_fetch_array(bukaquery("select setting.nama_instansi,setting.alamat_instansi,setting.kabupaten,setting.propinsi,setting.kontak,setting.email,setting.logo from setting"));
            ?>
        
            <div class="col s12" id="header-instansi">
                <div class="fakecard deep-orange accent-3 white-text">
                    <div class="fakecard-content">
                        <?php
                        $setting = mysqli_fetch_array(bukaquery("select setting.nama_instansi,setting.alamat_instansi,setting.kabupaten,setting.propinsi,setting.kontak,setting.email,setting.logo from setting"));
                        echo "<table width='100%' align='center' border='0' class='tbl_form' cellspacing='0' cellpadding='0'>
                                <tr>
                                    <td width='8%' align='right' valign='center'>
                                        <img width='90' height='90' src='data:image/jpeg;base64,". base64_encode($setting['logo']). "'/>
                                    </td>
                                    <td>
                                        <center class='cell'>
                                  <font size='12' color='#FFFFFF' face='Tahoma'><p><b>ANTRIAN FARMASI</p></b></font>
                                        </center>
                                    </td>   
                                    </td>   
                        <td  width='23%' align='left' class='white-text ukuran'>
                        <p><i class='material-icons'>perm_contact_calendar</i>
                        $hari1,$tanggal1 $bulan1 $tahun1</p> 
                        <p><i class='material-icons md-12 ukuran'>query_builder</i> 
                        <a href='' class='white-text' id='jam'></a></p>
                        </td>  
                                </tr>
                            </table>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row END -->
    </div>
<table border='0' cellpadding='0' cellspacing='0' style="width: 100%; margin-top: 10px;">
    <tr style="vertical-align: top;">
        <td width='33%' style="vertical-align: top; padding: 0px 0px;">
            <div class="container-fluid" id="judul1">
            </div>
        </td>
        <td width='33%' style="vertical-align: top; padding: 0px 0px;">
            <div class="container-fluid" id="judul">
            </div>
        </td>
        <td width='33%' style="vertical-align: top; padding: 0px 0px;">
            <div class="container-fluid" id="judul2">
            </div>
        </td>
    </tr>
</table>
    <div class="container-fluid" id="data">
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

    <script type="text/javascript" src="assets/js/jquery.js"></script> 
    <script type="text/javascript"> 
        var auto_refresh = setInterval( 
            function() { 
                $('#data').load('data_antrianfarmasibug.php').fadeIn("fast"); 
            }, 9000
        );
        var auto_refresh = setInterval( 
            function() { 
                $('#judul').load('data_antrianfarmasijudulrajal.php').fadeIn("fast"); 
            }, 9000
        );
        var auto_refresh = setInterval( 
            function() { 
                $('#judul1').load('data_antrianfarmasijudulranap.php').fadeIn("fast"); 
            }, 9000
        );
        var auto_refresh = setInterval( 
            function() { 
                $('#judul2').load('data_antrianfarmasijuduligd.php').fadeIn("fast"); 
            }, 9000
        );
    </script>
</body>
</html>