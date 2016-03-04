<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req = Request::all($_REQUEST);

if (empty($req)) {
    $kegiatan = DB::get("kegiatan");

    echo json_encode($kegiatan);

    exit;
}

$kegiatan = DB::findAll("kegiatan", $req);

echo json_encode($kegiatan);

exit;
