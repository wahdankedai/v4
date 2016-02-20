<?php 

require '../../../boot.php';

$req = Common::obj(Request::all());

echo json_encode(Suggest::Output($req->kd_kegiatan));

exit;