<?php
require_once('conf/conf.php');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
date_default_timezone_set("Asia/Bangkok");
$tanggal = mktime(date("m"), date("d"), date("Y"));
$jam = date("H:i");
?>
<div class="col s12 row">
    <div class="col s12">
        <table border='0' style="width: 100%" cellpadding='0' cellspacing='0' id="warnatabel">
            <tr class="head2" border="0">
                <td style="text-align: center; background-color: #326B17; color: #FFFAF8; font-size: 25pt; font-weight: bold; font-family: Tahoma;">RESEP RAWAT INAP</td>
            </tr>
            <?php
            $_sql = "SELECT * FROM antriapotek3 
                     INNER JOIN resep_obat ON antriapotek3.no_resep = resep_obat.no_resep
                     WHERE resep_obat.status = 'ranap'";
            $hasil = bukaquery($_sql);
            while ($data = mysqli_fetch_array($hasil)) {
                echo '<tr class="head2" border="0"><td style="text-align: center; color: #DD0000; padding-top: 5px; padding-bottom: 5px; font-size: 90pt; font-weight: bold; font-family: Tahoma;">' . substr($data['no_resep'], -4) . "</td></tr>";
                echo '<tr class="head2" border="0"><td style="text-align: center; background-color: #DD0000; color: #FFFAF8; padding-top: 5px; padding-bottom: 5px; font-size: 20pt; font-weight: bold; font-family: Tahoma;">' . getOne("SELECT CONCAT(pasien.nm_pasien) FROM reg_periksa INNER JOIN pasien ON reg_periksa.no_rkm_medis = pasien.no_rkm_medis WHERE reg_periksa.no_rawat = '" . $data['no_rawat'] . "'") . "</td></tr>";
                if ($data['status'] == "1") {
                    echo "<audio autoplay='true' src='bell2.wav'>";
                    bukaquery2("UPDATE antriapotek3 SET antriapotek3.status = '0'");
                }
            }
            ?>
        </table>
    </div>
</div>
