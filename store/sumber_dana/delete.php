<?php 

require '../../boot.php';

$nm_sumber_dana = Request::post('nm');

/**
 * anggap saja gapapa delete meski data sumber_dana punya children
 *
 * nanti kalo ngga boleh baru ditambahi
 */

$delete = DB::delete('sumber_dana', [
    'nm_sumber_dana' => $nm_sumber_dana
]);

if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data sumber_dana <b> {$nm_sumber_dana} </b> berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data sumber_dana <b> {$nm_sumber_dana} </b> gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;