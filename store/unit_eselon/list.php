<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$req = Common::obj(Request::all($_REQUEST));

$parent = isset($req->parent_id) ? " AND parent_id = $req->parent_id" : "";

$q = "SELECT
        unit_eselon.kd_unit,
        unit_eselon.kd_subunit,
        unit_eselon.person,
        unit_eselon.eselon,
        unit_eselon.unit_organisasi,
        unit_eselon.id,
        unit_eselon.parent_id
        FROM
        unit_eselon
        INNER JOIN unit ON concat(
        unit.kd_urusan,
        unit.kd_bidang,
        unit.kd_unit) = unit_eselon.kd_unit
        WHERE unit_eselon.kd_unit = {$req->kode} AND unit_eselon.kd_subunit = {$req->kd_subunit} {$parent}
        ORDER BY id ASC";

// exit($q);
$qry = DB::query($q);

$program = $qry->fetchAll();

echo json_encode($program);

exit;
