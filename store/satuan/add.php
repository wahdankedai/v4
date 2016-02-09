<?php 

require '../../boot.php';

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