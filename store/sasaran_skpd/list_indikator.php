<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 


$req = Common::obj(Request::all());

$q = "SELECT
        indikator_sasaran.id,
        indikator_sasaran.sasaran_id,
        indikator_sasaran.indikator,
        indikator_sasaran.satuan_id,
        satuan.nm_satuan
        FROM
        indikator_sasaran
        INNER JOIN satuan ON satuan.id = indikator_sasaran.satuan_id WHERE indikator_sasaran.sasaran_id = $req->sasaran_id";

$qry = DB::query($q);

$res = $qry->fetchAll();

echo json_encode($res);


// print_r($req);
exit;