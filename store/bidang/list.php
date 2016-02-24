<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req = Request::all($_REQUEST);

if (empty($req)) {
    $bidang = DB::get("bidang");

    echo json_encode($bidang);

    exit;
}

$bidang = DB::findAll("bidang", $req);

echo json_encode($bidang);

exit;
