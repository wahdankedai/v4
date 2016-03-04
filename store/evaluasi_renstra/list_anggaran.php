<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 
$config = Config::get('evaluasi');
$req = Common::obj(Request::all());

$q = "SELECT
        a.*
        FROM
        indikator_anggaran_renstra AS a
    WHERE a.kd_unit = {$req->kd_unit} 
            AND a.kd_subunit = {$req->kd_subunit}
            AND a.kd_kegiatan = {$req->kd_kegiatan}
            AND a.renstra = '{$config->renstra}'";
// exit($q);
$qry = DB::query($q);

$indikator = $qry->fetchAll();

echo json_encode($indikator);

exit;