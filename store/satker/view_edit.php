<?php 
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$id = Request::all($_REQUEST);
unset($id['_']);
$old = DB::find('satker', $id);


?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post"  
    action="<?php echo BASE_URL; ?>store/satker/edit.php"
>
    <div class="row p10">
        <div class="row mb20">
            <input  type="hidden" name="kd_urusan" value="<?php echo $old->kd_urusan; ?>" >
            <input  type="hidden" name="kd_bidang" value="<?php echo $old->kd_bidang; ?>" >
            <div class="small-3 columns">
                <label for="kd_satker" class="left inline">Kode Satker</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="kd_satker" 
                        name="kd_satker" 
                        class="form-control easyui-numberbox" 
                        value = "<?php echo $old->kd_satker; ?>"
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
                <label for="nm_singkat" class="left inline">Nama Singkat</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_singkat" 
                        name="nm_singkat",
                        value = "<?php echo $old->nm_singkat; ?>" 
                        class="form-control easyui-textbox",
                        data-options="
                            required:true,
                            ">
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="nm_satker" class="left inline">Nama Satker</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_satker" 
                        name="nm_satker",
                        value = "<?php echo $old->nm_satker; ?>" 
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