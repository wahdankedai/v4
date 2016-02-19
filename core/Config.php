<?php

class Config {
    static protected $config;

    final private function __construct() {}
    final private function __clone() {}

    public static function get($config= NULL)
    {
        if ($config == NULL) 
        {
            return new stdObject();
        }

        self::$config = require ROOT . DS . 'config' . DS . $config . EXT;

        return json_decode(json_encode(self::$config));
    }

    public static function put($config = NULL, array $data)
    {
        $filename = ROOT . DS . 'config' . DS . $config . EXT;
        $data = var_export($data, true);
        file_put_contents($filename, "<?php return $data;");
    }
}