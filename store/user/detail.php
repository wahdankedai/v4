<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req = Request::all($_REQUEST);

if (empty($req)) {
    exit;
}

$users = DB::findAll("users_detail", $req);

for ($i=0; $i < count($users); $i++) { 
    $users[$i]->password = 'xxxxxxxx';
}
echo json_encode($users);

exit;
