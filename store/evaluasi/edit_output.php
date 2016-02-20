<?php 

require '../../boot.php';

$id = Request::post('id');
$indikator = Request::post('indikator');
$satuan = Request::post('satuan');

if($satuan < 1) {
    echo json_encode([
        "success" => false,
        "message" => "Harap Pilih data Satuan dari data yang disediakan"
    ]);
    exit;
}

$dt = DB::update('indikator_output_kegiatan', [
        "id" => $id
    ],[
        "indikator" => $indikator,
        "satuan" => $satuan,
    ]);

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