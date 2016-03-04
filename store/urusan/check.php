<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$id = Request::post('kd_urusan');
$old_id = Request::post('old_kd_urusan');
$mode = Request::post('mode');

if ($mode == 'edit') {
    $dt = DB::find('urusan', ['kd_urusan' => $id]);
    
    echo empty($dt) || $id == $old_id ? "true" : "false";

    exit;
}

$dt = DB::find('urusan', ['kd_urusan' => $id]);

echo empty($dt) ? "true" : "false";

exit;