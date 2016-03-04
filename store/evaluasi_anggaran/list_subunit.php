<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req =  Common::obj(Request::all());

$q = "SELECT
        Sum(if(a.is_perubahan = '1', a.pagu_perubahan, a.pagu_anggaran)) AS pagu_anggaran,
        a.tahun,
        c.nm_subunit as nama,
        a.kd_unit,
        a.kd_sub_unit as kd_subunit,
        sum(b.realisasi_triwulan_1) as realisasi_triwulan_1,
        sum(b.realisasi_triwulan_2) as realisasi_triwulan_2,
        sum(b.realisasi_triwulan_3) as realisasi_triwulan_3,
        sum(b.realisasi_triwulan_4) as realisasi_triwulan_4
        FROM
        tabel_dpa AS a
        LEFT JOIN target_anggaran AS b ON b.tahun = a.tahun AND b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program AND b.kd_kegiatan = a.kd_kegiatan AND b.kd_unit = a.kd_unit AND b.kd_sub_unit = a.kd_sub_unit
        INNER JOIN subunit AS c ON c.kd_subunit = a.kd_sub_unit AND CONCAT(c.kd_urusan,c.kd_bidang,c.kd_unit) = a.kd_unit
        WHERE a.kd_unit = 0
            AND a.tahun = 0
        GROUP BY
        a.kd_unit,
        a.kd_sub_unit
        ORDER BY
        a.kd_sub_unit ASC";


if (isset($req->kode) && $req->kode != 0 && isset($req->kd_subunit)) {
    $q = "SELECT
        Sum(if(a.is_perubahan = '1', a.pagu_perubahan, a.pagu_anggaran)) AS pagu_anggaran,
        a.tahun,
        c.nm_subunit as nama,
        a.kd_unit,
        a.kd_sub_unit as kd_subunit,
        sum(b.realisasi_triwulan_1) as realisasi_triwulan_1,
        sum(b.realisasi_triwulan_2) as realisasi_triwulan_2,
        sum(b.realisasi_triwulan_3) as realisasi_triwulan_3,
        sum(b.realisasi_triwulan_4) as realisasi_triwulan_4
        FROM
        tabel_dpa AS a
        LEFT JOIN target_anggaran AS b ON b.tahun = a.tahun AND b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program AND b.kd_kegiatan = a.kd_kegiatan AND b.kd_unit = a.kd_unit AND b.kd_sub_unit = a.kd_sub_unit
        INNER JOIN subunit AS c ON c.kd_subunit = a.kd_sub_unit AND CONCAT(c.kd_urusan,c.kd_bidang,c.kd_unit) = a.kd_unit
        WHERE a.kd_unit = {$req->kode} 
            AND a.kd_sub_unit = {$req->kd_subunit} 
            AND a.tahun = {$session->tahun}
        GROUP BY
        a.kd_unit,
        a.kd_sub_unit
        ORDER BY
        a.kd_sub_unit ASC";
}

$qry = DB::query($q);

$skpd = $qry->fetchAll();

echo json_encode($skpd);

exit;
