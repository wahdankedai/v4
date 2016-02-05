<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);
$dt = DB::insert('bidang', $req);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data Bidang " . $req["nm_bidang"] . " berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Bidang " . $req["nm_bidang"] . " gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;