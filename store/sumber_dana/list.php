<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$sumber_dana = DB::get("sumber_dana");

echo json_encode($sumber_dana);

exit;