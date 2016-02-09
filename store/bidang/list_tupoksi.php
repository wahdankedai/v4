<?php 

require '../../boot.php';

$req = Common::obj(Request::all($_REQUEST));

$q = "SELECT CONCAT(
bidang.kd_urusan,
bidang.kd_bidang) as kd_bidang,
bidang.nm_bidang
FROM
bidang
WHERE CONCAT(
bidang.kd_urusan,
bidang.kd_bidang) NOT IN (SELECT 
        concat(bidang.kd_urusan,bidang.kd_bidang) as kd_bidang
        FROM
        unit
        INNER JOIN unit_tupoksi ON concat(unit.kd_urusan,unit.kd_bidang,unit.kd_unit)= unit_tupoksi.kd_unit
        INNER JOIN bidang ON concat(bidang.kd_urusan,bidang.kd_bidang) = unit_tupoksi.kd_bidang
        WHERE unit_tupoksi.kd_unit = {$req->kode}
        ORDER BY kd_bidang ASC) ORDER BY kd_bidang ASC";


$qry = DB::query($q);
$bidang = $qry->fetchAll();
echo json_encode($bidang);

exit;
