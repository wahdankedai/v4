<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);
$dt = DB::insert('unit_tupoksi', $req);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Bidang gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;