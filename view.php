<?php 

require 'boot.php';

$id = Request::post('view');

$viewname = DB::query("select component from menu where id=$id")->fetch();

Common::cekView($viewname['component']) ? Common::getView($viewname['component']) : Common::getView('not_authorized');

exit;