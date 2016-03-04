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
$satuan = Request::post('satuan');
$tahun1 = Request::post('target_tahun_1');
$tahun2 = Request::post('target_tahun_2');
$tahun3 = Request::post('target_tahun_3');
$tahun4 = Request::post('target_tahun_4');
$tahun5 = Request::post('target_tahun_5');
$awal = Request::post('target_awal');
$config = Config::get('evaluasi');
if($satuan < 1) {
    echo json_encode([
        "success" => false,
        "message" => "Harap Pilih data Satuan dari data yang disediakan"
    ]);
    exit;
}

$dt = DB::insert('indikator_output_renstra', [
        "kd_unit" => $kd_unit,
        "kd_subunit" => $kd_subunit,
        "kd_kegiatan" => $kd_kegiatan,
        "indikator" => $indikator,
        "satuan" => $satuan,
        "awal" => $awal,
        "tahun1" => $tahun1,
        "tahun2" => $tahun2,
        "tahun3" => $tahun3,
        "tahun4" => $tahun4,
        "tahun5" => $tahun5,
        "renstra" => $config->renstra,
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