<?php namespace Core;

use Core\Config;
use PDO;


class DB
{
    protected static $instance = null;
    final private function __construct() {}
    final private function __clone() {}
    
    /**
     * @return PDO
     */
    public static function instance() {
        if (self::$instance === null) {

            $cf = Config::get('database');

            try {
                self::$instance = new PDO(
                    'mysql:host=' . $cf->host . ';dbname=' . $cf->name,
                    $cf->user,
                    $cf->pass
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Database connection could not be established.');
            }
        }
        return self::$instance;
    }
    
    /**
     * @return PDOObject
     */
    public static function __callStatic($method, $args) {
        return call_user_func_array(array(self::instance(), $method), $args);
    }
}