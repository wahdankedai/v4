<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$config = Config::get('evaluasi');

$req = Common::obj(Request::all());

$q = "SELECT
        b.kd_urusan,
        b.kd_bidang,
        b.kd_program,
        b.nm_program
        FROM
        tabel_renstra AS a
        INNER JOIN program AS b ON b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program
    WHERE a.kd_unit = {$req->kode} 
            AND a.kd_sub_unit = {$req->kd_subunit}
            AND a.kd_urusan = {$req->kd_urusan}
            AND a.kd_bidang = {$req->kd_bidang}
            AND a.renstra = '{$config->renstra}'
    GROUP BY
            b.kd_urusan,
            b.kd_bidang,
            b.kd_program
    ORDER BY
            b.kd_urusan ASC,
            b.kd_bidang ASC,
            b.kd_program ASC";
// exit($q);
$qry = DB::query($q);

$bidang = $qry->fetchAll();

echo json_encode($bidang);

exit;