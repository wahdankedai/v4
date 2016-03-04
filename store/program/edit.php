<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$kd_urusan = Request::post('kd_urusan');
$kd_bidang = Request::post('kd_bidang');
$kd_program = Request::post('kd_program');
$nm_program = Request::post('nm_program');

$dt = DB::update('program', [
        "kd_urusan" => $kd_urusan,
        "kd_bidang" => $kd_bidang,
        "kd_program" => $kd_program
        ],[
        "nm_program" => $nm_program,
    ]);
// echo $dt;exit;
if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data Program {$nm_program} berhasil dirubah"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Program {$nm_program} gagal dirubah"
    ];
}

echo json_encode($hasil);


exit;