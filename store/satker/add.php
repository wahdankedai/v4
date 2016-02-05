<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);
$dt = DB::insert('satker', $req);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data satker " . $req["nm_satker"] . " berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data satker " . $req["nm_satker"] . " gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;