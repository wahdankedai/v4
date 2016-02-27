<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req =  Common::obj(Request::all());

$q = "SELECT
        CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit) AS kode,
        a.nm_unit AS nama,
        sum(if(b.is_perubahan = '1', b.pagu_perubahan, b.pagu_anggaran)) as pagu_anggaran,
        sum(c.realisasi_triwulan_1) as realisasi_triwulan_1,
        sum(c.realisasi_triwulan_2) as realisasi_triwulan_2,
        sum(c.realisasi_triwulan_3) as realisasi_triwulan_3,
        sum(c.realisasi_triwulan_4) as realisasi_triwulan_4
        FROM
        unit AS a
        INNER JOIN tabel_dpa AS b ON CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit) = b.kd_unit
        LEFT JOIN target_anggaran AS c ON c.kd_sub_unit = b.kd_sub_unit AND c.kd_unit = b.kd_unit AND c.kd_kegiatan = b.kd_kegiatan AND c.kd_program = b.kd_program AND c.kd_bidang = b.kd_bidang AND c.kd_urusan = b.kd_urusan AND c.tahun = b.tahun
        WHERE b.tahun = {$session->tahun}
        GROUP BY CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit)
        ORDER BY
        kode ASC";


if (isset($req->kode) && $req->kode != 0 && ! isset($req->kd_subunit)) {
    $q = "SELECT
        CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit) AS kode,
        a.nm_unit AS nama,
        sum(if(b.is_perubahan = '1', b.pagu_perubahan, b.pagu_anggaran)) as pagu_anggaran,
        sum(c.realisasi_triwulan_1) as realisasi_triwulan_1,
        sum(c.realisasi_triwulan_2) as realisasi_triwulan_2,
        sum(c.realisasi_triwulan_3) as realisasi_triwulan_3,
        sum(c.realisasi_triwulan_4) as realisasi_triwulan_4
        FROM
        unit AS a
        INNER JOIN tabel_dpa AS b ON CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit) = b.kd_unit
        LEFT JOIN target_anggaran AS c ON c.kd_sub_unit = b.kd_sub_unit AND c.kd_unit = b.kd_unit AND c.kd_kegiatan = b.kd_kegiatan AND c.kd_program = b.kd_program AND c.kd_bidang = b.kd_bidang AND c.kd_urusan = b.kd_urusan AND c.tahun = b.tahun
        WHERE b.tahun = {$session->tahun} AND CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit) = $req->kode 
        GROUP BY CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit)
        ORDER BY
        kode ASC";
}

if (isset($req->kode) && $req->kode != 0 && isset($req->kd_subunit)) {
    $q = "SELECT
        CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit) AS kode,
        a.nm_unit AS nama,
        sum(if(b.is_perubahan = '1', b.pagu_perubahan, b.pagu_anggaran)) as pagu_anggaran,
        sum(c.realisasi_triwulan_1) as realisasi_triwulan_1,
        sum(c.realisasi_triwulan_2) as realisasi_triwulan_2,
        sum(c.realisasi_triwulan_3) as realisasi_triwulan_3,
        sum(c.realisasi_triwulan_4) as realisasi_triwulan_4
        FROM
        unit AS a
        INNER JOIN tabel_dpa AS b ON CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit) = b.kd_unit
        LEFT JOIN target_anggaran AS c ON c.kd_sub_unit = b.kd_sub_unit AND c.kd_unit = b.kd_unit AND c.kd_kegiatan = b.kd_kegiatan AND c.kd_program = b.kd_program AND c.kd_bidang = b.kd_bidang AND c.kd_urusan = b.kd_urusan AND c.tahun = b.tahun
        WHERE b.tahun = {$session->tahun} AND CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit) = $req->kode AND CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit,a.kd_subunit) = $req->kd_subunit
        GROUP BY CONCAT(a.kd_urusan,a.kd_bidang,a.kd_unit)
        ORDER BY
        kode ASC";
}

$qry = DB::query($q);

$skpd = $qry->fetchAll();

echo json_encode($skpd);

exit;
