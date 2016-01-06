<?php 

require '../../boot.php';

$id = Request::post('id');

$dt = DB::find('urusan', ['kd_urusan' => $id]);

echo empty($dt) ? "true" : "false";

exit;