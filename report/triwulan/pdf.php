<?php
$renstra = Common::renstra();

$req = Common::obj(Request::all());

$req->tahun = ($req->tahun == '' || (! isset($req->tahun))) ? $session->tahun:  $req->tahun;
$req->skpd = ($req->skpd == '' || (! isset($req->skpd))) ? $session->kd_subunit : $req->skpd;
$req->triwulan = ($req->triwulan == '' || (! isset($req->triwulan))) ? 1 : $req->triwulan;


$req->sebelumnya == $req->tahun -1;

if ($renstra[0] == $req->tahun) {
    $req->sebelumnya == 0;
}

$nomor = 0;

$htmlTemplate ='
    <table width=98% border=1 cellspacing=1 cellpadding=0>
        <tr repeat=1>
        <td align=\'center\' valign=middle rowspan=2>No</td>
        <td align=\'center\' valign=middle rowspan=2>Kode</td>
        <td align=\'center\' valign=middle rowspan=2>Program / Kegiatan</td>
        <td align=\'center\' valign=middle rowspan=2>Indikator Kinerja Program (outcome)/Kegiatan (output)</td>
        <td align=\'center\' valign=middle colspan=2 rowspan=2>Target Renstra SKPD pada Tahun ' . $renstra[4] .' (Akhir Periode Renstra SKPD)</td>
        <td align=\'center\' valign=middle colspan=2 rowspan=2>Realisasi Capaian Kinerja Renstra SKPD sampai dengan Renja SKPD Tahun Lalu '. ($req->tahun - 1).'</td>
        <td align=\'center\' valign=middle colspan=2 rowspan=2>Target Kinerja dan Anggaran Renja SKPD Tahun berjalan '.$req->tahun.' yang dievaluasi</td>
        <td align=\'center\' valign=middle colspan=8>Realisasi Kinerja Pada Triwulan </td>
        <td align=\'center\' valign=middle colspan=2 rowspan=2>Realisasi Capaian Kinerja dan Anggaran Renja SKPD yang dievaluasi (Tahun '.$req->tahun.')</td>
        <td align=\'center\' colspan=2 rowspan=2>Tingkat Capaian Kinerja dan Anggaran Renja SKPD yang dievaluasi (%) Tahun '.$req->tahun.'</td>       
        <td align=\'center\' valign=middle colspan=2 rowspan=2>Realisasi Kinerja dan Anggaran Renstra SKPD s/d tahun 2015 (Akhir Tahun Pelaksanaan Renja SKPD)</td>
        <td align=\'center\' valign=middle colspan=2 rowspan=2>Tingkat Capaian Kinerja Dan Realisasi Anggaran Renstra SKPD s/d tahun 2015 (%)</td>
        <td align=\'center\' valign=middle rowspan=2>unit SKPD Penanggung Jawab</td>
        <td align=\'center\' valign=middle rowspan=2>Ket.</td>
    </tr>
    <tr repeat=1>
        <td valign=middle align=\'center\' colspan=2>I</td>
        <td valign=middle align=\'center\' colspan=2>II</td>
        <td valign=middle align=\'center\' colspan=2>III</td>
        <td valign=middle align=\'center\' colspan=2>IV</td>
    </tr>
    <tr repeat=1>
        <td align=\'center\' rowspan=2>1</td>
        <td align=\'center\' rowspan=2>2</td>
        <td align=\'center\' rowspan=2>3</td>
        <td align=\'center\' rowspan=2>4</td>
        <td align=\'center\' colspan=2>5</td>
        <td align=\'center\' colspan=2>6</td>
        <td align=\'center\' colspan=2>7</td>
        <td align=\'center\' colspan=2>8</td>
        <td align=\'center\' align=\'center\' colspan=2>9</td>
        <td align=\'center\' colspan=2>10</td>
        <td align=\'center\' colspan=2>11</td>
        <td align=\'center\' colspan=2>12</td>
        <td align=\'center\' colspan=2>13</td>
        <td align=\'center\' colspan=2>14</td>
        <td align=\'center\' colspan=2>15</td>
        <td align=\'center\' rowspan=2>16</td>
        <td align=\'center\' rowspan=2>17</td>
    </tr>
    <tr repeat=1>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp. (ribuan)</td>
    </tr>';

/**
 * data kegiatan administrasi umum (rutin)
 */

$query_program_adum = DB::query("SELECT
        a.tahun,
        program.nm_program,
        program.kd_program,
        program.kd_urusan,
        program.kd_bidang,
        sum(if(a.is_perubahan = 1,a.pagu_perubahan,a.pagu_anggaran)) as pagu
        FROM
        tabel_dpa AS a
        INNER JOIN program ON program.kd_urusan = a.kd_urusan AND program.kd_bidang = a.kd_bidang AND program.kd_program = a.kd_program
        WHERE
        CONCAT(a.kd_unit,kd_sub_unit) = {$req->skpd} AND
        a.tahun = {$req->tahun}  AND
        a.kd_program < 15
        GROUP BY a.kd_urusan, a.kd_bidang, a.kd_program");
$result_program_adum = $query_program_adum->fetchAll();


foreach ($result_program_adum as $value_program_adum) {
    $nomor++;

    $query_indikator_outcome = DB::query("SELECT
        a.id,
        a.kd_unit,
        a.kd_subunit,
        a.kd_program,
        a.indikator,
        a.satuan,
        b.nm_satuan
        FROM
        indikator_outcome_program AS a
        INNER JOIN satuan AS b ON b.id = a.satuan
        WHERE a.kd_unit = " . substr($req->skpd,0,5) . "
            AND a.kd_subunit =  " .substr($req->skpd,-2) ." 
            AND a.kd_program = " . $value_program_adum->kd_urusan . $value_program_adum->kd_bidang . $value_program_adum->kd_program . "
    ORDER BY
            a.id ASC");

    $result_indikator_outcome = $query_indikator_outcome->fetchAll();

    $rowspan_indikator_outcome = count($result_indikator_outcome) > 1 ? "rowspan=" . count($result_indikator_outcome) : "";



    $htmlTemplate .= '<tr>
        <td ' . $rowspan_indikator_outcome .' align=\'center\'>' .$nomor.'</td>
        <td ' . $rowspan_indikator_outcome .' align=\'left\'> '
            . $value_program_adum->kd_urusan
            . '.' . $value_program_adum->kd_bidang
            . '.' . $value_program_adum->kd_program
        .'</td>
        <td ' . $rowspan_indikator_outcome .' align=\'left\'>'. $value_program_adum->nm_program .'</td>
        <td align=\'left\'>' . $result_indikator_outcome[0]->indikator . ' (' . $result_indikator_outcome[0]->nm_satuan .')</td>
        <td align=\'right\'></td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'></td>
        <td align=\'right\'>7</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>8</td>
        <td align=\'right\'>9</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>' . Common::ribuan($value_program_adum->pagu) .'</td>
        <td align=\'right\'>11</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>12</td>
        <td align=\'right\'>13</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>14</td>
        <td align=\'right\'>15</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>5</td>
        <td align=\'right\'>6</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>7</td>
        <td align=\'right\'>8</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>9</td>
        <td align=\'right\'>10</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>11</td>
        <td align=\'right\'>12</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>13</td>
        <td align=\'right\'>14</td>
        <td ' . $rowspan_indikator_outcome .' align=\'right\'>15</td>
        <td ' . $rowspan_indikator_outcome .' align=\'center\'>16</td>
        <td ' . $rowspan_indikator_outcome .' align=\'center\'>17</td>
    </tr>';
}

/**
 * query urusan
 */

$query_urusan = DB::query("SELECT
        a.tahun,
        urusan.nm_urusan,
        a.kd_urusan
        FROM
        tabel_dpa AS a
        INNER JOIN urusan ON urusan.kd_urusan = a.kd_urusan
        WHERE
        CONCAT(a.kd_unit,kd_sub_unit) = {$req->skpd} AND
        a.tahun = {$req->tahun}
        GROUP BY a.kd_urusan");


$result_urusan = $query_urusan->fetchAll();

foreach ($result_urusan as $value_urusan) {
    $htmlTemplate .= '<tr>
        <td align=\'center\'></td>
        <td align=\'left\'>' . $value_urusan->kd_urusan .'</td>
        <td align=\'left\' colspan=26>' . $value_urusan->nm_urusan .'</td>
    </tr>';

    $query_bidang = DB::query("SELECT
            a.tahun,
            bidang.kd_bidang,
            bidang.nm_bidang
            FROM
            tabel_dpa AS a
            INNER JOIN bidang ON bidang.kd_urusan = a.kd_urusan AND bidang.kd_bidang = a.kd_bidang
            WHERE
                    CONCAT(a.kd_unit,kd_sub_unit) = {$req->skpd} AND
                    a.tahun = {$req->tahun} AND 
                    a.kd_urusan = {$value_urusan->kd_urusan} AND
                    a.kd_program > 14
            GROUP BY a.kd_urusan,a.kd_bidang");

    $result_bidang = $query_bidang->fetchAll();

    foreach ($result_bidang as $value_bidang) {
        $htmlTemplate .= '<tr>
            <td align=\'center\'></td>
            <td align=\'left\'>' . $value_urusan->kd_urusan . '.' .$value_bidang->kd_bidang .'</td>
            <td align=\'left\' colspan=26>' . $value_bidang->nm_bidang .'</td>
        </tr>';
    }
}






/**
 * 
 */
require_once('library/lib/fpdf.inc.php');
require_once('library/lib/pdftable.inc.php');
require_once('library/lib/pdf.inc.php');
require_once('library/lib/color.inc.php');
require_once('library/lib/htmlparser.inc.php');



$p = new PDF();  
$p->SetMargins(20,10,10);
$p->AddPage();
$p->setStyle('small');
$p->text(0,'Formulir Evaluasi Hasil Renja SKPD',0,'C');
$p->text(0,'SKPD '. Suggest::getSatker($req->skpd) , 0,'C');
$p->text(0,'Periode Kegiatan  Tahun ' .$req->tahun . ' ' . Common::textTriwulan($req->triwulan) ,0,'C');
$p->SetFont('helvetica','', '5');
$p->htmltable($htmlTemplate);
$p->output(NAMA_LAPORAN, 'F');
?>