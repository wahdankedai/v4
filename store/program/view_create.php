<?php 
require '../../boot.php';
$kd_urusan = Request::get('kd_urusan');
$kd_bidang = Request::get('kd_bidang');
?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/program/add.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="kd_bidang" class="left inline">Kode Program</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="kd_program" 
                        name="kd_program" 
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
                <label for="nm_program" class="left inline">Nama</label>
            </div>
            <div class="small-9 columns">
                <input  type="text" 
                        id="nm_program" 
                        name="nm_program" 
                        class="form-control easyui-textbox">
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;