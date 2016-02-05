<?php 

require '../../boot.php';

$kd_sumber_dana = Request::post('kd_sumber_dana');
$nm_sumber_dana = Request::post('nm_sumber_dana');

$dt = DB::update('sumber_dana', [
        "nm_sumber_dana" => $kd_sumber_dana
        ],[
        "nm_sumber_dana" => $nm_sumber_dana,
    ]);
// echo $dt;exit;
if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data sumber_dana {$nm_sumber_dana} berhasil dirubah"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data sumber_dana {$nm_sumber_dana} gagal dirubah"
    ];
}

echo json_encode($hasil);


exit;