<?php 

require '../../../boot.php';

$req = Common::obj(Request::all());

echo json_encode(Suggest::Outcome($req->kd_program));

exit;