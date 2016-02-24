<?php 

require '../../../boot.php';

require '../../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$req = Common::obj(Request::all());

echo json_encode(Suggest::Output($req->kd_kegiatan));

exit;