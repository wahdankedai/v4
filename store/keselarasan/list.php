<?php 

require '../../boot.php';

$keselarasan = DB::get("keselarasan");

echo json_encode($keselarasan);

exit;