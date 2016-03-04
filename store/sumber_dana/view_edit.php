<?php 
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$id = Request::get('id');

$old = DB::find('sumber_dana', ['nm_sumber_dana' => $id]);


?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post"  
    action="<?php echo BASE_URL; ?>store/sumber_dana/edit.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="nm_sumber_dana" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_sumber_dana" 
                        name="nm_sumber_dana",
                        value = "<?php echo $old->nm_sumber_dana; ?>" 
                        class="form-control easyui-textbox",
                        data-options="
                            required:true,
                            ">
                        <input  type="hidden" 
                        name="kd_sumber_dana",
                        value = "<?php echo $old->nm_sumber_dana; ?>">
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;