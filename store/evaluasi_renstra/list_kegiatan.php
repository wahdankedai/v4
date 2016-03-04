<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());
$config = Config::get('evaluasi');
$q = "SELECT
b.kd_urusan,
b.kd_bidang,
b.kd_program,
b.kd_kegiatan,
b.nm_kegiatan
FROM
tabel_renstra AS a
INNER JOIN kegiatan AS b ON b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program AND b.kd_kegiatan = a.kd_kegiatan

    WHERE a.kd_unit = {$req->kode} 
            AND a.kd_sub_unit = {$req->kd_subunit}
            AND a.kd_urusan = {$req->kd_urusan}
            AND a.kd_bidang = {$req->kd_bidang}
            AND a.kd_program = {$req->kd_program}
            AND a.renstra = '{$config->renstra}'
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