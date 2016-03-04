<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$config = Config::get('evaluasi');

$req = Common::obj(Request::all());

$q = "SELECT kegiatan.kd_urusan,kegiatan.kd_bidang,kegiatan.kd_program,concat(kegiatan.kd_urusan,kegiatan.kd_bidang,kegiatan.kd_program,kegiatan.kd_kegiatan) as kd_kegiatan, kd_kegiatan as kode,
    nm_kegiatan 
from kegiatan 
where concat(kegiatan.kd_urusan,kegiatan.kd_bidang,kegiatan.kd_program,kegiatan.kd_kegiatan) NOT IN ( SELECT
    CONCAT(tabel_renstra.kd_urusan,tabel_renstra.kd_bidang,tabel_renstra.kd_program,tabel_renstra.kd_kegiatan) as kd_prog
        FROM
        tabel_renstra
        where kd_unit = $req->kd_unit
        and kd_sub_unit = $req->kd_subunit
        and renstra = '$config->renstra'
        GROUP BY kd_prog)
AND concat(kegiatan.kd_urusan,kegiatan.kd_bidang,kegiatan.kd_program) = $req->kd_program";

$qry = DB::query($q);

$kegiatan = $qry->fetchAll();

echo json_encode($kegiatan);

exit;