<script type="text/javascript">
    var rekening, state, parents, kd_unit;
</script>
<div class="easyui-layout" data-options="fit:true">
        <div data-options="region:'east',split:true" style="width:150px;">

        </div>
        <div data-options="region:'center',title:'Data Master Sasaran Organisasi'">
            <div class="easyui-tabs xtab" data-options="fit:true,
                border:false,
                plain:true,
                tabPosition:'left',
                onSelect: function(t,i) {
                    if (i==0) {
                        $('.xtab').tabs('disableTab', 1);
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        rekening = 'organisasi';
                    } else if (i==1) {
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        rekening = 'unit';
                    } else if (i == 2) {
                        $('.xtab').tabs('disableTab', 3);
                        $('.x-add').linkbutton({disabled:false});
                        rekening = 'sasaran';
                    } else if (i == 3) {
                        $('.x-add').linkbutton({disabled:false});
                        rekening = 'indikator';
                    }

            }">
                <div title="Organisasi">                    
                    <table class="easyui-datagrid organisasi"
                            data-options="url:'store/organisasi/list.php',
                                method:'post',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kd_urusan',
                                onDblClickRow: function(i,r) {
                                     xUrusan = r.kd_urusan;
                                     $('.xtab').tabs('enableTab', 1);
                                     $('.unit').datagrid({
                                        queryParams:{
                                            kode : r.kode
                                        }
                                     });
                                     parents = 0;
                                     kd_unit = r.kode;
                                     $('.xtab').tabs('select', 1);
                                }"
                                >
                        <thead>
                            <tr>
                                <th data-options="field:'kode',align:'center'" width="80">Kode</th>
                                <th data-options="field:'nama'" width="500">Uraian Nama Unit Organisasi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Unit Organisasi">                    
                    <table class="easyui-datagrid unit"
                            data-options="url:'store/organisasi/list.php',
                                method:'post',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kd_urusan',
                                onDblClickRow: function(i,r) {
                                     xUrusan = r.kd_urusan;
                                     $('.xtab').tabs('enableTab', 2);
                                     $('.sasaran').datagrid({
                                        queryParams:{
                                            kode : r.kode + r.kd_subunit
                                        }
                                     });
                                     kd_unit =r.kode + r.kd_subunit;
                                     $('.xtab').tabs('select', 2);
                                }"
                                >
                        <thead>
                            <tr>
                                <th data-options="field:'kode',hidden:true,align:'center'" width="80">Kode</th>
                                <th data-options="field:'kd_subunit',align:'center'" width="80">Kode</th>
                                <th data-options="field:'nama'" width="500">Uraian Nama Unit Organisasi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Sasaran">
                    <table class="easyui-datagrid sasaran"
                            data-options="url:'store/sasaran_skpd/list.php',
                                method:'post',
                                queryParams:{
                                    kode : 0
                                },
                                rownumbers:true,
                                idField:'id',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 3);
                                     $('.indikator').datagrid({
                                        queryParams:{
                                            sasaran_id : r.id
                                        }
                                     });
                                     $('.xtab').tabs('select', 3);
                                }">
                        <thead>
                            <tr>
                                <th data-options="field:'id',hidden:true" width="200">Unit Organisasi</th>
                                <th data-options="field:'kd_subunit',hidden:true" width="200">Unit Organisasi</th>
                                <th data-options="field:'sasaran',align:'left'" width="500">Sasaran</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Indikator">
                    <table class="easyui-datagrid indikator"
                            data-options="url:'store/sasaran_skpd/list_indikator.php',
                                method:'post',
                                queryParams:{
                                    sasarn_id : 0,
                                    kode : 0
                                },
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'id'
                               ">
                        <thead>
                            <tr>
                                <th data-options="field:'id',hidden:true" width="200">Unit Organisasi</th>
                                <th data-options="field:'indikator',align:'left'" width="400">Indikator</th>
                                <th data-options="field:'satuan_id',hidden:true" width="200">satuan</th>
                                <th data-options="field:'nm_satuan',align:'left'" width="200">satuan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        
        
    </script>