<table class="easyui-datagrid" 
        data-options="title:'List Laporan ' + selectedModul.name,
            url:'store/report/list.php',
            queryParams: {
                modul_id : selectedModul.id
            },
            fit:true,
            rownumbers: true,
            fitColumns:true,
            singleSelect:true,
            onDblClickRow: function (i,r) {
                r.kd_subunit = <?php echo $session->kd_subunit; ?> ;
                r.role = '<?php echo $session->role; ?>' ;
                $('#x-dialog').dialog({
                    title: 'Konfigurasi ' + r.nm_laporan,
                    width: 400,
                    height: 180,
                    href: 'store/report/form.php',
                    queryParams : r,
                    method: 'post',
                    modal: true,
                    toolbar : '',
                    buttons : ''
                });
            }">
    <thead>
        <tr>
            <th data-options="field:'nm_laporan',width:100">Nama Laporan</th>
        </tr>
    </thead>
</table>