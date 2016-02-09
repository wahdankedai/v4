<?php 

require '../../boot.php';

$kd_satuan = Request::post('kd_satuan');
$nm_satuan = Request::post('nm_satuan');

$dt = DB::update('satuan', [
        "nm_satuan" => $kd_satuan
        ],[
        "nm_satuan" => $nm_satuan,
    ]);
// echo $dt;exit;
if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data satuan {$nm_satuan} berhasil dirubah"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data satuan {$nm_satuan} gagal dirubah"
    ];
}

echo json_encode($hasil);


exit;