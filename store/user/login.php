<?php 

require '../../boot.php';

$req = $_REQUEST;
$d = Request::all($req);
$session = $d;
$param = $d;
unset($param["tahun"]);
$param["password"] = md5($param["password"]);

unset($session["password"]);

$f = DB::find('users', $param);

$f !== false ? Request::writeSession($session) : http_response_code(401); 
exit;