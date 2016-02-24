<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

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