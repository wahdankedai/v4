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
            a.kd_unit,
            a.kd_sub_unit AS kode,
            Sum(b.realisasi_triwulan_1) AS realisasi_triwulan_1,
            Sum(b.realisasi_triwulan_2) AS realisasi_triwulan_2,
            Sum(b.realisasi_triwulan_3) AS realisasi_triwulan_3,
            Sum(b.realisasi_triwulan_4) AS realisasi_triwulan_4,
            bidang.nm_bidang,
            bidang.kd_urusan,
            bidang.kd_bidang
            FROM
            tabel_dpa AS a
            LEFT JOIN target_anggaran AS b ON b.tahun = a.tahun AND b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program AND b.kd_kegiatan = a.kd_kegiatan AND b.kd_unit = a.kd_unit AND b.kd_sub_unit = a.kd_sub_unit
            INNER JOIN subunit AS c ON c.kd_subunit = a.kd_sub_unit AND CONCAT(c.kd_urusan,c.kd_bidang,c.kd_unit)= a.kd_unit
            INNER JOIN bidang ON bidang.kd_urusan = a.kd_urusan AND bidang.kd_bidang = a.kd_bidang
            WHERE a.kd_unit = 0
                AND a.kd_sub_unit = 0
                AND a.kd_urusan = 0
                AND a.tahun = 0
            GROUP BY
                    a.kd_unit,
                    a.kd_urusan,
                    a.kd_bidang,
                    a.kd_sub_unit
            ORDER BY
                    a.kd_bidang ASC";


if (isset($req->kode) && $req->kode != 0) {
    $q = "SELECT
            Sum(if(a.is_perubahan = '1', a.pagu_perubahan, a.pagu_anggaran)) AS pagu_anggaran,
            a.tahun,
            a.kd_unit,
            a.kd_sub_unit AS kode,
            Sum(b.realisasi_triwulan_1) AS realisasi_triwulan_1,
            Sum(b.realisasi_triwulan_2) AS realisasi_triwulan_2,
            Sum(b.realisasi_triwulan_3) AS realisasi_triwulan_3,
            Sum(b.realisasi_triwulan_4) AS realisasi_triwulan_4,
            bidang.nm_bidang,
            bidang.kd_urusan,
            bidang.kd_bidang
            FROM
            tabel_dpa AS a
            LEFT JOIN target_anggaran AS b ON b.tahun = a.tahun AND b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program AND b.kd_kegiatan = a.kd_kegiatan AND b.kd_unit = a.kd_unit AND b.kd_sub_unit = a.kd_sub_unit
            INNER JOIN subunit AS c ON c.kd_subunit = a.kd_sub_unit AND CONCAT(c.kd_urusan,c.kd_bidang,c.kd_unit)= a.kd_unit
            INNER JOIN bidang ON bidang.kd_urusan = a.kd_urusan AND bidang.kd_bidang = a.kd_bidang
            WHERE a.kd_unit = {$req->kode} 
                AND a.kd_sub_unit = {$req->kd_subunit}
                AND a.kd_urusan = {$req->kd_urusan}
                AND a.tahun = {$session->tahun}
            GROUP BY
                    a.kd_unit,
                    a.kd_urusan,
                    a.kd_bidang,
                    a.kd_sub_unit
            ORDER BY
                    a.kd_bidang ASC";
}
// exit($q);
$qry = DB::query($q);

$skpd = $qry->fetchAll();

echo json_encode($skpd);

exit;
