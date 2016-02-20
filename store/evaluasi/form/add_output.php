<?php 
require '../../../boot.php';
$req = Common::obj(Request::all());

?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/evaluasi/add_output.php"
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
                                kd_kegiatan : <?php echo $req->kd_kegiatan; ?>
                            },
                            width: '100%',
                            hasDownArrow : false,
                            onSelect : function(r) {
                                $('#satuan').combobox('setValue', r.satuan);
                            },
                            url: BASE_URL + 'store/evaluasi/suggest/output.php'" />
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
    </div>
        <input type="hidden" name="kd_kegiatan" value="<?php echo $req->kd_kegiatan; ?>">
        <input type="hidden" name="kd_unit" value="<?php echo $req->kd_unit; ?>">
        <input type="hidden" name="kd_subunit" value="<?php echo $req->kd_subunit; ?>">
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;