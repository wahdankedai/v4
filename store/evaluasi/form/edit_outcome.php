<?php 
require '../../../boot.php';

require '../../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$req = Common::obj(Request::all());


?>
<form id="fm" method="post" 
    class="easyui-form" 
    method="post" 
    data-options="novalidate:true" 
    action="<?php echo BASE_URL; ?>store/evaluasi/edit_outcome.php"
>
    <div class="row p10">
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="indikator" class="left inline">Indikator</label>
            </div>
            <div class="small-9 columns">
                <input name="indikator" id="indikator" class="easyui-combobox" data-options="
                            valueField: 'indikator',
                            textField: 'indikator',
                            queryParams : {
                                kd_program : <?php echo $req->kd_program; ?>
                            },
                            width: '100%',
                            hasDownArrow : false,
                            onSelect : function(r) {
                                $('#satuan').combobox('setValue', r.satuan);
                            },
                            url: BASE_URL + 'store/evaluasi/suggest/outcome.php'" />
            </div>
        </div>
        <div class="row mb20">
            <div class="small-3 columns">
                <label for="satuan" class="left inline">Satuan</label>
            </div>
            <div class="small-9 columns">
                <input name="satuan" id="satuan" class="easyui-combobox" data-options="
                            valueField: 'id',
                            textField: 'nm_satuan',
                            url: BASE_URL + 'store/satuan/list.php'" />
            </div>
        </div>
    </div>
        <input type="hidden" name="id" value="<?php echo $req->id; ?>">
</form>

<script type="text/javascript">
    // $("#satuan").combobox('setValue', <?php echo $req->satuan; ?>);
    // $("#indikator").combobox('setValue', '<?php echo $req->indikator; ?>');
</script>

<?php 
exit;