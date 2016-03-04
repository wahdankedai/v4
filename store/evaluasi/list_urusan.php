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
            tabel_dpa a
        INNER JOIN urusan b ON b.kd_urusan = a.kd_urusan
        WHERE a.kd_unit = {$req->kode} 
            AND a.kd_sub_unit = {$req->kd_subunit}
            AND a.tahun = {$session->tahun}
        GROUP BY
            b.kd_urusan
        ORDER BY
            b.kd_urusan ASC";

$qry = DB::query($q);

$urusan = $qry->fetchAll();

echo json_encode($urusan);

exit;