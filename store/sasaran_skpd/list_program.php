<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 


$req = Common::obj(Request::all());

$q = "SELECT
        a.id,
        a.id_sasaran,
        a.kd_program,
        c.nm_program
        FROM
        indikator_sasaran_program AS a
        INNER JOIN indikator_sasaran AS b ON b.id = a.id_sasaran
        INNER JOIN program AS c ON concat(c.kd_urusan,c.kd_bidang,c.kd_program) = a.kd_program
        WHERE a.id_sasaran = $req->id";

$qry = DB::query($q);

$res = $qry->fetchAll();

echo json_encode($res);


// print_r($req);
exit;