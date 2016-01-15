<?php 
require '../../boot.php';

$id = Request::get('id');

$old = DB::find('urusan', ['kd_urusan' => $id]);


?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/urusan/edit.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="kd_urusan" class="left inline">Kode</label>
            </div>
            <div class="small-9 columns">
                <input type="hidden" name="old_kd_urusan" value="<?php echo $old->kd_urusan; ?>" />
                <input  type="text" 
                        id="kd_urusan" 
                        name="kd_urusan" 
                        class="form-control easyui-numberbox" 
                        value = "<?php echo $old->kd_urusan; ?>"
                        data-options="
                            min:1,
                            precision:0,
                            delay:200,
                            required:true">
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="nm_urusan" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_urusan" 
                        name="nm_urusan",
                        value = "<?php echo $old->nm_urusan; ?>" 
                        class="form-control easyui-textbox",
                        data-options="
                            required:true,
                            ">
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;