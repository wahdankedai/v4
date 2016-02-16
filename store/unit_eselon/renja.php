<?php
ini_set("display_errors", 0);
session_start();
ini_set('error_reporting', E_ALL);
include ("../function.php");
$var_thn_report = isset($_GET['thn']) ? $_GET['thn'] : 2015;
$var_thn_lalu = $var_thn_report -1;
$var_skpd_report = $_SESSION['auth']['skpd'];
$var_skpd = get_detil_skpd($var_skpd_report);
$bappeko = get_detil_skpd('1060101');
$skpd_nama = $var_skpd['nama'];
$skpd_nip = $var_skpd['nip'];
$skpd_pangkat = $var_skpd['pangkat'];
$skpd_kepala = $var_skpd['kepala'];
$user_login = $_SESSION['auth']['nama'];
$var_tb = isset($_GET['tb']) ? $_GET['tb'] : 1;

function prosen($data)
{
	return number_format($data, 2, ',', '.');
}
function rerata($a)
{
	$b = array_sum($a) / count($a);
	return number_format($b, 2, ',', '.');
}
function predikat ($a) {
  
  if ($a <= 50) {
    return 'Sangat Rendah';
  }  else if ($a <= 65) {
    return 'Rendah';
  }  else if ($a <= 75) {
    return 'Sedang';
  }  else if ($a <= 90) {
    return 'Tinggi';
  }  else if ($a <= 100) {
    return 'Sangat Tinggi';
  } else {
    return '';
  }
}

$rco = array();
$rca = array();
$rrro = array();
$rrra = array();

switch ($var_thn_report) {
    case 2013:
        $pembagi = 1;
        break;
	case 2014:
		$pembagi = 2;
		break;
	case 2015:
		$pembagi = 3;
		break;
	case 2016:
		$pembagi = 4;
		break;
	case 2017:
		$pembagi = 5;
		break;
}

/*
	Query Disini
*/
	$query = mysql_query("SELECT 
				dpa.kd_urusan, 
				outcome.indikator, 
				sum(target_anggaran.tb4) as tatb4, 
				satuan.satuan, 
				dpa.kd_bidang, 
				dpa.kd_prog, 
				dpa.nm_prog, 
				outcome.target_tb1 as totb1, 
				outcome.target_tb2 as totb2, 
				outcome.target_tb3 as totb3, 
				outcome.target_tb4 as totb4, 
				outcome.real_tb1 as rotb1, 
				outcome.real_tb2 as rotb2, 
				outcome.real_tb3 as rotb3, 
				outcome.real_tb4 as rotb4, 
				dpa.kode,
				dpa.thn,
				outcome.renstra as tor, 
				outcome.realisasi_renstra as ror, 
				sum(target_anggaran.tb1) as tatb1, 
				sum(target_anggaran.tb2) as tatb2, 
				sum(target_anggaran.tb3) as tatb3, 
				sum(target_anggaran.tb4) as tatb4, 
				sum(target_anggaran.realisasi_tb1) as ratb1, 
				sum(target_anggaran.realisasi_tb2) as ratb2, 
				sum(target_anggaran.realisasi_tb3) as ratb3, 
				sum(target_anggaran.realisasi_tb4) as ratb4, 
				sum(dpa.jml_pagu) as pagu,
				sum(target_anggaran.renstra) as tar, 
				sum(target_anggaran.realisasi_renstra) as rar 
				FROM 
				dpa 
				LEFT JOIN outcome ON outcome.kd_bidang = dpa.kd_bidang AND  outcome.kd_program = dpa.kd_prog AND outcome.kd_skpd = dpa.kode AND outcome.thn = dpa.thn 
				LEFT JOIN target_anggaran ON target_anggaran.id_dpa = dpa.id 
				INNER JOIN satuan ON satuan.id = outcome.satuan 
				where  dpa.kode={$var_skpd_report} and dpa.thn={$var_thn_report}
				GROUP BY 
				dpa.kd_urusan, 
				dpa.kd_bidang, 
				dpa.kd_prog, 
				dpa.kode, 
				dpa.thn 
	");
	

/* plugins fpdf */
	$rootpath = $_SERVER['DOCUMENT_ROOT']."/include/report/"; // rubah, disesuaikan dengan path document berada

	define('FPDF_FONTPATH','./pdf/font/');
	
	require_once('./pdf/lib/fpdf.inc.php');
	require_once('./pdf/lib/pdftable.inc.php');
	require_once('./pdf/lib/pdf.inc.php');
	require_once('./pdf/lib/color.inc.php');
	require_once('./pdf/lib/htmlparser.inc.php');
	
	
	
	$htmlTemplate ='
	<table width="98%" border="1" cellspacing="1" cellpadding="0">
		<tr repeat=1>
		<td align="center" valign="middle" rowspan="2">Kode</td>
		<td align="center" valign="middle" rowspan="2">Program / Kegiatan</td>
		<td align="center" valign="middle" rowspan="2">Indikator Kinerja Program (outcome)/Kegiatan (output)</td>
		<td align="center" valign="middle" rowspan="2">Satuan</td>
		<td align="center" valign="middle" colspan="2" rowspan="2">Target Renstra SKPD pada Tahun 2015 (Akhir Periode Renstra SKPD)</td>
		<td align="center" valign="middle" colspan="2" rowspan="2">Realisasi Capaian Kinerja Renstra SKPD sampai dengan Renja SKPD Tahun Lalu '.$var_thn_lalu.'</td>
		<td align="center" valign="middle" colspan="2" rowspan="2">Target Kinerja dan Anggaran Renja SKPD Tahun berjalan '.$var_thn_report.' yang dievaluasi</td>
		<td align="center" valign="middle" colspan="8">Realisasi Kinerja Pada Triwulan</td>
		<td align="center" valign="middle" colspan="2" rowspan="2">Realisasi Capaian Kinerja dan Anggaran Renja SKPD yang dievaluasi (Tahun '.$var_thn_report.')</td>
		<td align="center" colspan="2" rowspan="2">Tingkat Capaian Kinerja dan Anggaran Renja SKPD yang dievaluasi (%) Tahun '.$var_thn_report.'</td>		
		<td align="center" valign="middle" colspan="2" rowspan="2">Realisasi Kinerja dan Anggaran Renstra SKPD s/d tahun 2015 (Akhir Tahun Pelaksanaan Renja SKPD)</td>
		<td align="center" valign="middle" colspan="2" rowspan="2">Tingkat Capaian Kinerja Dan Realisasi Anggaran Renstra SKPD s/d tahun 2015 (%)</td>
		<td align="center" valign="middle" rowspan="2">unit SKPD Penanggung Jawab</td>
		<td align="center" valign="middle" rowspan="2">Ket.</td>
	</tr>
	<tr repeat=1>
		<td valign="middle" align="center" colspan="2">I</td>
		<td valign="middle" align="center" colspan="2">II</td>
		<td valign="middle" align="center" colspan="2">III</td>
		<td valign="middle" align="center" colspan="2">IV</td>
	</tr>
	<tr repeat=1>
		<td align="center" rowspan="2">1</td>
		<td align="center" rowspan="2">2</td>
		<td align="center" rowspan="2">3</td>
		<td align="center" rowspan="2">4</td>
		<td align="center" colspan="2">5</td>
		<td align="center" colspan="2">6</td>
		<td align="center" colspan="2">7</td>
		<td align="center" colspan="2">8</td>
		<td align="center" align="center" colspan="2">9</td>
		<td align="center" colspan="2">10</td>
		<td align="center" colspan="2">11</td>
		<td align="center" colspan="2">12</td>
		<td align="center" colspan="2">13</td>
		<td align="center" colspan="2">14</td>
		<td align="center" colspan="2">15</td>
		<td align="center" rowspan="2">16</td>
		<td align="center" rowspan="2">17</td>
	</tr>
	<tr repeat=1>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
		<td align="center">K</td>
		<td align="center">Rp.</td>
	</tr>';
	while ($row=mysql_fetch_assoc($query))
	{
		$aq_check = mysql_query("SELECT count(outcome.id) as jml 
				from outcome 
				INNER JOIN satuan ON satuan.id = outcome.satuan
				where 
				outcome.kd_bidang=".$row['kd_bidang']." and 
				outcome.kd_program=".$row['kd_prog']." and 
				outcome.kd_skpd=".$row['kode']." 
				and outcome.thn=".$row['thn']);
		$ahasil = mysql_fetch_array($aq_check);	
		$jml_indi = $ahasil['jml'];	
		if ($var_tb == 1)
		{
			$rto =  $row['rotb1'];
			$rotb1 =  $row['rotb1'];
			$rotb2 =  0;
			$rotb3 =  0;
			$rotb4 =  0;
			$rta =  $row['ratb1'] / $jml_indi;
			$ratb1 = $row['ratb1'] / $jml_indi;
			$ratb2 = 0;
			$ratb3 = 0;
			$ratb4 = 0;

			$co = $row['totb4'] == 0 ? 0 : ($rto/$row['totb4']) * 100;
			$ca = $row['pagu'] == 0 ? 0 : ($rta/$row['pagu']) * 100;
			$rro = $row['ror'] + $rto;
			$rra = $row['rar'] + $rta;
			$cro = $row['tor'] == 0 ? 0 : ($rro/$row['tor']) * 100;
			$cra = $row['tar'] == 0 ? 0 : ($rra/$row['tar']) * 100;
		}
		else if ($var_tb == 2)
		{
			$rto =  $row['rotb2'];
			$rotb1 =  $row['rotb1'];
			$rotb2 =  $row['rotb2'] - ($row['rotb1']);
			$rotb3 =  0;
			$rotb4 =  0;
			$rta =  ($row['ratb2'])  / $jml_indi;
			$ratb1 = $row['ratb1'] / $jml_indi;
			$ratb2 = ($row['ratb2'] - $row['ratb1'] ) / $jml_indi;
			$ratb3 = 0;
			$ratb4 = 0;

			$co = $row['totb4'] == 0 ? 0 : ($rto/$row['totb4']) * 100;
			$ca = $row['pagu'] == 0 ? 0 : ($rta/$row['pagu']) * 100;
			$rro = $row['ror'] + $rto;
			$rra = $row['rar'] + $rta;
			$cro = $row['tor'] == 0 ? 0 : ($rro/$row['tor']) * 100;
			$cra = $row['tar'] == 0 ? 0 : ($rra/$row['tar']) * 100;
		}
		else if ($var_tb == 3)
		{
			$rto =  $row['rotb3'];
			$rotb1 =  $row['rotb1'];
			$rotb2 =  $row['rotb2'] - ($row['rotb1']);
			$rotb3 =  $row['rotb3'] - ($row['rotb2']);
			$rotb4 =  0;
			$rta =  ($row['ratb3'])  / $jml_indi;
			$ratb1 = $row['ratb1']  / $jml_indi;
			$ratb2 = ($row['ratb2'] - $row['ratb1']) / $jml_indi;
			$ratb3 = ($row['ratb3']  - $row['ratb2'] - $row['ratb1'])  / $jml_indi;
			$ratb4 = 0;

			$co = $row['totb4'] == 0 ? 0 : ($rto/$row['totb4']) * 100;
			$ca = $row['pagu'] == 0 ? 0 : ($rta/$row['pagu']) * 100;
			$rro = $row['ror'] + $rto;
			$rra = $row['rar'] + $rta;
			$cro = $row['tor'] == 0 ? 0 : ($rro/$row['tor']) * 100;
			$cra = $row['tar'] == 0 ? 0 : ($rra/$row['tar']) * 100;
		}
		else if ($var_tb == 4)
		{
			$rto =  $row['rotb4'];
			$rotb1 =  $row['rotb1'];
			$rotb2 =  $row['rotb2'] - ($row['rotb1']);
			$rotb3 =  $row['rotb3'] - ($row['rotb2']);
			$rotb4 =  $row['rotb4'] - ($row['rotb3']);
			$rta =  $row['ratb4']  / $jml_indi;
			$ratb1 = $row['ratb1'] / $jml_indi;
			$ratb2 = ($row['ratb2']  -  $row['ratb1']) / $jml_indi;
			$ratb3 = ($row['ratb3']  -  $row['ratb2']) / $jml_indi ;
			$ratb4 = ($row['ratb4']  - $row['ratb3']) / $jml_indi ;

			$co = $row['totb4'] == 0 ? 0 : ($rto/$row['totb4']) * 100;
			$ca = $row['pagu'] == 0 ? 0 : ($rta/$row['pagu']) * 100;
			$rro = $row['ror'] + $rto;
			$rra = $row['rar'] + $rta;
			$cro = $row['tor'] == 0 ? 0 : ($rro/$row['tor']) * 100;
			$cra = $row['tar'] == 0 ? 0 : ($rra/$row['tar']) * 100;
		}

			
		
		$q_check = mysql_query("SELECT count(outcome.id) as jml 
				from outcome 
				INNER JOIN satuan ON satuan.id = outcome.satuan
				where 
				outcome.kd_bidang=".$row['kd_bidang']." and 
				outcome.kd_program=".$row['kd_prog']." and 
				outcome.kd_skpd=".$row['kode']." 
				and outcome.thn=".$row['thn']);
		$hasil = mysql_fetch_array($q_check);
		if ($hasil['jml']>1)
		{ 
			$htmlTemplate .='
			  <tr  bgcolor="#dddddd">
				<td rowspan='.$hasil['jml'].'>' . $row['kd_bidang'] . $row['kd_prog'] . '</td>
				<td rowspan='.$hasil['jml'].'>' . $row['nm_prog'] . ' </td>
				<td border="1101">' . $row['indikator'] . '</td>
				<td border="1101">' . $row['satuan'] . '</td>
				<td border="1101">' . $row['tor'] . '</td>
				<td rowspan='.$hasil['jml'].'>' . buatrp($row['tar']) . '</td>
				<td border="1101">' . $row['ror'] . '</td>
				<td rowspan='.$hasil['jml'].'>' . buatrp($row['rar']) . '</td>
				<td border="1101">' . $row['totb4'] . '</td>
				<td rowspan='.$hasil['jml'].'>' . buatrp($row['pagu']) . '</td>
				<td border="1101">' . prosen($rotb1) . '</td>
				<td rowspan='.$hasil['jml'].'>' . buatrp($ratb1) . '</td>
				<td border="1101">' . prosen($rotb2) . '</td>
				<td rowspan='.$hasil['jml'].'>' . buatrp($ratb2) . '</td>
				<td border="1101">' . prosen($rotb3) . '</td>
				<td rowspan='.$hasil['jml'].'>' . buatrp($ratb3) . '</td>
				<td border="1101">' . prosen($rotb4) . '</td>
				<td rowspan='.$hasil['jml'].'>' . buatrp($ratb4) . '</td>
				<td border="1101">' . prosen($rto) . '</td>
				<td rowspan='.$hasil['jml'].'>' . buatrp($rta) . '</td>
				<td border="1101">' . prosen($co) . '%</td>
				<td rowspan='.$hasil['jml'].'>' . prosen($ca) . '%</td>
				<td border="1101">' . prosen($rro) . '</td>
				<td rowspan='.$hasil['jml'].'>' . buatrp($rra) . '</td>
				<td border="1101">' . prosen($cro) . '%</td>
				<td rowspan='.$hasil['jml'].'>' . prosen($cra) . '%</td>
				<td rowspan='.$hasil['jml'].'></td>
				<td rowspan='.$hasil['jml'].'></td>
			</tr>'; 
			$q_child_p = mysql_query("SELECT 
						outcome.indikator, 
						outcome.target_tb1 as totb1, 
						outcome.target_tb2 as totb2, 
						outcome.target_tb3 as totb3, 
						outcome.target_tb4 as totb4, 
						outcome.real_tb1 as rotb1, 
						outcome.real_tb2 as rotb2, 
						outcome.real_tb3 as rotb3, 
						outcome.real_tb4 as rotb4, 
						outcome.thn, 
						outcome.renstra as tor, 
						outcome.realisasi_renstra as ror, 
						satuan.satuan 
						FROM 
						outcome 
						INNER Join satuan ON satuan.id = outcome.satuan 
						where outcome.kd_bidang=".$row['kd_bidang']." AND 
						outcome.kd_program=".$row['kd_prog']." AND 
						outcome.kd_skpd=".$row['kode']);
			$skip_p = mysql_fetch_assoc($q_child_p);
			while($skip_p = mysql_fetch_assoc($q_child_p))
			{
	
				if ($var_tb == 1)
				{
					$rto =  $skip_p['rotb1'];
					$rotb1 =  $skip_p['rotb1'];
					$rotb2 =  0;
					$rotb3 =  0;
					$rotb4 =  0;
					

					$co = $skip_p['totb4'] == 0 ? 0 : ($rto/$skip_p['totb4']) * 100;
					
					$rro = $skip_p['ror'] + $rto;
					
					$cro = $skip_p['tor'] == 0 ? 0 : ($rro/$skip_p['tor']) * 100;

				}
				else if ($var_tb == 2)
				{
					$rto =  $skip_p['rotb2'];
					$rotb1 =  $skip_p['rotb1'];
					$rotb2 =  $skip_p['rotb2'] - ($skip_p['rotb1']);
					$rotb3 =  0;
					$rotb4 =  0;

					$co = $skip_p['totb4'] == 0 ? 0 : ($rto/$skip_p['totb4']) * 100;
					
					$rro = $skip_p['ror'] + $rto;
				
					$cro = $skip_p['tor'] == 0 ? 0 : ($rro/$skip_p['tor']) * 100;
					
				}
				else if ($var_tb == 3)
				{
					$rto =  $skip_p['rotb3'];
					$rotb1 =  $skip_p['rotb1'];
					$rotb2 =  $skip_p['rotb2'] - ($skip_p['rotb1']);
					$rotb3 =  $skip_p['rotb3'] - ($skip_p['rotb2']);
					$rotb4 =  0;
				
					$co = $skip_p['totb4'] == 0 ? 0 : ($rto/$skip_p['totb4']) * 100;
					
					$rro = $skip_p['ror'] + $rto;
				
					$cro = $skip_p['tor'] == 0 ? 0 : ($rro/$skip_p['tor']) * 100;
				
				}
				else if ($var_tb == 4)
				{
					$rto =  $skip_p['rotb4'];
					$rotb1 =  $skip_p['rotb1'];
					$rotb2 =  $skip_p['rotb2'] - ($skip_p['rotb1']);
					$rotb3 =  $skip_p['rotb3'] - ($skip_p['rotb2']);
					$rotb4 =  $skip_p['rotb4'] - ($skip_p['rotb3']);
					
					$co = $skip_p['totb4'] == 0 ? 0 : ($rto/$skip_p['totb4']) * 100;
					
					$rro = $skip_p['ror'] + $rto;
					
					$cro = $skip_p['tor'] == 0 ? 0 : ($rro/$skip_p['tor']) * 100;
				
				}
				
				$htmlTemplate .='
			  <tr  bgcolor="#dddddd">
				<td border="0101">' . $skip_p['indikator'] . '</td>
				<td border="0101">' . $skip_p['satuan'] . '</td>
				<td border="0101">' . prosen($skip_p['tor']) . '</td>
				<td border="0101">' . prosen($skip_p['ror']) . '</td>
				<td border="0101">' . prosen($skip_p['totb4']) . '</td>
				<td border="0101">' . prosen($rotb1) . '</td>
				<td border="0101">' . prosen($rotb2) . '</td>
				<td border="0101">' . prosen($rotb3) . '</td>
				<td border="0101">' . prosen($rotb4) . '</td>
				<td border="0101">' . prosen($rto) . '</td>
				<td border="0101">' . prosen($co) . '%</td>
				<td border="0101">' . prosen($rro) . '</td>
				<td border="0101">' . prosen($cro) . '%</td>
			  </tr>';
			}
		}
		
		else {
		$htmlTemplate .='
			<tr  bgcolor="#dddddd">
				<td>' . $row['kd_bidang'] . $row['kd_prog'] . '</td>
				<td>' . $row['nm_prog'] . ' </td>
				<td>' . $row['indikator'] . '</td>
				<td>' . $row['satuan'] . '</td>
				<td>' . prosen($row['tor']) . '</td>
				<td>' . buatrp($row['tar']) . '</td>
				<td>' . prosen($row['ror']) . '</td>
				<td>' . buatrp($row['rar']) . '</td>
				<td>' . prosen($row['totb4']) . '</td>
				<td>' . buatrp($row['pagu']) . '</td>
				<td>' . prosen($rotb1) . '</td>
				<td>' . buatrp($ratb1) . '</td>
				<td>' . prosen($rotb2) . '</td>
				<td>' . buatrp($ratb2) . '</td>
				<td>' . prosen($rotb3) . '</td>
				<td>' . buatrp($ratb3) . '</td>
				<td>' . prosen($rotb4) . '</td>
				<td>' . buatrp($ratb4) . '</td>
				<td>' . prosen($rto) . '</td>
				<td>' . buatrp($rta) . '</td>
				<td>' . prosen($co) . '%</td>
				<td>' . prosen($ca) . '%</td>
				<td>' . prosen($rro) . '</td>
				<td>' . buatrp($rra) . '</td>
				<td>' . prosen($cro) . '%</td>
				<td>' . prosen($cra) . '%</td>
				<td></td>
				<td></td>
			</tr>'; 
		}
		
		$q_kegiatan = mysql_query("SELECT 
			dpa.kd_kegiatan, 
			dpa.id, 
			dpa.ket, 
			dpa.jml_pagu as pagu,
			if(dpa.nm_subkegiatan='',dpa.nm_kegiatan,CONCAT(dpa.nm_kegiatan,' (',dpa.nm_subkegiatan, ')')) as kegiatan, 
			target_kegiatan.indikator, 
			satuan.satuan, 
			target_kegiatan.output_tb1 as totb1, 
			target_kegiatan.output_tb2 as totb2, 
			target_kegiatan.output_tb3 as totb3, 
			target_kegiatan.output_tb4 as totb4, 
			target_kegiatan.realisasi_tb1 as rotb1, 
			target_kegiatan.realisasi_tb2 as rotb2, 
			target_kegiatan.realisasi_tb3 as rotb3, 
			target_kegiatan.realisasi_tb4 as rotb4, 
			target_kegiatan.renstra as tor, 
			target_kegiatan.realisasi_renstra as ror, 
			target_anggaran.tb1 as tatb1, 
			target_anggaran.tb2 as tatb2, 
			target_anggaran.tb3 as tatb3, 
			target_anggaran.tb4 as tatb4, 
			target_anggaran.realisasi_tb1 as ratb1, 
			target_anggaran.realisasi_tb2 as ratb2, 
			target_anggaran.realisasi_tb3 as ratb3, 
			target_anggaran.realisasi_tb4 as ratb4, 
			target_anggaran.renstra as tar, 
			target_anggaran.realisasi_renstra as rar
			FROM 
			dpa 
			LEFT JOIN target_anggaran ON target_anggaran.id_dpa = dpa.id 
			LEFT JOIN target_kegiatan ON target_kegiatan.id_dpa = dpa.id 
			INNER JOIN satuan ON satuan.id = target_kegiatan.satuan
			where dpa.kode=$var_skpd_report and dpa.thn=$var_thn_report and dpa.kd_prog=" . $row['kd_prog']. " and dpa.kd_bidang =" . $row['kd_bidang'] ."
			GROUP BY 
			dpa.kd_urusan, 
			dpa.kd_bidang, 
			dpa.kd_prog, 
			dpa.kd_kegiatan, 
			dpa.kd_kegiatan,
			dpa.nm_subkegiatan,			
			dpa.kode, 
			dpa.thn");

		while ($row2 = mysql_fetch_assoc($q_kegiatan))
		{
			if ($var_tb == 1)
			{
				$rto2 =  $row2['rotb1'];
				$rotb21 =  $row2['rotb1'];
				$rotb22 =  0;
				$rotb23 =  0;
				$rotb24 =  0;
				$rta2 =  $row2['ratb1'];
				$ratb21 = $row2['ratb1'];
				$ratb22 = 0;
				$ratb23 = 0;
				$ratb24 = 0;

				$co2 = $row2['totb4'] == 0 ? 0 : ($rto2/$row2['totb4']) * 100;
				$ca2 = $row2['pagu'] == 0 ? 0 : ($rta2/$row2['pagu']) * 100;
				$rro2 = $row2['ror'] + $rto2;
				$rra2 = $row2['rar'] + $rta2;
				$cro2 = $row2['tor'] == 0 ? 0 : ($rro2/$row2['tor']) * 100;
				$cra2 = $row2['tar'] == 0 ? 0 : ($rra2/$row2['tar']) * 100;
			}
			else if ($var_tb == 2)
			{
				$rto2 =  $row2['rotb2'];
				$rotb21 =  $row2['rotb1'];
				$rotb22 =  $row2['rotb2'] - ($row2['rotb1']);
				$rotb23 =  0;
				$rotb24 =  0;
				$rta2 =  $row2['ratb2'];
				$ratb21 = $row2['ratb1'];
				$ratb22 = $row2['ratb2'] - $row2['ratb1'];
				$ratb23 = 0;
				$ratb24 = 0;

				$co2 = $row2['totb4'] == 0 ? 0 : ($rto2/$row2['totb4']) * 100;
				$ca2 = $row2['pagu'] == 0 ? 0 : ($rta2/$row2['pagu']) * 100;
				$rro2 = $row2['ror'] + $rto2;
				$rra2 = $row2['rar'] + $rta2;
				$cro2 = $row2['tor'] == 0 ? 0 : ($rro2/$row2['tor']) * 100;
				$cra2 = $row2['tar'] == 0 ? 0 : ($rra2/$row2['tar']) * 100;
			}
			else if ($var_tb == 3)
			{
				$rto2 =  $row2['rotb3'];
				$rotb21 =  $row2['rotb1'];
				$rotb22 =  $row2['rotb2'] - ($row2['rotb1']);
				$rotb23 =  $row2['rotb3'] - ($row2['rotb2']);
				$rotb24 =  0;
				$rta2 =  $row2['ratb3'];
				$ratb21 = $row2['ratb1'];
				$ratb22 = $row2['ratb2']  - $row2['ratb1'];
				$ratb23 = $row2['ratb3']  -  $row2['ratb2'];
				$ratb24 = 0;

				$co2 = $row2['totb4'] == 0 ? 0 : ($rto2/$row2['totb4']) * 100;
				$ca2 = $row2['pagu'] == 0 ? 0 : ($rta2/$row2['pagu']) * 100;
				$rro2 = $row2['ror'] + $rto2;
				$rra2 = $row2['rar'] + $rta2;
				$cro2 = $row2['tor'] == 0 ? 0 : ($rro2/$row2['tor']) * 100;
				$cra2 = $row2['tar'] == 0 ? 0 : ($rra2/$row2['tar']) * 100;
			}
			else if ($var_tb == 4)
			{
				$rto2 =  $row2['rotb4'];
				$rotb21 =  $row2['rotb1'];
				$rotb22 =  $row2['rotb2'] - ($row2['rotb1']);
				$rotb23 =  $row2['rotb3'] - ($row2['rotb2']);
				$rotb24 =  $row2['rotb4'] - ($row2['rotb3']);
				$rta2 =  $row2['ratb4'];
				$ratb21 = $row2['ratb1'];
				$ratb22 = $row2['ratb2'] - $row2['ratb1'];
				$ratb23 = $row2['ratb3'] -  $row2['ratb2'];
				$ratb24 = $row2['ratb4'] -  $row2['ratb3'];

				$co2 = $row2['totb4'] == 0 ? 0 : ($rto2/$row2['totb4']) * 100;
				$ca2 = $row2['pagu'] == 0 ? 0 : ($rta2/$row2['pagu']) * 100;
				$rro2 = $row2['ror'] + $rto2;
				$rra2 = $row2['rar'] + $rta2;
				$cro2 = $row2['tor'] == 0 ? 0 : ($rro2/$row2['tor']) * 100;
				$cra2 = $row2['tar'] == 0 ? 0 : ($rra2/$row2['tar']) * 100;
			}
					array_push($rco, $co2);
					array_push($rca, $ca2);
					array_push($rrro, $ro2);
					array_push($rrra, $rra2);
			
			$q_check_k = mysql_query("SELECT count(target_kegiatan.id) as jml 
				from target_kegiatan 
				INNER JOIN satuan ON satuan.id = target_kegiatan.satuan
				where  
				target_kegiatan.id_dpa=".$row2['id']) and target_kegiatan.satuan>0;
			$hasilk = mysql_fetch_array($q_check_k);
			if ($hasilk['jml']>1)
			{
				$htmlTemplate .='
				  <tr>
					<td rowspan='.$hasilk['jml'].'>' . $row2['kd_kegiatan'] . '</td>
					<td rowspan='.$hasilk['jml'].'>' . $row2['kegiatan'] . ' </td>
					<td border="1101">' . $row2['indikator'] . '</td>
					<td border="1101">' . $row2['satuan'] . '</td>
					<td border="1101">' . prosen($row2['tor']) . '</td>
					<td rowspan='.$hasilk['jml'].'>' . buatrp($row2['tar']) . '</td>
					<td border="1101">' . prosen($row2['ror']) . '</td>
					<td rowspan='.$hasilk['jml'].'>' . buatrp($row2['rar']) . '</td>
					<td border="1101">' . prosen($row2['totb4']) . '</td>
					<td rowspan='.$hasilk['jml'].'>' . buatrp($row2['pagu']) . '</td>
					<td border="1101">' . prosen($rotb21) . '</td>
					<td rowspan='.$hasilk['jml'].'>' . buatrp($ratb21) . '</td>
					<td border="1101">' . prosen($rotb22) . '</td>
					<td rowspan='.$hasilk['jml'].'>' . buatrp($ratb22) . '</td>
					<td border="1101">' . prosen($rotb23) . '</td>
					<td rowspan='.$hasilk['jml'].'>' . buatrp($ratb23) . '</td>
					<td border="1101">' . prosen($rotb24) . '</td>
					<td rowspan='.$hasilk['jml'].'>' . buatrp($ratb24) . '</td>
					<td border="1101">' . prosen($rto2) . '</td>
					<td rowspan='.$hasilk['jml'].'>' . buatrp($rta2) . '</td>
					<td border="1101">' . prosen($co2) . '%</td>
					<td rowspan='.$hasilk['jml'].'>' . prosen($ca2) . '%</td>
					<td border="1101">' . prosen($rro2) . '</td>
					<td rowspan='.$hasilk['jml'].'>' . buatrp($rra2) . '</td>
					<td border="1101">' . prosen($cro2) . '%</td>
					<td rowspan='.$hasilk['jml'].'>' . prosen($cra2) . '%</td>
					<td rowspan='.$hasilk['jml'].'></td>
					<td rowspan='.$hasilk['jml'].'>'.$row2['ket'].'</td>
				</tr>';	
				
				$q_child_k = mysql_query("SELECT 
					target_kegiatan.indikator, 
					satuan.satuan, 
					target_kegiatan.output_tb1 as totb1, 
					target_kegiatan.output_tb2 as totb2, 
					target_kegiatan.output_tb3 as totb3, 
					target_kegiatan.output_tb4 as totb4, 
					target_kegiatan.realisasi_tb1 as rotb1, 
					target_kegiatan.realisasi_tb2 as rotb2, 
					target_kegiatan.realisasi_tb3 as rotb3, 
					target_kegiatan.realisasi_tb4 as rotb4, 
					target_kegiatan.renstra as tor,
					target_kegiatan.realisasi_renstra as ror
					FROM  
					target_kegiatan 
					INNER JOIN satuan ON satuan.id = target_kegiatan.satuan
					where target_kegiatan.id_dpa=".$row2['id']);
				$skip_k = mysql_fetch_assoc($q_child_k);
				while($skip_k = mysql_fetch_assoc($q_child_k))
				{
				if ($var_tb == 1)
				{
					$rto2 =  $skip_k['rotb1'];
					$rotb21 =  $skip_k['rotb1'];
					$rotb22 =  0;
					$rotb23 =  0;
					$rotb24 =  0;

					$co2 = $skip_k['totb4'] == 0 ? 0 : ($rto2/$skip_k['totb4']) * 100;
					
					$rro2 = $skip_k['ror'] + $rto2;
					
					$cro2 = $skip_k['tor'] == 0 ? 0 : ($rro2/$skip_k['tor']) * 100;
					
				}
				else if ($var_tb == 2)
				{
					$rto2 =  $skip_k['rotb2'];
					$rotb21 =  $skip_k['rotb1'];
					$rotb22 =  $skip_k['rotb2'] - ($skip_k['rotb1']);
					$rotb23 =  0;
					$rotb24 =  0;

					$co2 = $skip_k['totb4'] == 0 ? 0 : ($rto2/$skip_k['totb4']) * 100;

					$rro2 = $skip_k['ror'] + $rto2;

					$cro2 = $skip_k['tor'] == 0 ? 0 : ($rro2/$skip_k['tor']) * 100;

				}
				else if ($var_tb == 3)
				{
					$rto2 =  $skip_k['rotb3'];
					$rotb21 =  $skip_k['rotb1'];
					$rotb22 =  $skip_k['rotb2'] - ($skip_k['rotb1']);
					$rotb23 =  $skip_k['rotb3'] - ($skip_k['rotb2']);
					$rotb24 =  0;

					$co2 = $skip_k['totb4'] == 0 ? 0 : ($rto2/$skip_k['totb4']) * 100;

					$rro2 = $skip_k['ror'] + $rto2;

					$cro2 = $skip_k['tor'] == 0 ? 0 : ($rro2/$skip_k['tor']) * 100;

				}
				else if ($var_tb == 4)
				{
					$rto2 =  $skip_k['rotb4'];
					$rotb21 =  $skip_k['rotb1'];
					$rotb22 =  $skip_k['rotb2'] - ($skip_k['rotb1']);
					$rotb23 =  $skip_k['rotb3'] - ($skip_k['rotb2']);
					$rotb24 =  $skip_k['rotb4'] - ($skip_k['rotb3']);


					$co2 = $skip_k['totb4'] == 0 ? 0 : ($rto2/$skip_k['totb4']) * 100;

					$rro2 = $skip_k['ror'] + $rto2;

					$cro2 = $skip_k['tor'] == 0 ? 0 : ($rro2/$skip_k['tor']) * 100;

				}
					array_push($rco, $co2);
					// array_push($rca, $ca2);
					array_push($rrro, $ro2);
					// array_push($rrra, $rra2);
					$htmlTemplate .='
					  <tr>
						<td border="0101">' . $skip_k['indikator'] . '</td>
						<td border="0101">' . $skip_k['satuan'] . '</td>
						<td border="0101">' . prosen($skip_k['tor']) . '</td>
						<td border="0101">' . prosen($skip_k['ror']) . '</td>
						<td border="0101">' . prosen($skip_k['totb4']) . '</td>
						<td border="0101">' . prosen($rotb21) . '</td>
						<td border="0101">' . prosen($rotb22) . '</td>
						<td border="0101">' . prosen($rotb23) . '</td>
						<td border="0101">' . prosen($rotb24) . '</td>
						<td border="0101">' . prosen($rto2) . '</td>
						<td border="0101">' . prosen($co2) . '%</td>
						<td border="0101">' . prosen($rro2) . '</td>
						<td border="0101">' . prosen($cro2) . '%</td>
					  </tr>';
				 }
			}
			else
			{
				$htmlTemplate .='
				  <tr>
					<td>' . $row2['kd_kegiatan'] . '</td>
					<td>' . $row2['kegiatan'] . ' </td>
					<td>' . $row2['indikator'] . '</td>
					<td>' . $row2['satuan'] . '</td>
					<td>' . prosen($row2['tor']) . '</td>
					<td>' . buatrp($row2['tar']) . '</td>
					<td>' . prosen($row2['ror']) . '</td>
					<td>' . buatrp($row2['rar']) . '</td>
					<td>' . prosen($row2['totb4']) . '</td>
					<td>' . buatrp($row2['pagu']) . '</td>
					<td>' . prosen($rotb21) . '</td>
					<td>' . buatrp($ratb21) . '</td>
					<td>' . prosen($rotb22) . '</td>
					<td>' . buatrp($ratb22) . '</td>
					<td>' . prosen($rotb23) . '</td>
					<td>' . buatrp($ratb23) . '</td>
					<td>' . prosen($rotb24) . '</td>
					<td>' . buatrp($ratb24) . '</td>
					<td>' . prosen($rto2) . '</td>
					<td>' . buatrp($rta2) . '</td>
					<td>' . prosen($co2) . '%</td>
					<td>' . prosen($ca2) . '%</td>
					<td>' . prosen($rro2) . '</td>
					<td>' . buatrp($rra2) . '</td>
					<td>' . prosen($cro2) . '%</td>
					<td>' . prosen($cra2) . '%</td>
					<td></td>
					<td>'.$row2['ket'].'</td>
				</tr>';
			} 
		}
	}

	$rat1 = rerata($rco);
	$rat2 = rerata($rca);
	$rat3 = rerata($rrro);
	$rat4 = rerata($rrra);

	$pr1 = predikat($rat1);
	$pr2 = predikat($rat2);
	$pr3 = predikat($rat3);
	$pr4 = predikat($rat4);




	 $htmlTemplate .='
		<tr pbr>
			<td align="right" colspan="20">Rata-rata capaian kinerja (%)</td>
			<td>'.$rat1.'%</td>
			<td>'.$rat2.'%</td>
			<td bgcolor="#000000"></td>
			<td bgcolor="#000000"></td>
			<td bgcolor="#000000"></td>
			<td bgcolor="#000000"></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="right" colspan="20">Predikat Kinerja</td>
			<td>'.$pr1.'</td>
			<td>'.$pr2.'</td>
			<td bgcolor="#000000"></td>
			<td bgcolor="#000000"></td>
			<td bgcolor="#000000"></td>
			<td bgcolor="#000000"></td>
			<td></td>
			<td></td>
		</tr>
	 ';

	 $query_ket = mysql_query("select `pendorong`, `penghambat`, `triwulan`, `renja` 
		from pendorong 
		where tb='$var_tb' and kode='$var_skpd_report' and thn='$var_thn_report'");
	 $r_ket = mysql_fetch_assoc($query_ket);
		$pendorong = $r_ket['pendorong'];
		$penghambat = $r_ket['penghambat'];
		$triwulan = $r_ket['triwulan'];
		$renja = $r_ket['renja'];
	 
	 $htmlTemplate .='
		<tr>
			<td colspan="28">Faktor Pendorong keberhasilan kinerja : '.$pendorong.'</td>
		</tr>
		<tr>
			<td colspan="28">Faktor penghambat pencapaian kinerja : '.$penghambat.'</td>
		</tr>
		<tr>
			<td colspan="28">Tindak langsung yang diperlukan dalam triwulan berikutnya : '.$triwulan.'</td>
		</tr>
		<tr>
			<td colspan="28">Tindak langsung yang diperlukan dalam Renja SKPD berikutnya : '.$renja.'</td>
		</tr>
	 ';
	 
	 $htmlTemplate .='
		<tr>
			<td border="0" colspan="17"></td>
			<td border="0" colspan="5"></td>
			<td border="0" colspan="5"></td>			
			<td border="0"></td>
		</tr>
		<tr>
			<td border="0" colspan="17"></td>
			<td border="0" align="center" colspan="5">Mojokerto, Tanggal ' . date('j-m-Y') .' <br><br>
				Dievaluasi<br>
				KEPALA BAPPEDA<br>
				Kota Mojokerto<br><br><br><br>
				<font style="bold,underline">' . strtoupper($bappeko["kepala"]) . '</font><br>
				' . $bappeko["pangkat"] .'<br>
				NIP. ' . $bappeko["nip"] .'<br>
			</td>
			<td border="0" align="center" colspan="5">Mojokerto, Tanggal ' . date('j-m-Y') .' <br><br>
				Disusun<br>
				KEPALA ' .strtoupper($skpd_nama).'<br>
				Kota Mojokerto<br><br><br><br>
				<font style="bold,underline">'.strtoupper($skpd_kepala).'</font><br>
				'.$skpd_pangkat.'<br>
				NIP. '.$skpd_nip.'<br>
			</td>
			<tdborder="0"></td>
		</tr>
	 ';
	
	// fpdf class
			############################
	 $namafile = 'laporan tribulan ' . $var_tb . '.pdf';
			$p = new PDF();
			
			// PAGE // Data
			$p->SetMargins(20,10,10);
			$p->AddPage();
			$p->setStyle('small');
			$p->text(0,'Formulir Evaluasi Hasil Renja SKPD',0,'C');
			$p->text(0,'SKPD '.$skpd_nama,0,'C');
			$p->text(0,'Periode Kegiatan Tribulan '. $var_tb . ' - Tahun ' .$var_thn_report,0,'C');
			$p->SetFont('helvetica','', '5');
			$p->htmltable($htmlTemplate);
			
			$filename = "MyFiles - ".rand(111,999)." .pdf"; // ubah namafile sesuai dengan keinginan
			// archive in server
			$p->output($namafile,'I'); // tempat file pdf yg akan disimpan di server
			// end archives
?>