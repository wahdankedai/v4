<?php 

class Request
{
     public static function get($data)
    {
        $data = isset($_GET[$data]) && $_GET[$data] != "" ? $_GET[$data] : "";

        return self::sanitize($data);
    }

     public static function post($data)
    {
        return isset($_POST[$data]) && $_POST[$data] != "" ? $_POST[$data] : "";
        return self::sanitize($data);
    }

    public static function all($arr)
    {
        foreach($arr as $key=>$value)
        {
           if(is_array($value)) $arr[$key] = self::all($value);
           else  $arr[$key] = trim(addslashes(htmlspecialchars($value)));
        }
        return $arr;
    }

    public static function sanitize($data='')
    {

        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function writeSession(array $data)
    {
        $app =  Config::get('aplikasi');
        foreach ($data as $key => $value) {
            $_SESSION[$app->name][$key] = $value;
        }

        $_SESSION[$app->name]["auth"] = true;

        return ($_SESSION);


    }



}