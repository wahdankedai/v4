<?php 
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());

?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/evaluasi_renstra/proses_anggaran.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="awal" class="left inline">Target Tahun Awal</label>
            </div>
            <div class="small-7 columns">
                <input name="awal" 
                    class="easyui-numberbox awals" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran_renstra.awal" 
                    style="width:100%" 
                    value="<?php echo $req->awal; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="tahun1" class="left inline">Target Tahun 1</label>
            </div>
            <div class="small-7 columns">
                <input name="tahun1" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran_renstra.tahun1" 
                    style="width:100%" 
                    value="<?php echo $req->tahun1; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="tahun2" class="left inline">Target Tahun 2</label>
            </div>
            <div class="small-7 columns">
                <input name="tahun2" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran_renstra.tahun2" 
                    style="width:100%" 
                    value="<?php echo $req->tahun2; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="tahun3" class="left inline">Target Tahun 3</label>
            </div>
            <div class="small-7 columns">
                <input name="tahun3" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran_renstra.tahun3" 
                    style="width:100%" 
                    value="<?php echo $req->tahun3; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="tahun4" class="left inline">Target Tahun 4</label>
            </div>
            <div class="small-7 columns">
                <input name="tahun4" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran_renstra.tahun4" 
                    style="width:100%" 
                    value="<?php echo $req->tahun4; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="tahun5" class="left inline">Target Tahun 5</label>
            </div>
            <div class="small-7 columns">
                <input name="tahun5" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran_renstra.tahun5" 
                    style="width:100%" 
                    value="<?php echo $req->tahun5; ?>"></input>
            </div>
        </div>
        
    </div>
        <input type="hidden" name="kd_subunit" value="<?php echo $req->kd_subunit; ?>">
        <input type="hidden" name="kd_unit" value="<?php echo $req->kd_unit; ?>">
        <input type="hidden" name="kd_kegiatan" value="<?php echo $req->kd_kegiatan; ?>">
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;