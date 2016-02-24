<?php 

require '../../boot.php';

require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());

/**
 * jika (id) ada dan target/realisasi kosong semua
 * maka proses itu dianggap menghapus target indikator
 */

if (    $req->id != '' && 
        $req->target_triwulan_1 == '' &&
        $req->target_triwulan_2 == '' &&
        $req->target_triwulan_3 == '' &&
        $req->target_triwulan_4 == ''
    ) {

    DB::query("DELETE FROM target_indikator_outcome where id={$req->id}");
    
    echo json_encode([
        "success" => true,
        "message" => "Data berhasil dihapus"  
    ]);
    exit;
}

/**
 * jika salah satu target indikator
 * ada yang kosong, maka timpailkan pesan gagal
 */

if (    $req->unit_eselon_id == '' ||
        $req->target_triwulan_1 == '' ||
        $req->target_triwulan_2 == '' ||
        $req->target_triwulan_3 == '' ||
        $req->target_triwulan_4 == '' 
    ) {
   echo json_encode([
        "success" => false,
        "message" => "Harap Isi Data Target / Realisasi"  
    ]);
    exit;
}

/**
 * jika id kosong dan target tidak kosong
 * maka dianggap mengisi target
 */

if(  $req->id == '' && 
        $req->unit_eselon_id != '' &&
        $req->target_triwulan_1 != '' &&
        $req->target_triwulan_2 != '' &&
        $req->target_triwulan_3 != '' &&
        $req->target_triwulan_4 != '' 
    ) {

    $q = "INSERT INTO target_indikator_outcome (
            `id`,
            `id_indikator`,
            `tahun`,
            `unit_eselon_id`,
            `target_triwulan_1`,
            `target_triwulan_2`,
            `target_triwulan_3`,
            `target_triwulan_4`
        ) VALUES (
            '$req->id',
            '$req->id_indikator',
             $session->tahun,
            '$req->unit_eselon_id',
            '$req->target_triwulan_1',
            '$req->target_triwulan_2',
            '$req->target_triwulan_3',
            '$req->target_triwulan_4'
        )";
}

/**
 * jika id ada dan target tidak kosong
 * maka dianggap merubah target/realiasasi
 */

if(  $req->id != '' && 
        $req->unit_eselon_id != '' &&
        $req->target_triwulan_1 != '' &&
        $req->target_triwulan_2 != '' &&
        $req->target_triwulan_3 != '' &&
        $req->target_triwulan_4 != '' 
    ) {

    $q = "UPDATE target_indikator_outcome SET 
            `unit_eselon_id` = $req->unit_eselon_id,
            `target_triwulan_1` = $req->target_triwulan_1,
            `target_triwulan_2` = $req->target_triwulan_2,
            `target_triwulan_3` = $req->target_triwulan_3,
            `target_triwulan_4` = $req->target_triwulan_4
        WHERE id = $req->id";
}



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