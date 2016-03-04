<?php 
require '../../../boot.php';

require '../../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$req = Common::obj(Request::all());

?>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="program" class="left inline">Program</label>
            </div>
            <div class="small-9 columns">
                <input name="program" id="program" class="easyui-combobox" data-options="
                            valueField: 'kd_program',
                            textField: 'nm_program',
                            width: '100%',
                            onSelect: function(r){
                                if(r.kd_program !=0) {
                                    $('.list-kegiatan').datagrid({
                                        queryParams : {
                                            kd_unit : '<?php echo $req->kd_unit; ?>',
                                            kd_subunit : '<?php echo $req->kd_subunit; ?>',
                                            kd_program : r.kd_program
                                        }
                                    });
                                }
                            },
                            queryParams : {
                                kd_urusan : '<?php echo $req->kd_urusan; ?>',
                                kd_unit : '<?php echo $req->kd_unit; ?>',
                                kd_subunit : '<?php echo $req->kd_subunit; ?>',
                                kd_bidang : '<?php echo $req->kd_bidang; ?>'
                            },
                            url: BASE_URL + 'store/evaluasi_renstra/list_program_renstra.php'" />
            </div>
        </div>
    </div>

    <div class="row p10" style="height:200px">
        <table class="list-kegiatan easyui-datagrid" data-options="fit:true,
            fitColumns:true,
            title:'List Kegiatan',
            checkbox:true,
            checkOnSelect:true,
            selectOnCheck:true,
            queryParams : {
                kd_unit : '<?php echo $req->kd_unit; ?>',
                kd_subunit : '<?php echo $req->kd_subunit; ?>',
                kd_program : 0
            },
            url: 'store/evaluasi_renstra/list_kegiatan_renstra.php'
            ">
             <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true"></th>
                    <th data-options="hidden:true,field:'kd_kegiatan',align:'center'" width="80">Kode</th>
                    <th data-options="field:'kode',align:'center'" width="80">Kode</th>
                    <th data-options="field:'nm_kegiatan'" width="500">Uraian Nama Kegiatan</th>
                </tr>
            </thead>
        </table>
    </div>
        <input type="hidden" name="kd_unit" value="<?php echo $req->kd_unit; ?>">
        <input type="hidden" name="kd_subunit" value="<?php echo $req->kd_subunit; ?>">

<script type="text/javascript">
    
</script>

<?php 
exit;