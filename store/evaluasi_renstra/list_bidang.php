<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());

$q = "SELECT
    b.kd_urusan,
    b.kd_bidang,
    b.nm_bidang
    FROM
    unit_tupoksi AS a
    INNER JOIN bidang AS b ON concat(b.kd_urusan,b.kd_bidang) = a.kd_bidang
    WHERE a.kd_unit = {$req->kode} 
            AND b.kd_urusan = {$req->kd_urusan}
    GROUP BY
            b.kd_urusan,
            b.kd_bidang
    ORDER BY
            b.kd_urusan ASC,
            b.kd_bidang ASC";
// exit($q);
$qry = DB::query($q);

$bidang = $qry->fetchAll();

echo json_encode($bidang);

exit;