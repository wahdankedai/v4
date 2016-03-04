<?php 

require '../boot.php';

$tahun = DB::findAll("tahun", ["active" => 1]);

echo json_encode($tahun);

exit;