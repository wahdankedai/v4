<?php 

require '../../boot.php';

$satuan = DB::get("satuan");

echo json_encode($satuan);

exit;