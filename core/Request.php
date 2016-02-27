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
        $arr = empty($arr) ? $_REQUEST : $arr;
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
        $uname = $data['username'];
        $users = DB::find("users", [
            'username' => $uname ]);
        $user = Common::arr($users);
        
        unset($user['password']);

        $dt = array_merge($data, (array) $user);
        $ret;
        foreach ($dt as $key => $value) {
            // $ret[] = $value;
            $_SESSION[$app->name][$key] = $value;
        }

        $_SESSION[$app->name]["auth"] = true;
        // return $ret;
        return ($_SESSION);


    }



}