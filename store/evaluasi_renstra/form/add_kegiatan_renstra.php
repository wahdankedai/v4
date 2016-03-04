<?php 
require '../../../boot.php';

require '../../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$req = Common::obj(Request::all());

?>
        

    <div class="row p10" style="height:250px">
        <table class="list-kegiatan easyui-datagrid" data-options="fit:true,
            fitColumns:true,
            title:'List Kegiatan',
            checkbox:true,
            checkOnSelect:true,
            selectOnCheck:true,
            queryParams : {
                kd_unit : '<?php echo $req->kd_unit; ?>',
                kd_subunit : '<?php echo $req->kd_subunit; ?>',
                kd_program : '<?php echo ($req->kd_urusan.$req->kd_bidang.$req->kd_program); ?>'
            },
            url: 'store/evaluasi_renstra/list_kegiatan_renstra.php'
            ">
             <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true"></th>
                    <th data-options="hidden:true,field:'kd_kegiatan',align:'center'" width="80">Kode</th>
                    <th data-options="field:'kode',align:'center'" width="80">Kode</th>
                    <th data-options="field:'nm_kegiatan'" width="500">Uraian Nama Kegiatan</th>
                </tr>
            </thead>
        </table>
    </div>
        <input type="hidden" name="kd_unit" value="<?php echo $req->kd_unit; ?>">
        <input type="hidden" name="kd_subunit" value="<?php echo $req->kd_subunit; ?>">

<script type="text/javascript">
    
</script>

<?php 
exit;