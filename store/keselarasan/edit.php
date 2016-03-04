<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$kd_keselarasan = Request::post('kd_keselarasan');
$nm_keselarasan = Request::post('nm_keselarasan');

$dt = DB::update('keselarasan', [
        "kd_keselarasan" => $kd_keselarasan
        ],[
        "nm_keselarasan" => $nm_keselarasan,
    ]);
// echo $dt;exit;
if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data keselarasan {$nm_keselarasan} berhasil dirubah"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data keselarasan {$nm_keselarasan} gagal dirubah"
    ];
}

echo json_encode($hasil);


exit;