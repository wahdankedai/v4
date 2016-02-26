<?php
$table1 = "
<table border=1 align=right>
  <tbody><tr id='datagrid-row-r1-2-0' datagrid-row-index='0' class='datagrid-row datagrid-row-checked datagrid-row-selected' style='height: 25px;'><td field='nm_laporan'><div style='height:auto;' class='datagrid-cell datagrid-cell-c1-nm_laporan'>Laporan Evaluasi Triwulanan</div></td></tr><tr id='datagrid-row-r1-2-1' datagrid-row-index='1' class='datagrid-row' style='height: 25px;'><td field='nm_laporan'><div style='height:auto;' class='datagrid-cell datagrid-cell-c1-nm_laporan'>Laporan Evaluasi Tahunan</div></td></tr><tr id='datagrid-row-r1-2-2' datagrid-row-index='2' class='datagrid-row' style='height: 25px;'><td field='nm_laporan'><div style='height:auto;' class='datagrid-cell datagrid-cell-c1-nm_laporan'>Laporan Evaluasi 5 Tahunan</div></td></tr><tr id='datagrid-row-r1-2-3' datagrid-row-index='3' class='datagrid-row' style='height: 25px;'><td field='nm_laporan'><div style='height:auto;' class='datagrid-cell datagrid-cell-c1-nm_laporan'>Laporan Sakip</div></td></tr></tbody>
</table>
";










define('FPDF_FONTPATH', LIB . DS . 'font' .DS);

require(LIB . DS . 'lib' . DS . 'pdftable.inc.php');

$p = new PDFTable();
$p->AddPage();
$p->setfont('times','',12);
$p->htmltable($table1);
$p->output(NAMA_LAPORAN, 'F');
?>