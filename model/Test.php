<?php 
use Core\Model as Model;

class Test extends Model {
    
    public function dpa()
    {
        $dt = $this->db->query("SELECT * from dpa LIMIT 0,5");

        return json_encode($dt->fetchAll());
    }
}