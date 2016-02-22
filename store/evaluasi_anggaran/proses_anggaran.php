<?php 
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());

$req->target_triwulan_1 = Common::toNULL($req->target_triwulan_1);
$req->target_triwulan_2 = Common::toNULL($req->target_triwulan_2);
$req->target_triwulan_3 = Common::toNULL($req->target_triwulan_3);
$req->target_triwulan_4 = Common::toNULL($req->target_triwulan_4);
$req->realisasi_triwulan_1 = Common::toNULL($req->realisasi_triwulan_1);
$req->realisasi_triwulan_2 = Common::toNULL($req->realisasi_triwulan_2);
$req->realisasi_triwulan_3 = Common::toNULL($req->realisasi_triwulan_3);
$req->realisasi_triwulan_4 = Common::toNULL($req->realisasi_triwulan_4);

$q = "INSERT INTO target_anggaran (
`tahun`,
`kd_urusan`,
`kd_bidang`,
`kd_program`,
`kd_kegiatan`,
`kd_unit`,
`kd_sub_unit`,
`target_triwulan_1`,
`target_triwulan_2`,
`target_triwulan_3`,
`target_triwulan_4`,
`realisasi_triwulan_1`,
`realisasi_triwulan_2`,
`realisasi_triwulan_3`,
`realisasi_triwulan_4` )
VALUES (
    $req->tahun,
    $req->kd_urusan,
    $req->kd_bidang,
    $req->kd_program,
    $req->kd_kegiatan,
    $req->kd_unit,
    $req->kd_sub_unit,
    $req->target_triwulan_1,
    $req->target_triwulan_2,
    $req->target_triwulan_3,
    $req->target_triwulan_4,
    $req->realisasi_triwulan_1,
    $req->realisasi_triwulan_2,
    $req->realisasi_triwulan_3,
    $req->realisasi_triwulan_4
)
ON DUPLICATE KEY UPDATE 
    `target_triwulan_1` = VALUES (`target_triwulan_1`),
    `target_triwulan_2` = VALUES (`target_triwulan_2`),
    `target_triwulan_3` = VALUES (`target_triwulan_3`),
    `target_triwulan_4` = VALUES (`target_triwulan_4`),
    `realisasi_triwulan_1` = VALUES (`realisasi_triwulan_1`),
    `realisasi_triwulan_2` = VALUES (`realisasi_triwulan_2`),
    `realisasi_triwulan_3` = VALUES (`realisasi_triwulan_3`),
    `realisasi_triwulan_4` = VALUES (`realisasi_triwulan_4`)
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