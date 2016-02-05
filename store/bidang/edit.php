<?php 

require '../../boot.php';

$kd_urusan = Request::post('kd_urusan');
$kd_bidang = Request::post('kd_bidang');
$nm_bidang = Request::post('nm_bidang');

$dt = DB::update('bidang', [
        "kd_urusan" => $kd_urusan,
        "kd_bidang" => $kd_bidang
        ],[
        "nm_bidang" => $nm_bidang,
    ]);
// echo $dt;exit;
if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data Bidang {$nm_bidang} berhasil dirubah"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Bidang {$nm_bidang} gagal dirubah"
    ];
}

echo json_encode($hasil);


exit;