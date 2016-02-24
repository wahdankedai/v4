<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$nm_satuan = Request::post('nm');

/**
 * anggap saja gapapa delete meski data satuan punya children
 *
 * nanti kalo ngga boleh baru ditambahi
 */

$delete = DB::delete('satuan', [
    'nm_satuan' => $nm_satuan
]);

if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data satuan <b> {$nm_satuan} </b> berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data satuan <b> {$nm_satuan} </b> gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;