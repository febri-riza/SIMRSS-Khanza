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
                    <td class='center-cell'><b>No.Resep</b></td>
                    <td class='center-cell'><b>No.Rawat</b></td>
                    <td class='center-cell'><b>Nama Pasien</b></td>
                    <td class='center-cell'><b>Jenis Resep</b></td>
                    <td class='center-cell'><b>Status</b></td>
                    <td class='center-cell'><b>Dokter Peresep</b></td>
                    <td class='center-cell'><b>Peresepan</b></td>
                    <td class='center-cell'><b>Proses</b></td>
                    <td class='center-cell'><b>Penyerahan</b></td>
               </tr>
            </thead>
            <tbody>
            <?php  
              $_sql="select resep_obat.no_resep,resep_obat.no_rawat,pasien.nm_pasien,resep_obat.status,resep_obat.jam_peresepan,
                    if(resep_obat.jam='00:00:00','',resep_obat.jam) as jam_validasi,
                    if(resep_obat.jam_penyerahan='00:00:00','',resep_obat.jam_penyerahan) as jam_penyerahan,dokter.nm_dokter
                    from resep_obat inner join reg_periksa on resep_obat.no_rawat=reg_periksa.no_rawat 
                    inner join pasien on reg_periksa.no_rkm_medis=pasien.no_rkm_medis 
                    inner join dokter on resep_obat.kd_dokter=dokter.kd_dokter
                    where resep_obat.tgl_perawatan='".date("Y-m-d", $tanggal)."'
                    and resep_obat.kd_kamar <> 'KP001'  -- Exclude 'KP001'
                    and pasien.nm_pasien <> 'PASIEN OBAT KRONIS' -- Exclude 'PASIEN OBAT KRONIS'
                    and resep_obat.status <> 'ranap' -- Exclude 'ranap'
                    and resep_obat.jam <>'00:00:00' order by resep_obat.no_resep desc 
                    LIMIT 30";
              $hasil=bukaquery($_sql);

              while ($data = mysqli_fetch_array ($hasil)){
                echo "<tr class='isi7' >
                          <td>".substr($data['no_resep'], -4)."</td>
                          <td>".$data['no_rawat']."</td>
                          <td>".$data['nm_pasien']."</td>
                          <td>".(getOne("select count(resep_dokter_racikan.no_resep) from resep_dokter_racikan where resep_dokter_racikan.no_resep='".$data['no_resep']."'")>0?"Racikan":"Non Racikan")."</td>
                          <td>".$data['status']."</td>
                          <td>".$data['nm_dokter']."</td>
                          <td>".$data['jam_peresepan']."</td>
                          <td>".$data['jam_validasi']."</td>
                          <td>".$data['jam_penyerahan']."</td>
                      </tr> ";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>