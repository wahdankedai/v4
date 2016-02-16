<?php 

require '../../boot.php';

$req = Common::obj(Request::all($_REQUEST));


$q = "DELETE from unit_eselon WHERE id ='{$req->id}' or parent_id = '{$req->id}';";


try {
     DB::query($q);

      $hasil = [
        "success" => true,
        "message" => "Data berhasil dihapus"  
    ];
 } catch (Exception $e) {
     $hasil = [
        "success" => false,
        "message" => "Data gagal dihapus"
    ];
 } 


echo json_encode($hasil);


exit;