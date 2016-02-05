<?php 
require '../../boot.php';

$id = Request::all($_REQUEST);
unset($id['_']);
$old = DB::find('bidang', $id);


?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post"  
    action="<?php echo BASE_URL; ?>store/bidang/edit.php"
>
    <div class="row p10">
        <div class="row mb20">
            <input  type="hidden" name="kd_urusan" value="<?php echo $old->kd_urusan; ?>" >
            <div class="small-3 columns">
                <label for="kd_bidang" class="left inline">Kode</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="kd_bidang" 
                        name="kd_bidang" 
                        class="form-control easyui-numberbox" 
                        value = "<?php echo $old->kd_bidang; ?>"
                        data-options="
                            min:1,
                            readonly:true,
                            precision:0,
                            delay:200,
                            required:true">
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="nm_bidang" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_bidang" 
                        name="nm_bidang",
                        value = "<?php echo $old->nm_bidang; ?>" 
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