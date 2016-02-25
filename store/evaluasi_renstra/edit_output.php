<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$id = Request::post('id');
$indikator = Request::post('indikator');
$satuan = Request::post('satuan');
$tahun1 = Common::toNULL(Request::post('target_tahun_1'));
$tahun2 = Common::toNULL(Request::post('target_tahun_2'));
$tahun3 = Common::toNULL(Request::post('target_tahun_3'));
$tahun4 = Common::toNULL(Request::post('target_tahun_4'));
$tahun5 = Common::toNULL(Request::post('target_tahun_5'));
$awal = Common::toNULL(Request::post('awal'));

if($satuan < 1) {
    echo json_encode([
        "success" => false,
        "message" => "Harap Pilih data Satuan dari data yang disediakan"
    ]);
    exit;
}

$q = "UPDATE indikator_output_renstra 
        SET indikator = '$indikator',
        satuan = $satuan,
        awal = $awal,
        tahun1 = $tahun1,
        tahun2 = $tahun2,
        tahun3 = $tahun3,
        tahun4 = $tahun4,
        tahun5 = $tahun5 
       WHERE  id = $id";

$dt = DB::query($q);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;