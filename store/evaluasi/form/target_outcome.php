<?php 
require '../../../boot.php';

require '../../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$req = Common::obj(Request::all());

$data = Suggest::targetOutcome($req->id);

?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post"
    style="height: 100%;
            width: 100%;" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/evaluasi/add_target_outcome.php"
>
        <div title="Target" style="padding:10px;">
            <div class="row mb20">
                <div class="small-4 columns">
                    <label for="unit_eselon_id" class="left inline">Penanggung Jawab</label>
                </div>
                <div class="small-8 columns">
                    <select id="unit_eselon_id" 
                        class="easyui-combogrid"
                        name="unit_eselon_id"
                        style="width:100%;"
                        data-options="
                            panelWidth:450,
                            value:'<?php echo $req->unit_eselon_id; ?>',
                            idField:'id',
                            readonly : ! configApp.evaluasi.edit_target_indikator_outcome,
                            textField:'person',
                            url:'store/evaluasi/suggest/unit_eselon.php',
                            queryParams : {
                                id : '<?php echo $req->id_indikator; ?>',
                                eselon : 'III'
                            },
                            columns:[[
                                {field:'id',title:'ID',hidden:true,width:60},
                                {field:'unit_organisasi',title:'Bidang Organisasi',width:200},
                                {field:'person',title:'Penanggung Jawab',width:200}
                            ]]
                        "></select>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-4 columns">
                    <label for="target_triwulan_1" class="left inline">Triwulan I</label>
                </div>
                <div class="small-3 columns">
                    <input name="target_triwulan_1" 
                            class="easyui-numberbox" 
                            data-options="precision:2,
                                groupSeparator:'.',
                                decimalSeparator:',',
                                readonly : ! configApp.evaluasi.edit_target_indikator_outcome" 
                            style="width:100%" 
                            value="<?php echo $data->target_triwulan_1; ?>"></input>
                </div>
                <div class="small-5 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-4 columns">
                    <label for="target_triwulan_2" class="left inline">Triwulan II</label>
                </div>
                <div class="small-3 columns">
                    <input name="target_triwulan_2" 
                            class="easyui-numberbox" 
                            data-options="precision:2,
                                groupSeparator:'.',
                                decimalSeparator:',',
                                readonly : ! configApp.evaluasi.edit_target_indikator_outcome" 
                                style="width:100%" 
                                value="<?php echo $data->target_triwulan_2; ?>"></input>
                </div>
                <div class="small-5 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-4 columns">
                    <label for="target_triwulan_3" class="left inline">Triwulan III</label>
                </div>
                <div class="small-3 columns">
                    <input name="target_triwulan_3" 
                        class="easyui-numberbox" 
                        data-options="precision:2,
                            groupSeparator:'.',
                            decimalSeparator:',',
                            readonly : ! configApp.evaluasi.edit_target_indikator_outcome" 
                        style="width:100%" 
                        value="<?php echo $data->target_triwulan_3; ?>"></input>
                </div>
                <div class="small-5 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-4 columns">
                    <label for="target_triwulan_4" class="left inline">Triwulan IV</label>
                </div>
                <div class="small-3 columns">
                    <input name="target_triwulan_4" 
                        class="easyui-numberbox" 
                        data-options="precision:2,
                            groupSeparator:'.',
                            decimalSeparator:',',
                            readonly : ! configApp.evaluasi.edit_target_indikator_outcome" 
                        style="width:100%" 
                        value="<?php echo $data->target_triwulan_4; ?>"></input>
                </div>
                <div class="small-5 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
        </div>
    
    <input type="hidden" name="id" value="<?php echo $data->id; ?>">
    <input type="hidden" name="id_indikator" value="<?php echo $req->id_indikator; ?>">
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;