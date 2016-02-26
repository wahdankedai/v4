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
                $('#x-dialog').dialog({
                    title: 'Konfigurasi ' + r.nm_laporan,
                    width: 400,
                    height: 170,
                    href: 'store/report/form.php',
                    queryParams : r,
                    method: 'post',
                    modal: true
                });
            }">
    <thead>
        <tr>
            <th data-options="field:'nm_laporan',width:100">Nama Laporan</th>
        </tr>
    </thead>
</table>