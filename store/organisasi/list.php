<?php 

require '../../boot.php';

$qry = DB::query("SELECT CONCAT(kd_urusan,kd_bidang,kd_unit) as kode,
            nm_unit as nama from unit
            ORDER BY kode ASC");

$program = $qry->fetchAll();

echo json_encode($program);

exit;
