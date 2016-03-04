<?php 
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$id = Request::all($_REQUEST);
unset($id['_']);
$old = DB::find('program', $id);


?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post"  
    action="<?php echo BASE_URL; ?>store/program/edit.php"
>
    <div class="row p10">
        <div class="row mb20">
            <input  type="hidden" name="kd_urusan" value="<?php echo $old->kd_urusan; ?>" >
            <input  type="hidden" name="kd_bidang" value="<?php echo $old->kd_bidang; ?>" >
            <div class="small-3 columns">
                <label for="kd_program" class="left inline">Kode Program</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="kd_program" 
                        name="kd_program" 
                        class="form-control easyui-numberbox" 
                        value = "<?php echo $old->kd_program; ?>"
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
                <label for="nm_program" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_program" 
                        name="nm_program",
                        value = "<?php echo $old->nm_program; ?>" 
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