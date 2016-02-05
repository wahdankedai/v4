<?php 
require '../../boot.php';
?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/keselarasan/add.php"
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
                        data-options="
                            min:1,
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
                        name="nm_keselarasan" 
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