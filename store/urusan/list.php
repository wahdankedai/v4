<?php 

require '../../boot.php';

$urusan = DB::get("urusan");

echo json_encode($urusan);

exit;