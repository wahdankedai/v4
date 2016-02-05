<?php 
require '../../boot.php';

$id = Request::all($_REQUEST);
unset($id['_']);
$old = DB::find('kegiatan', $id);


?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post"  
    action="<?php echo BASE_URL; ?>store/kegiatan/edit.php"
>
    <div class="row p10">
        <div class="row mb20">
            <input  type="hidden" name="kd_urusan" value="<?php echo $old->kd_urusan; ?>" >
            <input  type="hidden" name="kd_bidang" value="<?php echo $old->kd_bidang; ?>" >
            <input  type="hidden" name="kd_program" value="<?php echo $old->kd_program; ?>" >
            <div class="small-3 columns">
                <label for="kd_kegiatan" class="left inline">Kode Kegiatan</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="kd_kegiatan" 
                        name="kd_kegiatan" 
                        class="form-control easyui-numberbox" 
                        value = "<?php echo $old->kd_kegiatan; ?>"
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
                <label for="nm_kegiatan" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_kegiatan" 
                        name="nm_kegiatan",
                        value = "<?php echo $old->nm_kegiatan; ?>" 
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