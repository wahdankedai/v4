<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

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