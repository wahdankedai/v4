<?php 

require '../../boot.php';

$id = Request::all($_REQUEST);
unset($id['_']);
$kd = $id;
unset($kd["nm_bidang"]);
/**
 * anggap saja gapapa delete meski data bidang punya children
 *
 * nanti kalo ngga boleh baru ditambahi
 */

$delete = DB::delete('unit_tupoksi', $kd);
// echo $delete; exit;
if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data Bidang Urusan <b> " . $id["nm_bidang"] . " </b> berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Bidang Urusan <b> " . $id["nm_bidang"] . " </b> gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;