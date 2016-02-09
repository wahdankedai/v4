<?php 

require '../../boot.php';

$req = Request::all();

$table = $req["tipe"];
unset($req["tipe"]);
$q = DB::delete($table, $req);


if ($q) {
    $hasil = [
        "success" => true,
        "message" => "Hapus Data Berhasil!"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Hapus Data Gagal!"
    ];
}

echo json_encode($hasil);




exit;