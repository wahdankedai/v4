<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$modul = Request::post('modul');

if ($modul == "") {

    echo json_encode([]); 
    exit;   
}

$menu = DB::query("select * from menu where modul_id = $modul and published=1 order by `sort` ASC");

$tree = Common::buildTree($menu->fetchAll());
echo json_encode($tree);