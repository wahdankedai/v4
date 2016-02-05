<?php 

require '../boot.php';

$ok = DB::findAll("tahun", ["active" => 1]);

echo json_encode($ok);

exit;