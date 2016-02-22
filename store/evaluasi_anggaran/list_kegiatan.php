<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req =  Common::obj(Request::all());

$q = "SELECT
            if(a.is_perubahan = '1', a.pagu_perubahan, a.pagu_anggaran) AS pagu_anggaran,
            a.tahun,
            a.kd_unit,
            a.kd_sub_unit AS kode,
            b.target_triwulan_1,
            b.target_triwulan_2,
            b.target_triwulan_3,
            b.target_triwulan_4,
            b.realisasi_triwulan_1,
            b.realisasi_triwulan_2,
            b.realisasi_triwulan_3,
            b.realisasi_triwulan_4,
            kegiatan.kd_urusan,
            kegiatan.kd_bidang,
            kegiatan.kd_program,
            kegiatan.kd_kegiatan,
            kegiatan.nm_kegiatan
            FROM
            tabel_dpa AS a
            LEFT JOIN target_anggaran AS b ON b.tahun = a.tahun AND b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program AND b.kd_kegiatan = a.kd_kegiatan AND b.kd_unit = a.kd_unit AND b.kd_sub_unit = a.kd_sub_unit
            INNER JOIN subunit AS c ON c.kd_subunit = a.kd_sub_unit AND CONCAT(c.kd_urusan,c.kd_bidang,c.kd_unit)= a.kd_unit
            INNER JOIN kegiatan ON kegiatan.kd_urusan = a.kd_urusan AND kegiatan.kd_bidang = a.kd_bidang AND kegiatan.kd_program = a.kd_program AND kegiatan.kd_kegiatan = a.kd_kegiatan
            WHERE a.kd_unit = 0
                AND a.kd_sub_unit = 0
                AND a.kd_urusan = 0
                AND a.kd_bidang = 0
                AND a.kd_program = 0
                AND a.tahun = 0
            ORDER BY
                    a.kd_kegiatan ASCC";


if (isset($req->kode) && $req->kode != 0) {
    $q = "SELECT
            if(a.is_perubahan = '1', a.pagu_perubahan, a.pagu_anggaran) AS pagu_anggaran,
            a.tahun,
            a.kd_unit,
            a.kd_sub_unit AS kode,
            b.target_triwulan_1,
            b.target_triwulan_2,
            b.target_triwulan_3,
            b.target_triwulan_4,
            b.realisasi_triwulan_1,
            b.realisasi_triwulan_2,
            b.realisasi_triwulan_3,
            b.realisasi_triwulan_4,
            kegiatan.kd_urusan,
            kegiatan.kd_bidang,
            kegiatan.kd_program,
            kegiatan.kd_kegiatan,
            kegiatan.nm_kegiatan
            FROM
            tabel_dpa AS a
            LEFT JOIN target_anggaran AS b ON b.tahun = a.tahun AND b.kd_urusan = a.kd_urusan AND b.kd_bidang = a.kd_bidang AND b.kd_program = a.kd_program AND b.kd_kegiatan = a.kd_kegiatan AND b.kd_unit = a.kd_unit AND b.kd_sub_unit = a.kd_sub_unit
            INNER JOIN subunit AS c ON c.kd_subunit = a.kd_sub_unit AND CONCAT(c.kd_urusan,c.kd_bidang,c.kd_unit)= a.kd_unit
            INNER JOIN kegiatan ON kegiatan.kd_urusan = a.kd_urusan AND kegiatan.kd_bidang = a.kd_bidang AND kegiatan.kd_program = a.kd_program AND kegiatan.kd_kegiatan = a.kd_kegiatan
            WHERE a.kd_unit = {$req->kode} 
                AND a.kd_sub_unit = {$req->kd_subunit}
                AND a.kd_urusan = {$req->kd_urusan}
                AND a.kd_bidang = {$req->kd_bidang}
                AND a.kd_program = {$req->kd_program}
                AND a.tahun = {$session->tahun}
            ORDER BY
                    a.kd_kegiatan ASC";
}
// exit($q);
$qry = DB::query($q);

$skpd = $qry->fetchAll();

echo json_encode($skpd);

exit;
