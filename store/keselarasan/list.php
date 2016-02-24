<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$keselarasan = DB::get("keselarasan");

echo json_encode($keselarasan);

exit;