<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$kd_urusan = Request::post('kd_urusan');
$nm_urusan = Request::post('nm_urusan');

$dt = DB::insert('urusan', [
        "kd_urusan" => $kd_urusan,
        "nm_urusan" => $nm_urusan,
    ]);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data Urusan {$nm_urusan} berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Urusan {$nm_urusan} gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;