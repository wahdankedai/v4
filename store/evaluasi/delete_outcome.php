<?php 

require '../../boot.php';

$id = Request::post('id');

/**
 * anggap saja gapapa delete meski data punya children
 *
 * nanti kalo ngga boleh baru ditambahi
 */


if (Suggest::checkTargetOutcome($id)) {
    echo json_encode([
        "success" => false,
        "message" => "Data tidak bisa dihapus"
    ]);
    exit;
 };


$delete = DB::delete('indikator_outcome_program', [
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