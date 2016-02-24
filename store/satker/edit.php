<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$kd_urusan = Request::post('kd_urusan');
$kd_bidang = Request::post('kd_bidang');
$kd_satker = Request::post('kd_satker');
$nm_singkat = Request::post('nm_singkat');
$nm_satker = Request::post('nm_satker');

$dt = DB::update('satker', [
        "kd_urusan" => $kd_urusan,
        "kd_bidang" => $kd_bidang,
        "kd_satker" => $kd_satker
        ],[
        "nm_satker" => $nm_satker,
        "nm_singkat" => $nm_singkat,
    ]);
// echo $dt;exit;
if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data satker {$nm_satker} berhasil dirubah"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data satker {$nm_satker} gagal dirubah"
    ];
}

echo json_encode($hasil);


exit;