<?php 

require '../../boot.php';
$req = Common::obj(Request::all($_REQUEST));
// print_r($req);
$q = "SELECT concat(bidang.kd_urusan,bidang.kd_bidang) as kd_bidang,
        bidang.nm_bidang
        FROM
        unit
        INNER JOIN unit_tupoksi ON concat(unit.kd_urusan,unit.kd_bidang,unit.kd_unit)= unit_tupoksi.kd_unit
        INNER JOIN bidang ON concat(bidang.kd_urusan,bidang.kd_bidang) = unit_tupoksi.kd_bidang
        WHERE unit_tupoksi.kd_unit = {$req->kd_bidang}
        ORDER BY kd_bidang ASC";


$qry = DB::query($q);

$program = $qry->fetchAll();

echo json_encode($program);

exit;
