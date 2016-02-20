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

    public static function Output($kegiatan ='')
    {

        $result = [];

        if ($kegiatan == "" || strlen($kegiatan) !=7 || is_numeric($kegiatan) === false) {
            return $result;
        }

        $q = "SELECT * from refrensi_indikator_output WHERE kd_kegiatan = '$kegiatan'";
        $qry = DB::query($q);

        $result = $qry->fetchAll();
        
        return $result;
    }

    public function targetOutcome($id='')
    {
        $res = [
            "id" => "",
            "target_triwulan_1" => "",
            "target_triwulan_2" => "",
            "target_triwulan_3" => "",
            "target_triwulan_4" => "",
            "realisasi_triwulan_1" => "",
            "realisasi_triwulan_2" => "",
            "realisasi_triwulan_3" => "",
            "realisasi_triwulan_4" => ""
        ];

        if ($id == '') {
            return Common::obj($res);
        }

        $q = "SELECT * from target_indikator_outcome WHERE id = {$id}";

        $qry = DB::query($q);

        $res = $qry->fetchAll();

        return $res[0];
    }

    public function targetOutput($id='')
    {
        $res = [
            "id" => "",
            "target_triwulan_1" => "",
            "target_triwulan_2" => "",
            "target_triwulan_3" => "",
            "target_triwulan_4" => "",
            "realisasi_triwulan_1" => "",
            "realisasi_triwulan_2" => "",
            "realisasi_triwulan_3" => "",
            "realisasi_triwulan_4" => ""
        ];

        if ($id == '') {
            return Common::obj($res);
        }

        $q = "SELECT * from target_indikator_output WHERE id = {$id}";

        $qry = DB::query($q);

        $res = $qry->fetchAll();

        return $res[0];
    }

    public static function checkTargetOutcome($id='')
    {
        if ($id == '' || intval($id) < 1) {
            return true;
        }

        $q = "SELECT count(id) as jml from target_indikator_outcome where id_indikator = {$id}";
        $qry = DB::query($q);

        $res = $qry->fetchAll();
        return $res[0]->jml > 0 ? true : false;
        
    }    
}
