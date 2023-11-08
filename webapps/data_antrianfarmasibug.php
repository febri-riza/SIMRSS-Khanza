<?php
require_once('conf/conf.php');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
date_default_timezone_set("Asia/Bangkok");
$tanggal = date("Y-m-d"); // Mengambil tanggal hari ini
$jam = date("H:i");
?>

<div class="col s12 row">
    <div class="col s12">
        <table class="default warnatabel" id="warnatabel">
            <thead>
                <tr class='first-row'>
                    <?php  
                    // Ambil semua kolom dalam tabel "resep_obat"
                    $result = bukaquery("DESCRIBE aplicare_ketersediaan_kamar");
                    $columns = array();

                    while ($row = mysqli_fetch_assoc($result)) {
                        $columns[] = $row['Field'];
                        echo "<td class='center-cell'><b>" . $row['Field'] . "</b></td>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php  
                // Mengubah kueri SQL Anda untuk mengurutkan data secara descending berdasarkan nomor resep
                $_sql = "SELECT * FROM aplicare_ketersediaan_kamar";
                          // WHERE tgl_perawatan = '" . $tanggal . "'
                          // ORDER BY no_resep DESC
                          // LIMIT 250"; // Menampilkan hanya 100 hasil dari hari ini
                    
                $hasil = bukaquery($_sql);
                    
                while ($data = mysqli_fetch_array($hasil)) {
                    echo "<tr class='isi7'>";
                    foreach ($columns as $column) {
                        echo "<td>" . $data[$column] . "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
