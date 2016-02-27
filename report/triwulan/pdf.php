<?php
$renstra = Common::renstra();

$req = Common::obj(Request::all());

$req->tahun = ($req->tahun == '' || (! isset($req->tahun))) ? $session->tahun:  $req->tahun;
$req->skpd = ($req->skpd == '' || (! isset($req->skpd))) ? $session->kd_subunit : $req->skpd;

$htmlTemplate ='
    <table width=98% border=1 cellspacing=1 cellpadding=0>
        <tr repeat=1>
        <td align=\'center\' valign=middle rowspan=2>Kode</td>
        <td align=\'center\' valign=middle rowspan=2>Program / Kegiatan</td>
        <td align=\'center\' valign=middle rowspan=2>Indikator Kinerja Program (outcome)/Kegiatan (output)</td>
        <td align=\'center\' valign=middle rowspan=2>Satuan</td>
        <td align=\'center\' valign=middle colspan=2 rowspan=2>Target Renstra SKPD pada Tahun ' . $renstra[4] .' (Akhir Periode Renstra SKPD)</td>
        <td align=\'center\' valign=middle colspan=2 rowspan=2>Realisasi Capaian Kinerja Renstra SKPD sampai dengan Renja SKPD Tahun Lalu '. ($req->tahun - 1).'</td>
        <td align=\'center\' valign=middle colspan=2 rowspan=2>Target Kinerja dan Anggaran Renja SKPD Tahun berjalan '.$req->tahun.' yang dievaluasi</td>
        <td align=\'center\' valign=middle colspan=8>Realisasi Kinerja Pada Triwulan</td>
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
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
        <td align=\'center\'>K</td>
        <td align=\'center\'>Rp.</td>
    </tr>';




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
$p->text(0,'Periode Kegiatan  Tahun ' .$req->tahun,0,'C');
$p->SetFont('helvetica','', '5');
$p->htmltable($htmlTemplate);
$p->output(NAMA_LAPORAN, 'F');
?>