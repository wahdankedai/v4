<?php 

require '../../boot.php';

$id = Request::all($_REQUEST);
unset($id['_']);

/**
 * anggap saja gapapa delete meski data bidang punya children
 *
 * nanti kalo ngga boleh baru ditambahi
 */

$delete = DB::delete('kegiatan', $id);
// echo $delete; exit;
if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data kegiatan <b> " . $id["nm_kegiatan"] . " </b> berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data kegiatan <b> " . $id["nm_kegiatan"] . " </b> gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;