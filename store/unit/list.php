<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req = Request::all($_REQUEST);

if (empty($req)) {
    $unit = DB::get("unit");

    echo json_encode($unit);

    exit;
}

$unit = DB::findAll("unit", $req);

echo json_encode($unit);

exit;
