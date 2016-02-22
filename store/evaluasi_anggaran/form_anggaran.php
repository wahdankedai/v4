<?php 
require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
} 

$req = Common::obj(Request::all());
// echo "<pre>";print_r($req);exit;
$data = Suggest::targetAnggaran($session->tahun,$req->kd_urusan,$req->kd_bidang,$req->kd_program,$req->kd_kegiatan,$req->kd_unit,$req->kode);
// print_r($data);exit;
?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/evaluasi_anggaran/proses_anggaran.php"
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
                    value="<?php echo $data->target_triwulan_1; ?>"></input>
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
                    value="<?php echo $data->target_triwulan_2; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="target_triwulan_3" class="left inline">Target Triwulan 2</label>
            </div>
            <div class="small-7 columns">
                <input name="target_triwulan_3" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.target_triwulan_3" 
                    style="width:100%" 
                    value="<?php echo $data->target_triwulan_3; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="target_triwulan_4" class="left inline">Target Triwulan 2</label>
            </div>
            <div class="small-7 columns">
                <input name="target_triwulan_4" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.target_triwulan_4" 
                    style="width:100%" 
                    value="<?php echo $data->target_triwulan_4; ?>"></input>
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
                    value="<?php echo $data->realisasi_triwulan_1; ?>"></input>
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
                    value="<?php echo $data->realisasi_triwulan_2; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="realisasi_triwulan_3" class="left inline">realisasi Triwulan 2</label>
            </div>
            <div class="small-7 columns">
                <input name="realisasi_triwulan_3" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.realisasi_triwulan_3" 
                    style="width:100%" 
                    value="<?php echo $data->realisasi_triwulan_3; ?>"></input>
            </div>
        </div>
        <div class="row mb20">
            <div class="small-5 columns">
                <label for="realisasi_triwulan_4" class="left inline">realisasi Triwulan 2</label>
            </div>
            <div class="small-7 columns">
                <input name="realisasi_triwulan_4" 
                    class="easyui-numberbox" 
                    data-options="
                        groupSeparator:'.',
                        decimalSeparator:',',
                        readonly : ! configApp.evaluasi.anggaran.realisasi_triwulan_4" 
                    style="width:100%" 
                    value="<?php echo $data->realisasi_triwulan_4; ?>"></input>
            </div>
        </div>
    </div>
        <input type="hidden" name="kd_sub_unit" value="<?php echo $req->kode; ?>">
        <input type="hidden" name="kd_unit" value="<?php echo $req->kd_unit; ?>">
        <input type="hidden" name="kd_urusan" value="<?php echo $req->kd_urusan; ?>">
        <input type="hidden" name="kd_bidang" value="<?php echo $req->kd_bidang; ?>">
        <input type="hidden" name="kd_program" value="<?php echo $req->kd_program; ?>">
        <input type="hidden" name="kd_kegiatan" value="<?php echo $req->kd_kegiatan; ?>">
        <input type="hidden" name="tahun" value="<?php echo $session->tahun; ?>">
</form>

<script type="text/javascript">
    
</script>

<?php 
exit;