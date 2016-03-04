<?php 

require '../../boot.php';


$d = Request::all();

if (intval($d["tahun"]) <2001) {
    http_response_code(401);exit;
}
$session = $d;
$param = $d;
unset($param["tahun"]);
$param["password"] = md5($param["password"]);

unset($session["password"]);

$f = DB::find('users', $param);

($f !== false) ? Request::writeSession($session) : http_response_code(401); 
exit;