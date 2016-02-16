<?php defined('ROOT') or die("Cant access This File");

$app =  Config::get('aplikasi');

$session = Common::obj($_SESSION[$app->name]);