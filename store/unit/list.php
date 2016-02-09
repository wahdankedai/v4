<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);

if (empty($req)) {
    $unit = DB::get("unit");

    echo json_encode($unit);

    exit;
}

$unit = DB::findAll("unit", $req);

echo json_encode($unit);

exit;
