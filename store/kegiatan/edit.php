<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$kd_urusan = Request::post('kd_urusan');
$kd_bidang = Request::post('kd_bidang');
$kd_program = Request::post('kd_program');
$kd_kegiatan = Request::post('kd_kegiatan');
$nm_kegiatan = Request::post('nm_kegiatan');

$dt = DB::update('kegiatan', [
        "kd_urusan" => $kd_urusan,
        "kd_bidang" => $kd_bidang,
        "kd_program" => $kd_program,
        "kd_kegiatan" => $kd_kegiatan
        ],[
        "nm_kegiatan" => $nm_kegiatan,
    ]);
// echo $dt;exit;
if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data Kegiatan {$nm_kegiatan} berhasil dirubah"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Kegiatan {$nm_kegiatan} gagal dirubah"
    ];
}

echo json_encode($hasil);


exit;