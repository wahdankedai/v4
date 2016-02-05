<?php 

require '../../boot.php';

$kd_keselarasan = Request::post('id');
$nm_keselarasan = Request::post('nm');

/**
 * anggap saja gapapa delete meski data keselarasan punya children
 *
 * nanti kalo ngga boleh baru ditambahi
 */

$delete = DB::delete('keselarasan', [
    'kd_keselarasan' => $kd_keselarasan
]);

if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data keselarasan <b> {$nm_keselarasan} </b> berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data keselarasan <b> {$nm_keselarasan} </b> gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;