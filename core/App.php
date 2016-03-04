<?php 

class App 
{
    public static function redirectTo($page='')
    {
        return header('Location: ' . BASE_URL . $page . '.php');
    }    
    public static function filterUserOrganisasi($role ='', $satker = '0000000', $mode = '')
    {
        // return $satker . $role;
        $param = "";

        if ($role == '') {
            $param .= "kode : 0";
        }

        else if ($role == 'adminskpd' || $role == 'userskpd' || $role == 'adminkecamatan'  || $role == 'userkecamatan' ) {
            $param .= "kode : " . substr($satker, 0, 5);
        }

        if ($mode == 'prefix') {
            $param = ', ' . $param;
        }
        
        if ($mode == 'suffix') {
            $param .= ' , ';
        }

        return $param;
    }   

    public static function filterUserSubOrganisasi($role ='', $satker = '0000000', $mode = '')
    {

        $param = "";

        if ($role == '') {
            $param .= "kd_subunit : 0";
        }

        else if ($role == 'admin'  || $role == 'adminskpd'  || $role == 'adminkecamatan' ) {
            $param .= "kd_subunit : '01'";
        }

        else if ($role == 'userskpd'  || $role == 'userkecamatan' ) {
            $param .= "kd_subunit : " . substr($satker, -2);
        }

        if ($mode == 'prefix') {
            $param = ', ' . $param;
        }
        
        if ($mode == 'suffix') {
            $param .= ' , ';
        }

        return $param;
    }

    public static function filterReportUser($role ='', $satker = '0000000', $mode = '')
    {

        $param = "";

        if ($role == '') {
            $param .= "kd_subunit : 0";
        }

        else if ($role == 'adminskpd'  || $role == 'adminkecamatan' ) {
            $param .= "kd_subunit : " . substr($satker, 0, 5);
        }

        else if ($role == 'userskpd'  || $role == 'userkecamatan' ) {
            $param .= "kd_subunit : " . $satker;
        }

        if ($mode == 'prefix') {
            $param = ', ' . $param;
        }
        
        if ($mode == 'suffix') {
            $param .= ' , ';
        }

        return $param;
    }
}