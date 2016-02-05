<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);

if (empty($req)) {
    $bidang = DB::get("bidang");

    echo json_encode($bidang);

    exit;
}

$bidang = DB::findAll("bidang", $req);

echo json_encode($bidang);

exit;
