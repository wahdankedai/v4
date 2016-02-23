<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 


$req =  Common::obj(Request::all());


if (isset($req->id)) {
    $q = "UPDATE indikator_sasaran set indikator = '$req->indikator', satuan_id = $req->satuan_id WHERE id=$req->id";
} else {
    $q = "INSERT INTO indikator_sasaran (sasaran_id,indikator,satuan_id) VALUES ($req->sasaran_id,'$req->indikator',$req->satuan_id)";
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