<?php 
require '../../boot.php';

require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$req = Common::obj(Request::all());

?>  

    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="pilihanSatker" class="left inline">SKPD</label>
            </div>
            <div class="small-9 columns">
                <select id="pilihanSatker" class="easyui-combobox" name="satker" style="width:100%;"
                    data-options="valueField:'kode',textField:'nama',url:'store/organisasi/list_report.php',
                    queryParams: {<?php echo App::filterReportUser($session->role, $session->kd_subunit); ?>}">
                </select>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="pilihanTahun" class="left inline">Tahun</label>
            </div>
            <div class="small-9 columns">
                <select id="pilihanTahun" class="easyui-combobox" name="tahun" style="width:100%;"
                        data-options="valueField:'tahun',textField:'tahun',url:'store/tahun.php',
                        value:<?php echo $session->tahun; ?>">
                </select>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="pilihanTriwulan" class="left inline">Triwulan</label>
            </div>
            <div class="small-9 columns">
                <select id="pilihanTriwulan" class="easyui-combobox" name="triwulan" style="width:100%;">
                    <option value="1">Triwulan I</option>
                    <option value="2">Triwulan II</option>
                    <option value="3">Triwulan III</option>
                    <option value="4">Triwulan IV</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row p10">
        <div class="row mb20">
                <div class="small-5 columns"> &nbsp;</div>
                <a href="#" class="lap-xls easyui-linkbutton small-3 columns" data-options="iconCls:'icon-xlsx'">Excel</a>
                <div class="small-1 columns"> &nbsp;</div>
                <a href="#" class="lap-pdf easyui-linkbutton small-3 columns" 
                    data-options="iconCls:'icon-pdf'">PDF</a>

        </div>
    </div>
       

<script type="text/javascript">
    var variabel = {
            tahun : <?php echo $session->tahun; ?>,
            triwulan : 1,
            skpd : '',
            folder : '<?php echo $req->folder; ?>'
        },
        pilihanTriwulan = $('#pilihanTriwulan'), 
        pilihanSatker = $('#pilihanSatker'), 
        pilihanTahun = $('#pilihanTahun');  
    pilihanTahun.combobox({
        onSelect : function () {
            variabel.tahun = pilihanTahun.combobox('getValue');
        }
    });
    pilihanSatker.combobox({
        onSelect : function () {
            variabel.skpd = pilihanSatker.combobox('getValue');
        }
    });
    pilihanTriwulan.combobox({
        onSelect : function () {
            variabel.triwulan = pilihanTriwulan.combobox('getValue');
        }
    });
 
    $('.lap-pdf').bind('click', function(){
        variabel.tipe = 'pdf';
        $('#x-dialog-report').window({
            title : '<?php echo $req->nm_laporan ?> Format PDF',
            width : '85%',
            height : 650,
            modal:true,
            onOpen : function () {
                $('#x-dialog-report').window('maximize');
            },
            href : 'laporan.php',
            queryParams : variabel,
            method :'post'
        });
    });

    $('.lap-xls').bind('click', function(){
        variabel.tipe = 'xls';
        $('#x-dialog-report').window({
            title : '<?php echo $req->nm_laporan ?> Format PDF',
            width : '85%',
            height : 650,
            modal:true,
            onOpen : function () {
                $('#x-dialog-report').window('maximize');
            },
            href : 'laporan.php',
            queryParams : variabel,
            method :'post'
        });
    });

</script>

<?php 
exit;