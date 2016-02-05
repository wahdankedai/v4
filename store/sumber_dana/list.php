<?php 

require '../../boot.php';

$sumber_dana = DB::get("sumber_dana");

echo json_encode($sumber_dana);

exit;