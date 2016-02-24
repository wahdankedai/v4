<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req =  Common::trickRequest(Request::all());


$tipe = $req["tipe"];
unset($req["tipe"]);


$res = DB::addOrNewRekening($tipe, $req);

// echo $res;exit;
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