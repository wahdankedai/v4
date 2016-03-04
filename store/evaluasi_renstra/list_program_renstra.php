<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$config = Config::get('evaluasi');

$req = Common::obj(Request::all());

$q = "SELECT concat(program.kd_urusan,program.kd_bidang,program.kd_program) as kd_program, 
    nm_program 
from program 
where concat(program.kd_urusan,program.kd_bidang,program.kd_program) NOT IN ( SELECT
    CONCAT(tabel_renstra.kd_urusan,tabel_renstra.kd_bidang,tabel_renstra.kd_program) as kd_prog
        FROM
        tabel_renstra
        where kd_unit = $req->kd_unit
        and kd_sub_unit = $req->kd_subunit
        and renstra = '$config->renstra'
        GROUP BY kd_prog)
AND kd_urusan = $req->kd_urusan
AND kd_bidang = $req->kd_bidang";

$qry = DB::query($q);

$bidang = $qry->fetchAll();

echo json_encode($bidang);

exit;