<?php 

require '../../../boot.php';

require '../../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req = Common::obj(Request::all());

$table = 'indikator_outcome_program';

if ($req->eselon == 'III') {
      $table = 'indikator_outcome_program';
}

if ($req->eselon == 'IV') {
      $table = 'indikator_output_kegiatan';
}

$qry = DB::query("SELECT
            a.id,
            a.unit_organisasi,
            a.person
            FROM
            unit_eselon AS a
            INNER JOIN $table AS b ON b.kd_unit = a.kd_unit AND b.kd_subunit = a.kd_subunit
            WHERE
            b.id = $req->id AND
            a.eselon = '$req->eselon'
    ");

$res = $qry->fetchAll();

echo json_encode($res);

exit;