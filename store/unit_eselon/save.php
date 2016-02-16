<?php 

require '../../boot.php';

$req = Common::obj(Request::all($_REQUEST));

if ($req->state == "add")
{
    $q = "INSERT INTO unit_eselon (unit_eselon.kd_unit,
            unit_eselon.kd_subunit,
            unit_eselon.unit_organisasi,
            unit_eselon.person,
            unit_eselon.eselon,
            unit_eselon.parent_id) VALUES (
            '{$req->kd_unit}' , '{$req->kd_subunit}', '{$req->unit_organisasi}', '{$req->person}', '{$req->eselon}', '{$req->parent_id}'
    );";
}
else if ($req->state == "edit")
{
        $q = "UPDATE unit_eselon set 
            unit_eselon.unit_organisasi = '{$req->unit_organisasi}',
            unit_eselon.person = '{$req->person}'
            WHERE id = '{$req->id}'";
} 
try {
     DB::query($q);

      $hasil = [
        "success" => true,
        "message" => "Data berhasil disimpan"  
    ];
 } catch (Exception $e) {
     $hasil = [
        "success" => false,
        "message" => "Data gagal disimpan"
    ];
 } 


echo json_encode($hasil);


exit;