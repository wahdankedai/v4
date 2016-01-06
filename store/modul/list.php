<?php
require '../../boot.php';


$menu = DB::query("select * from modul order by `sort` ASC");

echo json_encode($menu->fetchAll());

exit;

