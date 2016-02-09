<?php 

require '../../boot.php';

$req =  Common::trickRequest(Request::all());


$tipe = $req["tipe"];
unset($req["tipe"]);

$res = DB::addOrNewRekening($tipe, $req);


if ($res) {
    $hasil = [
        "success" => true,
        "message" => "Penyimpanan Data Berhasil!"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Penyimpanan Data Gagal!"
    ];
}

echo json_encode($hasil);
exit;