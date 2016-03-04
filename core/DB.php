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
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
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
        $q = self::_buildFind($table, $param);
        // return $q;
        $dt = self::instance()->query($q);

       
        $result = $dt->fetch();
        return $result;
    }

    public static function findAll($table='', array $param)
    {

        $q = self::_buildFind($table, $param);
        // return $q;
        $dt = self::instance()->query($q);
        $result = $dt->fetchAll();
        return $result;
    }

    public static function _buildFind($table = '', array $param)
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
                    $q .= $key . ' = \'' .$value . '\' ';
                    break;
                }
                    $q .= $key . ' = \'' .$value . '\' AND ';
            }            
        }

        return $q;

    }


    public static function insert($table='', array $param)
    {
        if (count($param) == 0) {
            return false;
        }
        
        $q = "insert into $table ";
        

        if (count($param) > 0) {
            $k = '('; 
            $v = "";
            $i = 0;
            foreach ($param as $key => $value) {
                if(++$i === count($param)) {
                    $k .= '`' . $key . '`) VALUES (';
                    $v .=  "'$value' )";
                    break;
                }
                    $k .= '`' . $key . '`, ';
                    $v .=  "'$value', ";
            }            
        }

        $q .= $k . $v;
        // return $q;

        try {
            $dt = self::instance()->query($q);
            return true;
            
        } catch (Exception $e) {
            return false;
        }
        
    }

    public static function insertIgnore($table='', array $param)
    {
        if (count($param) == 0) {
            return false;
        }
        
        $q = "insert ignore into $table ";
        

        if (count($param) > 0) {
            $k = '('; 
            $v = "";
            $i = 0;
            foreach ($param as $key => $value) {
                if(++$i === count($param)) {
                    $k .= '`' . $key . '`) VALUES (';
                    $v .=  "'$value' )";
                    break;
                }
                    $k .= '`' . $key . '`, ';
                    $v .=  "'$value', ";
            }            
        }

        $q .= $k . $v;
        // return $q;

        try {
            $dt = self::instance()->query($q);
            return true;
            
        } catch (Exception $e) {
            return false;
        }
        
    }

    public static function update($table='',array $where, array $field)
    {
        if (count($field) == 0 || count($where) == 0) {
            return false;
        }
        
        $q = "UPDATE $table SET ";
        

        if (count($field) > 0) {
            $k = ''; 
            $i = 0;
            foreach ($field as $key => $value) {
                if(++$i === count($field)) {
                    $k .= "`" . $key . "` = " . "'{$value}'";
                    break;
                }
                    $k .= "`" . $key . "` = " . "'{$value}'" . ",";
            }            
        }

        if (count($where) > 0) {
            $v = ' WHERE '; 
            $i = 0;
            foreach ($where as $key => $value) {
                if(++$i === count($where)) {
                    $v .= "`" . $key . "` = " . "'{$value}'";
                    break;
                }
                    $v .= "`" . $key . "` = " . "'{$value}'" . " AND ";
            }            
        }

        $q .= $k . $v;
        // return $q;

        try {
            $dt = self::instance()->query($q);
            return true;
            
        } catch (Exception $e) {
            return false;
        }
        
    }

    public static function addOrNewRekening($table='', array $param)
    {
        if (count($param) == 0) {
            return false;
        }
        
        $q = "insert into $table ";
        

        if (count($param) > 0) {
            $k = '('; 
            $v = "";
            $w = " ON DUPLICATE KEY UPDATE ";
            $i = 0;


            foreach ($param as $key => $value) {

                if ($key == "nm_$table") {
                      $w .=  '`' . $key . '` =  VALUES(' . $key . ')';
                }


                if(++$i === count($param)) {
                    $k .= '`' . $key . '`) VALUES (';
                    $v .=  "'$value' )";
                    break;
                }
                    $k .= '`' . $key . '`, ';
                    $v .=  "'$value', ";

            }

        }



        $q .= $k . $v . $w;
        // return $q;
        try {
            $dt = self::instance()->query($q);
            return true;
            
        } catch (Exception $e) {
            return false;
        }
    }



    public static function delete($table='', $param)
    {
        if (count($param) == 0) {
            return false;
        }

        $q = "DELETE FROM $table WHERE ";
        $i = 0;
        foreach ($param as $key => $value) {
            if(++$i == count($param)) {
                $q .= $key . " = '" . $value . "'";
                break;
            }
                $q .= $key . " = '" . $value . "' AND ";
        }
        // return $q;

        try {
            $dt = self::instance()->query($q);
            return true;
            
        } catch (Exception $e) {
            return false;
        }

    }
    
    /**
     * @return PDOObject
     */
    public static function __callStatic($method, $args) {
        return call_user_func_array(array(self::instance(), $method), $args);
    }
}