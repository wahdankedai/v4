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
        a.kd_unit,
        a.kd_subunit,
        a.kd_kegiatan,
        a.indikator,
        a.satuan,
        b.nm_satuan,
        a.awal,
        a.tahun1,
        a.tahun2,
        a.tahun3,
        a.tahun4,
        a.tahun5
        FROM
        indikator_output_renstra AS a
        INNER JOIN satuan AS b ON b.id = a.satuan
    WHERE a.kd_unit = {$req->kd_unit} 
            AND a.kd_subunit = {$req->kd_subunit}
            AND a.kd_kegiatan = {$req->kd_kegiatan}
            AND a.renstra = '{$config->renstra}'
    ORDER BY
            a.id ASC";
// exit($q);
$qry = DB::query($q);

$indikator = $qry->fetchAll();

echo json_encode($indikator);

exit;