<?php 

require '../../boot.php';

$req = Request::all($_REQUEST);

if (empty($req)) {
    $program = DB::get("program");

    echo json_encode($program);

    exit;
}

$program = DB::findAll("program", $req);

echo json_encode($program);

exit;
