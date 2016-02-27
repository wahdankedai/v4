<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req =  Common::obj(Request::all());



$qry = DB::query("SELECT concat(
        subunit.kd_urusan,
        subunit.kd_bidang,
        subunit.kd_unit,
        subunit.kd_subunit) as kode,
        subunit.nm_subunit as nama
    FROM
        subunit
    ORDER BY kode ASC");

if (isset($req->kd_subunit) && strlen($req->kd_subunit) == 7) {
        $qry = DB::query("SELECT concat(
            subunit.kd_urusan,
            subunit.kd_bidang,
            subunit.kd_unit,
            subunit.kd_subunit) as kode,
            subunit.nm_subunit as nama
        FROM
            subunit
        WHERE CONCAT(subunit.kd_urusan,subunit.kd_bidang,subunit.kd_unit,subunit.kd_subunit) = ". $req->kd_subunit ."
            ORDER BY kode ASC, kd_subunit ASC");
}

if (isset($req->kd_subunit) && strlen($req->kd_subunit) == 5) {
        $qry = DB::query("SELECT concat(
            subunit.kd_urusan,
            subunit.kd_bidang,
            subunit.kd_unit,
            subunit.kd_subunit) as kode,
            subunit.nm_subunit as nama
        FROM
            subunit
        WHERE CONCAT(subunit.kd_urusan,subunit.kd_bidang,subunit.kd_unit) = ". $req->kd_subunit ."
            ORDER BY kode ASC, kd_subunit ASC");
}

$skpd = $qry->fetchAll();

echo json_encode($skpd);

exit;
