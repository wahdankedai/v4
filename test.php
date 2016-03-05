<?php 

require 'boot.php';

$app =  Config::get('aplikasi');
// var_dump($app);exit;
var_dump(Suggest::checkKelebihanAnggaran($app));