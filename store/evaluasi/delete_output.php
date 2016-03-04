<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$id = Request::post('id');

/**
 * anggap saja gapapa delete meski data punya children
 *
 * nanti kalo ngga boleh baru ditambahi
 */


if (Suggest::checkTargetOutput($id)) {
    echo json_encode([
        "success" => false,
        "message" => "Data tidak bisa dihapus"
    ]);
    exit;
 };


$delete = DB::delete('indikator_output_kegiatan', [
    'id' => $id
]);

if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;