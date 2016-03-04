<?php 
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$kd_urusan = Request::get('kd_urusan');
$kd_bidang = Request::get('kd_bidang');
?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/satker/add.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="kd_bidang" class="left inline">Kode Satker</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="kd_satker" 
                        name="kd_satker" 
                        class="form-control easyui-numberbox" 
                        data-options="
                            min:1,
                            precision:0">
                <input  type="hidden" name="kd_urusan" value="<?php echo $kd_urusan; ?>" >
                <input  type="hidden" name="kd_bidang" value="<?php echo $kd_bidang; ?>" >
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="nm_singkat" class="left inline">Nama Singkat</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_singkat" 
                        name="nm_singkat" 
                        class="form-control easyui-textbox">
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="nm_satker" class="left inline">Nama Satker</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_satker" 
                        name="nm_satker" 
                        class="form-control easyui-textbox">
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;