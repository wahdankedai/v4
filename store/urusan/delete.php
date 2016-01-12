<?php 

require '../../boot.php';

$kd_urusan = Request::post('id');
$nm_urusan = Request::post('nm');

/**
 * anggap saja gapapa delete meski data urusan punya children
 *
 * nanti kalo ngga boleh baru ditambahi
 */

$delete = DB::delete('urusan', [
    'kd_urusan' => $kd_urusan
]);

if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data Urusan <b> {$nm_urusan} </b> berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Urusan <b> {$nm_urusan} </b> gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;