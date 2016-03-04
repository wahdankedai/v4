<?php 
require '../../../boot.php';

require '../../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$req = Common::obj(Request::all());

?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/evaluasi_renstra/add_outcome.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="indikator" class="left inline">Indikator</label>
            </div>
            <div class="small-9 columns">
                <input name="indikator" id="indikator" class="easyui-combobox" data-options="
                            valueField: 'indikator',
                            textField: 'indikator',
                            queryParams : {
                                kd_program : <?php echo $req->kd_program; ?>
                            },
                            width: '100%',
                            hasDownArrow : false,
                            onSelect : function(r) {
                                $('#satuan').combobox('setValue', r.satuan);
                            },
                            url: BASE_URL + 'store/evaluasi/suggest/outcome.php'" />
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="satuan" class="left inline">Satuan</label>
            </div>
            <div class="small-9 columns">
                <input name="satuan" id="satuan" class="easyui-combobox" data-options="
                            valueField: 'id',
                            textField: 'nm_satuan',
                            url: BASE_URL + 'store/satuan/list.php'" />
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="target_awal" class="left inline">Tahun Awal</label>
            </div>
            <div class="small-9 columns">
                <input name="target_awal" 
                        class="easyui-numberbox" 
                        data-options="precision:2,
                            groupSeparator:'.',
                            decimalSeparator:',',
                            readonly : ! configApp.evaluasi.add_indikator_outcome_renstra" 
                        style="width:100%"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="target_tahun_1" class="left inline">Tahun I</label>
            </div>
            <div class="small-9 columns">
                <input name="target_tahun_1" 
                        class="easyui-numberbox" 
                        data-options="precision:2,
                            groupSeparator:'.',
                            decimalSeparator:',',
                            readonly : ! configApp.evaluasi.add_indikator_outcome_renstra" 
                        style="width:100%"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="target_tahun_2" class="left inline">Tahun II</label>
            </div>
            <div class="small-9 columns">
                <input name="target_tahun_2" 
                        class="easyui-numberbox" 
                        data-options="precision:2,
                            groupSeparator:'.',
                            decimalSeparator:',',
                            readonly : ! configApp.evaluasi.add_indikator_outcome_renstra" 
                            style="width:100%"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="target_tahun_3" class="left inline">Tahun III</label>
            </div>
            <div class="small-9 columns">
                <input name="target_tahun_3" 
                    class="easyui-numberbox" 
                    data-options="precision:2,
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.add_indikator_outcome_renstra" 
                    style="width:100%"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="target_tahun_4" class="left inline">Tahun IV</label>
            </div>
            <div class="small-9 columns">
                <input name="target_tahun_4" 
                    class="easyui-numberbox" 
                    data-options="precision:2,
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.add_indikator_outcome_renstra" 
                    style="width:100%"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="target_tahun_5" class="left inline">Tahun V</label>
            </div>
            <div class="small-9 columns">
                <input name="target_tahun_5" 
                    class="easyui-numberbox" 
                    data-options="precision:2,
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.add_indikator_outcome_renstra" 
                    style="width:100%"></input>
            </div>
        </div>
    </div>
        <input type="hidden" name="kd_program" value="<?php echo $req->kd_program; ?>">
        <input type="hidden" name="kd_unit" value="<?php echo $req->kd_unit; ?>">
        <input type="hidden" name="kd_subunit" value="<?php echo $req->kd_subunit; ?>">
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;