<?php namespace Core;

use PDO;
use Core\DB;

class Model {

    protected $db;

    protected $table = '';

    public function __construct() {
            $this->db = DB::instance();
    }

    
}
