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

$delete = DB::delete('program', $id);
// echo $delete; exit;
if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data program <b> " . $id["nm_program"] . " </b> berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data program <b> " . $id["nm_program"] . " </b> gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;