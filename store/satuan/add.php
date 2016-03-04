<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$nm_satuan = Request::post('nm_satuan');

$dt = DB::insert('satuan', [
        "nm_satuan" => $nm_satuan
    ]);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data satuan {$nm_satuan} berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data satuan {$nm_satuan} gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;