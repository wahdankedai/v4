<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$config = Config::get('evaluasi');
$req = Request::all();
$req["renstra"] = $config->renstra;

$dt = DB::delete('tabel_renstra', $req);



if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data gagal dihapus"
    ];
}

echo json_encode($hasil);


exit;