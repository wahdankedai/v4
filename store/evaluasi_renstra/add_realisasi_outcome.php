<?php 

require '../../boot.php';

require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());

/**
 * jika salah satu target indikator
 * ada yang kosong, maka timpailkan pesan gagal
 */

if ($req->id == '') {
   echo json_encode([
        "success" => false,
        "message" => "ID tidak ada"  
    ]);
    exit;
}



$q = "UPDATE target_indikator_outcome SET 
    `realisasi_triwulan_1` = " . Common::toNULL($req->realisasi_triwulan_1) .",
    `realisasi_triwulan_2` = " . Common::toNULL($req->realisasi_triwulan_2) .",
    `realisasi_triwulan_3` = " . Common::toNULL($req->realisasi_triwulan_3) .",
    `realisasi_triwulan_4` = " . Common::toNULL($req->realisasi_triwulan_4) ."
WHERE id = $req->id";



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