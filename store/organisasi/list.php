<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req =  Common::obj(Request::all());



$qry = DB::query("SELECT CONCAT(kd_urusan,kd_bidang,kd_unit) as kode,
            nm_unit as nama from unit
            ORDER BY kode ASC");

if (isset($req->kode) && $req->kode != 0) {
    $qry = DB::query("SELECT CONCAT(kd_urusan,kd_bidang,kd_unit) as kode,
        kd_subunit,
            nm_subunit as nama from subunit
        WHERE CONCAT(kd_urusan,kd_bidang,kd_unit) = ". $req->kode ."
            ORDER BY kode ASC, kd_subunit ASC");
}

$skpd = $qry->fetchAll();

echo json_encode($skpd);

exit;
