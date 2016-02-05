<?php 

require '../../boot.php';

$nm_sumber_dana = Request::post('nm_sumber_dana');

$dt = DB::insert('sumber_dana', [
        "nm_sumber_dana" => $nm_sumber_dana
    ]);

if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data sumber_dana {$nm_sumber_dana} berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data sumber_dana {$nm_sumber_dana} gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;