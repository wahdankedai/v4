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

    public static function sanitize($data='')
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}