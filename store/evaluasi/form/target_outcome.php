<?php 
require '../../../boot.php';
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
    <div class="easyui-accordion" data-options="fit:true">
        <div title="Target" style="padding:10px;">
            <div class="row mb20">
                <div class="small-3 columns">
                    <label for="target_triwulan_1" class="left inline">Triwulan I</label>
                </div>
                <div class="small-3 columns">
                    <input name="target_triwulan_1" class="easyui-numberbox" data-options="precision:2,groupSeparator:'.',decimalSeparator:','" style="width:100%" value="<?php echo $data->target_triwulan_1; ?>"></input>
                </div>
                <div class="small-6 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-3 columns">
                    <label for="target_triwulan_2" class="left inline">Triwulan II</label>
                </div>
                <div class="small-3 columns">
                    <input name="target_triwulan_2" class="easyui-numberbox" data-options="precision:2,groupSeparator:'.',decimalSeparator:','" style="width:100%" value="<?php echo $data->target_triwulan_2; ?>"></input>
                </div>
                <div class="small-6 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-3 columns">
                    <label for="target_triwulan_3" class="left inline">Triwulan III</label>
                </div>
                <div class="small-3 columns">
                    <input name="target_triwulan_3" class="easyui-numberbox" data-options="precision:2,groupSeparator:'.',decimalSeparator:','" style="width:100%" value="<?php echo $data->target_triwulan_3; ?>"></input>
                </div>
                <div class="small-6 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-3 columns">
                    <label for="target_triwulan_4" class="left inline">Triwulan IV</label>
                </div>
                <div class="small-3 columns">
                    <input name="target_triwulan_4" class="easyui-numberbox" data-options="precision:2,groupSeparator:'.',decimalSeparator:','" style="width:100%" value="<?php echo $data->target_triwulan_4; ?>"></input>
                </div>
                <div class="small-6 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
        </div>
        <div title="Realisasi" style="padding:10px;">
                        <div class="row mb20">
                <div class="small-3 columns">
                    <label for="realisasi_triwulan_1" class="left inline">Triwulan I</label>
                </div>
                <div class="small-3 columns">
                    <input name="realisasi_triwulan_1" class="easyui-numberbox" data-options="precision:2,groupSeparator:'.',decimalSeparator:','" style="width:100%" value="<?php echo $data->realisasi_triwulan_1; ?>"></input>
                </div>
                <div class="small-6 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-3 columns">
                    <label for="realisasi_triwulan_2" class="left inline">Triwulan II</label>
                </div>
                <div class="small-3 columns">
                    <input name="realisasi_triwulan_2" class="easyui-numberbox" data-options="precision:2,groupSeparator:'.',decimalSeparator:','" style="width:100%" value="<?php echo $data->realisasi_triwulan_2; ?>"></input>
                </div>
                <div class="small-6 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-3 columns">
                    <label for="realisasi_triwulan_3" class="left inline">Triwulan III</label>
                </div>
                <div class="small-3 columns">
                    <input name="realisasi_triwulan_3" class="easyui-numberbox" data-options="precision:2,groupSeparator:'.',decimalSeparator:','" style="width:100%" value="<?php echo $data->realisasi_triwulan_3; ?>"></input>
                </div>
                <div class="small-6 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
            </div>
            <div class="row mb20">
                <div class="small-3 columns">
                    <label for="realisasi_triwulan_4" class="left inline">Triwulan IV</label>
                </div>
                <div class="small-3 columns">
                    <input name="realisasi_triwulan_4" class="easyui-numberbox" data-options="precision:2,groupSeparator:'.',decimalSeparator:','" style="width:100%" value="<?php echo $data->realisasi_triwulan_4; ?>"></input>
                </div>
                <div class="small-6 columns">
                    <label>&nbsp;&nbsp;&nbsp;<?php echo $req->nm_satuan; ?></label>
                </div>
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