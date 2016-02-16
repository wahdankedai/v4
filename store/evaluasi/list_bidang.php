<?php 

require '../../boot.php';

$req = Common::obj(Request::all());

$q = "SELECT
    b.kd_urusan,
    b.kd_bidang,
    b.nm_bidang
    FROM
    tabel_dpa AS a
    INNER JOIN bidang b ON b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang
    WHERE a.kd_unit = {$req->kode} 
            AND a.kd_sub_unit = {$req->kd_subunit}
            AND a.kd_urusan = {$req->kd_urusan}
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