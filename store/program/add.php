<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);
$dt = DB::insert('program', $req);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data Program " . $req["nm_program"] . " berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Program " . $req["nm_program"] . " gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;