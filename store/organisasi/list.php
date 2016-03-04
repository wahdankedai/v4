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

if (isset($req->kode) && $req->kode != 0 && !isset($req->kd_subunit)) {
    $qry = DB::query("SELECT CONCAT(kd_urusan,kd_bidang,kd_unit) as kode,
        kd_subunit,
            nm_subunit as nama from subunit
        WHERE CONCAT(kd_urusan,kd_bidang,kd_unit) = ". $req->kode ." AND kd_subunit = 01
            ORDER BY kode ASC, kd_subunit ASC");
}

if (isset($req->kode) && $req->kode != 0 && isset($req->kd_subunit) && $req->kd_subunit == '01' ) {
    $qry = DB::query("SELECT CONCAT(kd_urusan,kd_bidang,kd_unit) as kode,
        kd_subunit,
            nm_subunit as nama from subunit
        WHERE CONCAT(kd_urusan,kd_bidang,kd_unit) = ". $req->kode ." 
            ORDER BY kode ASC, kd_subunit ASC");
}

if (isset($req->kode) && $req->kode != 0 && isset($req->kd_subunit) && $req->kd_subunit != '01' ) {
    $qry = DB::query("SELECT CONCAT(kd_urusan,kd_bidang,kd_unit) as kode,
        kd_subunit,
            nm_subunit as nama from subunit
        WHERE CONCAT(kd_urusan,kd_bidang,kd_unit) = ". $req->kode ." AND kd_subunit = " .$req->kd_subunit."
            ORDER BY kode ASC, kd_subunit ASC");
}

$skpd = $qry->fetchAll();

echo json_encode($skpd);

exit;
