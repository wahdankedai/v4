<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);

if (empty($req)) {
    $subunit = DB::get("subunit");

    echo json_encode($subunit);

    exit;
}

$subunit = DB::findAll("subunit", $req);

echo json_encode($subunit);

exit;
