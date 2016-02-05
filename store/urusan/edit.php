<?php 

require '../../boot.php';

$kd_urusan = Request::post('kd_urusan');
$nm_urusan = Request::post('nm_urusan');

$dt = DB::update('urusan', [
        "kd_urusan" => $kd_urusan
        ],[
        "nm_urusan" => $nm_urusan,
    ]);
// echo $dt;exit;
if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data Urusan {$nm_urusan} berhasil dirubah"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data Urusan {$nm_urusan} gagal dirubah"
    ];
}

echo json_encode($hasil);


exit;