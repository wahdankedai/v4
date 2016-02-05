<?php 
require '../../boot.php';
$kd_urusan = Request::get('kd_urusan');
?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/bidang/add.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="kd_bidang" class="left inline">Kode Bidang</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="kd_bidang" 
                        name="kd_bidang" 
                        class="form-control easyui-numberbox" 
                        data-options="
                            min:1,
                            precision:0">
                <input  type="hidden" name="kd_urusan" value="<?php echo $kd_urusan; ?>" >
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="nm_bidang" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_bidang" 
                        name="nm_bidang" 
                        class="form-control easyui-textbox">
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;