<?php 
require '../../../boot.php';
$req = Common::obj(Request::all());

?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/evaluasi/add_outcome.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="indikator" class="left inline">Indikator</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="indikator" 
                        name="indikator" 
                        class="form-control easyui-textbox" 
                        data-options="required:true">
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="satuan" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input name="satuan" id="satuan" class="easyui-combobox" data-options="
                            valueField: 'id',
                            textField: 'nm_satuan',
                            url: BASE_URL + 'store/satuan/list.php'" />
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