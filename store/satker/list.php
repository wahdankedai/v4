<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);

if (empty($req)) {
    $satker = DB::get("satker");

    echo json_encode($satker);

    exit;
}

$satker = DB::findAll("satker", $req);

echo json_encode($satker);

exit;
