<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);

if (empty($req)) {
    $kegiatan = DB::get("kegiatan");

    echo json_encode($kegiatan);

    exit;
}

$kegiatan = DB::findAll("kegiatan", $req);

echo json_encode($kegiatan);

exit;
