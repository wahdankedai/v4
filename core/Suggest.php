<?php 

class Suggest 
{
    public static function Outcome($program ='')
    {

        $result = [];

        if ($program == "" || strlen($program) !=5 || is_numeric($program) === false) {
            return $result;
        }

        $q = "SELECT * from refrensi_indikator_outcome WHERE kd_program = '$program'";
        $qry = DB::query($q);

        $result = $qry->fetchAll();
        
        return $result;
    }    
}