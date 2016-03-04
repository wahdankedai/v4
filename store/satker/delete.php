<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$id = Request::all($_REQUEST);
unset($id['_']);

/**
 * anggap saja gapapa delete meski data bidang punya children
 *
 * nanti kalo ngga boleh baru ditambahi
 */

$delete = DB::delete('satker', $id);
// echo $delete; exit;
if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data satker <b> " . $id["nm_satker"] . " </b> berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data satker <b> " . $id["nm_satker"] . " </b> gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;