<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req = Request::all($_REQUEST);

if (empty($req)) {
    $subunit = DB::get("subunit");

    echo json_encode($subunit);

    exit;
}

$subunit = DB::findAll("subunit", $req);

echo json_encode($subunit);

exit;
