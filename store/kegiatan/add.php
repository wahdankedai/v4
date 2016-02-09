<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);
$dt = DB::insert('kegiatan', $req);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data Kegiatan " . $req["nm_kegiatan"] . " berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Kegiatan " . $req["nm_kegiatan"] . " gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;