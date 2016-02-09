<?php 
require '../../boot.php';

$id = Request::get('id');

$old = DB::find('satuan', ['nm_satuan' => $id]);


?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post"  
    action="<?php echo BASE_URL; ?>store/satuan/edit.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="nm_satuan" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_satuan" 
                        name="nm_satuan",
                        value = "<?php echo $old->nm_satuan; ?>" 
                        class="form-control easyui-textbox",
                        data-options="
                            required:true,
                            ">
                        <input  type="hidden" 
                        name="kd_satuan",
                        value = "<?php echo $old->nm_satuan; ?>">
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;