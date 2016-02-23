<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 


$req =  Common::obj(Request::all());


if (isset($req->id)) {
    $q = "UPDATE sasaran_skpd set sasaran = '$req->sasaran' WHERE id=$req->id";
} else {
    $q = "INSERT INTO sasaran_skpd (kd_subunit,sasaran,tahun) VALUES ($req->kd_subunit, '$req->sasaran',$session->tahun)";
}
// exit($q);
$qry = DB::query($q);

if ($qry) {
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