<?php 
require '../../../boot.php';
require '../../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());
// var_dump($req);
// exit;

?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/sasaran_skpd/proses_indikator.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="target_triwulan_1" class="left inline">Target Triwulan 1</label>
            </div>
            <div class="small-7 columns">
                <input name="target_triwulan_1" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.target_triwulan_1" 
                    style="width:100%" 
                    value="<?php echo $req->target_triwulan_1; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="target_triwulan_2" class="left inline">Target Triwulan 2</label>
            </div>
            <div class="small-7 columns">
                <input name="target_triwulan_2" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.target_triwulan_2" 
                    style="width:100%" 
                    value="<?php echo $req->target_triwulan_2; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="target_triwulan_3" class="left inline">Target Triwulan 3</label>
            </div>
            <div class="small-7 columns">
                <input name="target_triwulan_3" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.target_triwulan_3" 
                    style="width:100%" 
                    value="<?php echo $req->target_triwulan_3; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="target_triwulan_4" class="left inline">Target Triwulan 4</label>
            </div>
            <div class="small-7 columns">
                <input name="target_triwulan_4" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.target_triwulan_4" 
                    style="width:100%" 
                    value="<?php echo $req->target_triwulan_4; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="realisasi_triwulan_1" class="left inline">realisasi Triwulan 1</label>
            </div>
            <div class="small-7 columns">
                <input name="realisasi_triwulan_1" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.realisasi_triwulan_1" 
                    style="width:100%" 
                    value="<?php echo $req->realisasi_triwulan_1; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="realisasi_triwulan_2" class="left inline">realisasi Triwulan 2</label>
            </div>
            <div class="small-7 columns">
                <input name="realisasi_triwulan_2" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.realisasi_triwulan_2" 
                    style="width:100%" 
                    value="<?php echo $req->realisasi_triwulan_2; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="realisasi_triwulan_3" class="left inline">realisasi Triwulan 3</label>
            </div>
            <div class="small-7 columns">
                <input name="realisasi_triwulan_3" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.realisasi_triwulan_3" 
                    style="width:100%" 
                    value="<?php echo $req->realisasi_triwulan_3; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="realisasi_triwulan_4" class="left inline">realisasi Triwulan 4</label>
            </div>
            <div class="small-7 columns">
                <input name="realisasi_triwulan_4" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.realisasi_triwulan_4" 
                    style="width:100%" 
                    value="<?php echo $req->realisasi_triwulan_4; ?>"></input>
            </div>
        </div>
    </div>
        <input type="hidden" name="id" value="<?php echo $req->id; ?>">
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;