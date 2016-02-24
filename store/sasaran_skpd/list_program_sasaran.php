<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 


$req = Common::obj(Request::all());

$q = "SELECT concat (
        a.kd_urusan,
        a.kd_bidang,
        a.kd_program) as kd_program,
        b.nm_program
        FROM
        tabel_dpa AS a
        INNER JOIN program AS b ON b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program
        WHERE concat (
            a.kd_urusan,
            a.kd_bidang,
            a.kd_program) NOT IN (
            SELECT
            a.kd_program
            FROM
            indikator_sasaran_program AS a
            INNER JOIN indikator_sasaran AS b ON b.id = a.id_sasaran
            INNER JOIN program AS c ON concat(c.kd_urusan,c.kd_bidang,c.kd_program) = a.kd_program
            WHERE b.id = $req->id
        ) and CONCAT(a.kd_unit,a.kd_sub_unit) = $req->kd_sub_unit
        GROUP BY concat (
        a.kd_urusan,
        a.kd_bidang,
        a.kd_program)";
$qry = DB::query($q);

$res = $qry->fetchAll();

echo json_encode($res);

exit;