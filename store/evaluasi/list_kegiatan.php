<?php 

require '../../boot.php';

$req = Common::obj(Request::all());

$q = "SELECT
b.kd_urusan,
b.kd_bidang,
b.kd_program,
b.kd_kegiatan,
b.nm_kegiatan
FROM
tabel_dpa AS a
INNER JOIN kegiatan AS b ON b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program AND b.kd_kegiatan = a.kd_kegiatan

    WHERE a.kd_unit = {$req->kode} 
            AND a.kd_sub_unit = {$req->kd_subunit}
            AND a.kd_urusan = {$req->kd_urusan}
            AND a.kd_bidang = {$req->kd_bidang}
            AND a.kd_program = {$req->kd_program}
    GROUP BY
            b.kd_urusan,
            b.kd_bidang,
            b.kd_program,
            b.kd_kegiatan
    ORDER BY
            b.kd_urusan ASC,
            b.kd_bidang ASC,
            b.kd_program ASC,
            b.kd_kegiatan ASC";
// exit($q);
$qry = DB::query($q);

$bidang = $qry->fetchAll();

echo json_encode($bidang);

exit;