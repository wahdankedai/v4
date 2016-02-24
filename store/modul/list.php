<?php
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}


$menu = DB::query("select * from modul order by `sort` ASC");

echo json_encode($menu->fetchAll());

exit;

