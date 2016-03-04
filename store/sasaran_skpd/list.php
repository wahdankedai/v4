<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 


$req = Common::obj(Request::all());

$q = "SELECT *  from sasaran_skpd WHERE kd_subunit = $req->kode and tahun = $session->tahun";

$qry = DB::query($q);

$res = $qry->fetchAll();

echo json_encode($res);


// print_r($req);
exit;