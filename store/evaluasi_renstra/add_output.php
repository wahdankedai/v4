<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$kd_unit = Request::post('kd_unit');
$kd_subunit = Request::post('kd_subunit');
$kd_kegiatan = Request::post('kd_kegiatan');
$indikator = Request::post('indikator');
$satuan = Request::post('satuan');

if($satuan < 1) {
    echo json_encode([
        "success" => false,
        "message" => "Harap Pilih data Satuan dari data yang disediakan"
    ]);
    exit;
}

$dt = DB::insert('indikator_output_kegiatan', [
        "kd_unit" => $kd_unit,
        "kd_subunit" => $kd_subunit,
        "kd_kegiatan" => $kd_kegiatan,
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