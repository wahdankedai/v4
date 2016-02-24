<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());

$q = "SELECT
b.kd_urusan,
b.nm_urusan
FROM
unit_tupoksi AS a
INNER JOIN urusan AS b ON b.kd_urusan = left(a.kd_bidang,1)
        WHERE a.kd_unit = {$req->kode} 
        GROUP BY
            b.kd_urusan
        ORDER BY
            b.kd_urusan ASC";

$qry = DB::query($q);

$urusan = $qry->fetchAll();

echo json_encode($urusan);

exit;