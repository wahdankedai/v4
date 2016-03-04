<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req = Request::all($_REQUEST);

if (empty($req)) {
    $program = DB::get("program");

    echo json_encode($program);

    exit;
}

$program = DB::findAll("program", $req);

echo json_encode($program);

exit;
