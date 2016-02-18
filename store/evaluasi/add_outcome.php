<?php 

require '../../boot.php';

$kd_unit = Request::post('kd_unit');
$kd_subunit = Request::post('kd_subunit');
$kd_program = Request::post('kd_program');
$indikator = Request::post('indikator');
$satuan = Request::post('satuan');

$dt = DB::insert('indikator_outcome_program', [
        "kd_unit" => $kd_unit,
        "kd_subunit" => $kd_subunit,
        "kd_program" => $kd_program,
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