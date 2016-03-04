<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 
$config = Config::get('evaluasi');
$req = Common::obj(Request::all());

$q = "SELECT
        a.id,
        a.renstra,
        a.kd_unit,
        a.kd_subunit,
        a.kd_program,
        a.indikator,
        a.satuan,
        a.awal,
        a.tahun1,
        a.tahun2,
        a.tahun3,
        a.tahun4,
        a.tahun5,
        satuan.nm_satuan
        FROM
        indikator_outcome_renstra AS a
        INNER JOIN satuan ON satuan.id = a.satuan
    WHERE a.kd_unit = {$req->kd_unit} 
            AND a.kd_subunit = {$req->kd_subunit}
            AND a.kd_program = {$req->kd_program}
            AND a.renstra = '{$config->renstra}'
    ORDER BY
            a.id ASC";

$qry = DB::query($q);

$indikator = $qry->fetchAll();

echo json_encode($indikator);

exit;