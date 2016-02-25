<?php 
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 
$config = Config::get('evaluasi');
$req = Common::obj(Request::all());

$q = "UPDATE indikator_anggaran_renstra SET 
    `awal` = " . Common::toNULL($req->awal) . ",
    `tahun1` = " . Common::toNULL($req->tahun1) . ",
    `tahun2` = " . Common::toNULL($req->tahun2) . ",
    `tahun3` = " . Common::toNULL($req->tahun3) . ",
    `tahun4` = " . Common::toNULL($req->tahun4) . ",
    `tahun5` = " . Common::toNULL($req->tahun5) . "
WHERE 
    renstra = '$config->renstra' AND 
    kd_kegiatan = $req->kd_kegiatan AND 
    kd_unit = $req->kd_unit AND 
    kd_subunit = $req->kd_subunit
";

// exit($q);

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