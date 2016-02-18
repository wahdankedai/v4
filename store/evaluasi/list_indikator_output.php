<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());

$q = "SELECT
        a.id,
        a.kd_unit,
        a.kd_subunit,
        a.kd_kegiatan,
        a.indikator,
        a.satuan,
        b.nm_satuan
        FROM
        indikator_output_kegiatan AS a
        INNER JOIN satuan AS b ON b.id = a.satuan
    WHERE a.kd_unit = {$req->kd_unit} 
            AND a.kd_subunit = {$req->kd_subunit}
            AND a.kd_kegiatan = {$req->kd_kegiatan}
    ORDER BY
            a.id ASC";
// exit($q);
$qry = DB::query($q);

$indikator = $qry->fetchAll();

echo json_encode($indikator);

exit;