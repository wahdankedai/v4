<?php 
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/satuan/add.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="nm_satuan" class="left inline">Sumber Dana</label>
            </div>
            <div class="small-7 columns">
                <input  type="text" 
                        id="nm_satuan" 
                        name="nm_satuan" 
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