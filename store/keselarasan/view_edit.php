<?php 
require '../../boot.php';

$id = Request::get('id');

$old = DB::find('keselarasan', ['kd_keselarasan' => $id]);


?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post"  
    action="<?php echo BASE_URL; ?>store/keselarasan/edit.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="kd_keselarasan" class="left inline">Kode</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="kd_keselarasan" 
                        name="kd_keselarasan" 
                        class="form-control easyui-numberbox" 
                        value = "<?php echo $old->kd_keselarasan; ?>"
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
                <label for="nm_keselarasan" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_keselarasan" 
                        name="nm_keselarasan",
                        value = "<?php echo $old->nm_keselarasan; ?>" 
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