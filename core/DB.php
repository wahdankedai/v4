<?php

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
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Database connection could not be established.');
            }
        }
        return self::$instance;
    }

    public static function get($table='')
    {
        $dt = self::instance()->query("select * from $table");

        $result = $dt->fetchAll();
        return $result;
    }

    public static function find($table='', array $param)
    {

        $q = "select * from $table ";
        
        if (count($param) == 0) {
            $q .= "where 0=0";
        }

        if (count($param) > 0) {
            $q .= 'where '; 
            $i = 0;
            foreach ($param as $key => $value) {
                if(++$i === count($param)) {
                    $q .= $key . ' = ' .$value . ' ';
                    break;
                }
                    $q .= $key . ' = ' .$value . ' AND ';
            }            
        }

        $dt = self::instance()->query($q);

        $result = $dt->fetchAll();
        return $result;
    }
    
    /**
     * @return PDOObject
     */
    public static function __callStatic($method, $args) {
        return call_user_func_array(array(self::instance(), $method), $args);
    }
}