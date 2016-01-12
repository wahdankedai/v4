<?php 

require '../../boot.php';

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