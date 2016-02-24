<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req = Common::obj(Request::all());
$q = "SELECT * from `report` WHERE modul_id = $req->modul_id";

$qry = DB::query($q);

$report = $qry->fetchAll();

echo json_encode($report);

exit;
