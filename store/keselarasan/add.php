<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$kd_keselarasan = Request::post('kd_keselarasan');
$nm_keselarasan = Request::post('nm_keselarasan');

$dt = DB::insert('keselarasan', [
        "kd_keselarasan" => $kd_keselarasan,
        "nm_keselarasan" => $nm_keselarasan,
    ]);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data keselarasan {$nm_keselarasan} berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data keselarasan {$nm_keselarasan} gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;