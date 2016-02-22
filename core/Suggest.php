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


    public function targetAnggaran($tahun = 0, $kd_urusan =0,$kd_bidang =0,$kd_program =0,$kd_kegiatan =0,$kd_unit =0, $kd_subunit =0) {
        
        $arg = func_get_args();


        $res = [
            'tahun' => '',
            'kd_urusan' => '',
            'kd_bidang' => '',
            'kd_program' => '',
            'kd_kegiatan' => '',
            'kd_unit' => '',
            'kd_sub_unit' => '',
            'target_triwulan_1' => '',
            'target_triwulan_2' => '',
            'target_triwulan_3' => '',
            'target_triwulan_4' => '',
            'realisasi_triwulan_1' => '',
            'realisasi_triwulan_2' => '',
            'realisasi_triwulan_3' => '',
            'realisasi_triwulan_4' => ''
        ];

        if ($tahun = 0 || $kd_urusan =0 ||$kd_bidang =0 ||$kd_program =0 ||$kd_kegiatan =0 ||$kd_unit =0 ||$kd_subunit =0) {
            return Common::obj($res);
        }

        $q = "SELECT * from target_anggaran WHERE 
            tahun = " . $arg[0] . " AND
            kd_urusan = " . $arg[1] . " AND
            kd_bidang = " . $arg[2] . " AND
            kd_program = " . $arg[3] . " AND
            kd_kegiatan = " . $arg[4] . " AND
            kd_unit = " . $arg[5] . " AND
            kd_sub_unit = " . $arg[6];
        // return $q;
        $qry = DB::query($q);

        $res = $qry->fetchAll();

        return empty($res) ? $res : $res[0];

    }
}

