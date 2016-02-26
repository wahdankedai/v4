<?php 

require 'boot.php';
require 'session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$id = Request::post('view');

if ($id == "") {
    Common::getView('not_authorized');
    exit;
}

$viewname = DB::query("select component from menu where id=$id")->fetch();

Common::cekView($viewname->component) ? Common::getView($viewname->component) : Common::getView('not_found');

exit;