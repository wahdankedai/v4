<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$id = Request::post('id');
$req = Common::obj(Request::all());

if (isset($req->indikator)) {
    $delete = DB::delete('indikator_sasaran', [
        'id' => $id
    ]);
} else {
    $delete = DB::delete('sasaran_skpd', [
        'id' => $id
    ]);
    
}

if ($delete) {
    $hasil = [
        "success" => true,
        "message" => "Data berhasil dihapus"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data gagal dihapus"
    ];
}

echo json_encode($hasil);
exit;