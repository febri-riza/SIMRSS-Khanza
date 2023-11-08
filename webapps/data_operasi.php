 <?php
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
 <div class="col s12 row">
    <div class="col s12">
        <table class="default warnatabel" id="warnatabel">
            <thead>
               <tr class='first-row'>
                    <td class='center-cell'><b>No.Rawat</b></td>
                    <td class='center-cell'><b>Umur</b></td>
                    <td class='center-cell'><b>J.K.</b></td>
                    <td class='center-cell'><b>Mulai</b></td>
                    <td class='center-cell'><b>Selesai</b></td>
                    <td class='center-cell'><b>Status</b></td>
                    <td class='center-cell'><b>Operasi</b></td>
                    <td class='center-cell'><b>Operator</b></td>
                    <td class='center-cell'><b>Ruang Operasi</b></td>
               </tr>
            </thead>
            <tbody>
            <?php  
              $_sql="select booking_operasi.no_rawat,reg_periksa.no_rkm_medis,pasien.nm_pasien,booking_operasi.tanggal, booking_operasi.jam_mulai,booking_operasi.jam_selesai,
                      booking_operasi.status,booking_operasi.kd_dokter, dokter.nm_dokter,booking_operasi.kode_paket,paket_operasi.nm_perawatan,concat(reg_periksa.umurdaftar,' ',reg_periksa.sttsumur) as umur,
                      pasien.jk,ruang_ok.nm_ruang_ok from booking_operasi inner join reg_periksa on booking_operasi.no_rawat=reg_periksa.no_rawat
                      inner join pasien on reg_periksa.no_rkm_medis=pasien.no_rkm_medis
                      inner join paket_operasi on booking_operasi.kode_paket=paket_operasi.kode_paket
                      inner join dokter on booking_operasi.kd_dokter=dokter.kd_dokter  
                      inner join ruang_ok on booking_operasi.kd_ruang_ok=ruang_ok.kd_ruang_ok
                      where tanggal='".date("Y-m-d", $tanggal)."' order by booking_operasi.tanggal,booking_operasi.jam_mulai" ;  
              $hasil=bukaquery($_sql);

              while ($data = mysqli_fetch_array ($hasil)){
                echo "<tr class='isi7' >
                          <td class='center-cell'>".$data['no_rawat']."</td>
                          <td class='center-cell'>".$data['umur']."</td>
                          <td class='center-cell'>".$data['jk']."</td>
                          <td class='center-cell'>".$data['jam_mulai']."</td>
                          <td class='center-cell'>".$data['jam_selesai']."</td>
                          <td class='center-cell'>".$data['status']."</td>
                          <td class='center-cell'>".$data['nm_perawatan']."</td>
                          <td class='center-cell'>".$data['nm_dokter']."</td>
                          <td class='center-cell'>".$data['nm_ruang_ok']."</td>
                      </tr> ";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>