<script type="text/javascript">
    var rekening, state, eselon, parents, kd_unit, kd_subunit;
</script>   
<div class="easyui-layout main" data-options="fit:true">
        <div data-options="region:'center',title:'Data Master Evaluasi Kinerja'">
            <div class="easyui-tabs xtab" data-options="fit:true,
                border:false,
                plain:true,
                tabPosition:'left',
                onSelect: function(t,i) {
                    if (i==0) {
                        $('.xtab').tabs('disableTab', 1);
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        $('.xtab').tabs('disableTab', 4);
                        $('.xtab').tabs('disableTab', 5);
                        rekening = 'organisasi';
                        $('.organisasi').datagrid('reload');
                    } else if (i==1) {
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        $('.xtab').tabs('disableTab', 4);
                        $('.xtab').tabs('disableTab', 5);
                        rekening = 'unit';
                        $('.unit').datagrid('reload');
                    } else if (i == 2) {
                        $('.xtab').tabs('disableTab', 3);
                        $('.xtab').tabs('disableTab', 4);
                        $('.xtab').tabs('disableTab', 5);
                        rekening = 'urusan';
                        $('.xurusan').datagrid('reload');
                    } else if (i == 3) {
                        $('.xtab').tabs('disableTab', 4);
                        $('.xtab').tabs('disableTab', 5);
                        rekening = 'bidang';
                        $('.xbidang').datagrid('reload');

                    } else if (i == 4) {
                        $('.xtab').tabs('disableTab', 5);
                        $('.xprogram').datagrid('reload');
                        rekening = 'program';
                    } else if (i == 5) {
                        rekening = 'kegiatan';
                    }

            }">
                <!-- Tab Organisasi / SKPD -->
                <div title="Organisasi">                    
                    <table class="easyui-datagrid organisasi"
                            data-options="url:'store/evaluasi_anggaran/list_organisasi.php',
                                method:'post',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kd_urusan',
                                queryParams : {
                                    <?php echo App::filterUserOrganisasi($session->role, $session->kd_subunit); ?>
                                },
                                onDblClickRow: function(i,r) {
                                     xUrusan = r.kd_urusan;
                                     $('.xtab').tabs('enableTab', 1);
                                     $('.unit').datagrid({
                                        queryParams:{
                                            kode : r.kode
                                            <?php echo App::filterUserSubOrganisasi($session->role, $session->kd_subunit, 'prefix'); ?>
                                        }
                                     });
                                     kd_unit = r.kode;
                                     kd_subunit = 1;
                                     $('.xtab').tabs('select', 1);
                                }"
                                >
                        <thead>
                            <tr>
                                <th data-options="rowspan:2,field:'kode',align:'center'" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'nama'" width="300">Uraian Nama Unit Organisasi</th>
                                <th data-options="rowspan:2,field:'pagu_anggaran',
                                    formatter: function(value,row,index){
                                        if (row.pagu_anggaran){
                                            return accounting.formatNumber(row.pagu_anggaran,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">Pagu Anggaran</th>
                                <th data-options="colspan:4">Realisasi Per Triwulan</th>
                            </tr>
                            <tr>
                                <th data-options="field:'realisasi_triwulan_1',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_1){
                                            return accounting.formatNumber(row.realisasi_triwulan_1,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">I</th>
                                <th data-options="field:'realisasi_triwulan_2',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_2){
                                            return accounting.formatNumber(row.realisasi_triwulan_2,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">II</th>
                                <th data-options="field:'realisasi_triwulan_3',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_3){
                                            return accounting.formatNumber(row.realisasi_triwulan_3,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">III</th>
                                <th data-options="field:'realisasi_triwulan_4',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_4){
                                            return accounting.formatNumber(row.realisasi_triwulan_4,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">IV</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- End Tab Organisasi -->
                <div title="Unit Organisasi">                    
                    <table class="easyui-datagrid unit"
                            data-options="url:'store/evaluasi_anggaran/list_subunit.php',
                                method:'post',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kd_urusan',
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 2);
                                     $('.xurusan').datagrid({
                                        queryParams:{
                                            kode : r.kd_unit,
                                            kd_subunit : r.kd_subunit
                                        }
                                     });
                                     kd_unit = r.kode;
                                     kd_subunit = r.kd_subunit;
                                     $('.xtab').tabs('select', 2);
                                }"
                                >
                        <thead>
                                                        <tr>
                                <th data-options="rowspan:2,field:'kd_subunit',align:'center'" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'kd_unit',hidden:true" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'nama'" width="300">Uraian Nama Sub Unit Organisasi</th>
                                <th data-options="rowspan:2,field:'pagu_anggaran',
                                    formatter: function(value,row,index){
                                        if (row.pagu_anggaran){
                                            return accounting.formatNumber(row.pagu_anggaran,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">Pagu Anggaran</th>
                                <th data-options="colspan:4">Realisasi Per Triwulan</th>
                            </tr>
                            <tr>
                                <th data-options="field:'realisasi_triwulan_1',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_1){
                                            return accounting.formatNumber(row.realisasi_triwulan_1,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">I</th>
                                <th data-options="field:'realisasi_triwulan_2',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_2){
                                            return accounting.formatNumber(row.realisasi_triwulan_2,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">II</th>
                                <th data-options="field:'realisasi_triwulan_3',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_3){
                                            return accounting.formatNumber(row.realisasi_triwulan_3,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">III</th>
                                <th data-options="field:'realisasi_triwulan_4',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_4){
                                            return accounting.formatNumber(row.realisasi_triwulan_4,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">IV</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Urusan">                    
                    <table class="easyui-datagrid xurusan"
                            data-options="url:'store/evaluasi_anggaran/list_urusan.php',
                                method:'post',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kd_urusan',
                                onSelect : function (i,r) {
                                },
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 3);
                                     $('.xbidang').datagrid({
                                        queryParams:{
                                            kode : r.kd_unit,
                                            kd_subunit : r.kode,
                                            kd_urusan : r.kd_urusan
                                        }
                                     });
                                     $('.xtab').tabs('select', 3);
                                }"
                                >
                        <thead>
                            <tr>
                                <th data-options="rowspan:2,field:'kode',hidden:true" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'kd_unit',hidden:true" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'kd_urusan',align:'center'" width="80">Urusan</th>
                                <th data-options="rowspan:2,field:'nm_urusan'" width="300">Uraian Nama Urusan</th>
                                <th data-options="rowspan:2,field:'pagu_anggaran',
                                    formatter: function(value,row,index){
                                        if (row.pagu_anggaran){
                                            return accounting.formatNumber(row.pagu_anggaran,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">Pagu Anggaran</th>
                                <th data-options="colspan:4">Realisasi Per Triwulan</th>
                            </tr>
                            <tr>
                                <th data-options="field:'realisasi_triwulan_1',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_1){
                                            return accounting.formatNumber(row.realisasi_triwulan_1,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">I</th>
                                <th data-options="field:'realisasi_triwulan_2',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_2){
                                            return accounting.formatNumber(row.realisasi_triwulan_2,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">II</th>
                                <th data-options="field:'realisasi_triwulan_3',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_3){
                                            return accounting.formatNumber(row.realisasi_triwulan_3,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">III</th>
                                <th data-options="field:'realisasi_triwulan_4',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_4){
                                            return accounting.formatNumber(row.realisasi_triwulan_4,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">IV</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Bidang">
                    <table class="easyui-datagrid xbidang"
                            data-options="url:'store/evaluasi_anggaran/list_bidang.php',
                                method:'post',
                                queryParams:{
                                    kd_urusan : 0
                                },
                                idField:'kd_bidang',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 4);
                                     $('.xprogram').datagrid({
                                        queryParams:{
                                            kode : r.kd_unit,
                                            kd_subunit : r.kode,
                                            kd_urusan : r.kd_urusan,
                                            kd_bidang : r.kd_bidang
                                        }
                                     });
                                     $('.xtab').tabs('select', 4);
                                }">
                        <thead>
                            <tr>
                                <th data-options="rowspan:2,field:'kode',hidden:true" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'kd_unit',hidden:true" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'kd_urusan',align:'center'" width="80">Urusan</th>
                                <th data-options="rowspan:2,field:'kd_bidang',align:'center'" width="80">Bidang</th>
                                <th data-options="rowspan:2,field:'nm_bidang'" width="500">Uraian Nama Bidang</th>
                                <th data-options="rowspan:2,field:'pagu_anggaran',
                                    formatter: function(value,row,index){
                                        if (row.pagu_anggaran){
                                            return accounting.formatNumber(row.pagu_anggaran,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">Pagu Anggaran</th>
                                <th data-options="colspan:4">Realisasi Per Triwulan</th>
                            </tr>
                            <tr>
                                <th data-options="field:'realisasi_triwulan_1',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_1){
                                            return accounting.formatNumber(row.realisasi_triwulan_1,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">I</th>
                                <th data-options="field:'realisasi_triwulan_2',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_2){
                                            return accounting.formatNumber(row.realisasi_triwulan_2,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">II</th>
                                <th data-options="field:'realisasi_triwulan_3',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_3){
                                            return accounting.formatNumber(row.realisasi_triwulan_3,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">III</th>
                                <th data-options="field:'realisasi_triwulan_4',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_4){
                                            return accounting.formatNumber(row.realisasi_triwulan_4,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">IV</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Program">
                    <table class="easyui-datagrid xprogram"
                            data-options="url:'store/evaluasi_anggaran/list_program.php',
                                method:'post',
                                queryParams:{
                                    kode : 0,
                                    kd_subunit : 0,
                                    kd_urusan : 0,
                                    kd_bidang : 0,
                                    kd_program : 0
                                },
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kd_program',
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 5);
                                     $('.xkegiatan').datagrid({
                                        queryParams:{
                                            kode : r.kd_unit,
                                            kd_subunit : r.kode,
                                            kd_urusan : r.kd_urusan,
                                            kd_bidang : r.kd_bidang,
                                            kd_program : r.kd_program
                                        }
                                     });
                                     $('.xtab').tabs('select', 5);
                                }">
                        <thead>
                            <tr>
                                <th data-options="rowspan:2,field:'kode',hidden:true" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'kd_unit',hidden:true" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'kd_urusan',align:'center'" width="80">Urusan</th>
                                <th data-options="rowspan:2,field:'kd_bidang',align:'center'" width="80">Bidang</th>
                                <th data-options="rowspan:2,field:'kd_program',align:'center'" width="80">Program</th>
                                <th data-options="rowspan:2,field:'nm_program'" width="500">Uraian Nama Program</th>
                                <th data-options="rowspan:2,field:'pagu_anggaran',
                                    formatter: function(value,row,index){
                                        if (row.pagu_anggaran){
                                            return accounting.formatNumber(row.pagu_anggaran,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">Pagu Anggaran</th>
                                
                                <th data-options="colspan:4">Realisasi Per Triwulan</th>
                            </tr>
                            <tr>
                                <th data-options="field:'realisasi_triwulan_1',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_1){
                                            return accounting.formatNumber(row.realisasi_triwulan_1,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">I</th>
                                <th data-options="field:'realisasi_triwulan_2',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_2){
                                            return accounting.formatNumber(row.realisasi_triwulan_2,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">II</th>
                                <th data-options="field:'realisasi_triwulan_3',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_3){
                                            return accounting.formatNumber(row.realisasi_triwulan_3,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">III</th>
                                <th data-options="field:'realisasi_triwulan_4',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_4){
                                            return accounting.formatNumber(row.realisasi_triwulan_4,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">IV</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Kegiatan">
                    <table class="easyui-datagrid xkegiatan"
                            data-options="url:'store/evaluasi_anggaran/list_kegiatan.php',
                                queryParams:{
                                    kd_urusan : 0,
                                    kd_bidang : 0,
                                    kd_program : 0
                                },
                                onDblClickRow: function(i,r) {
                                    $('#x-dialog').dialog({
                                        title : 'Edit Anggaran',
                                        width : 450,
                                        height : 300,
                                        href : 'store/evaluasi_anggaran/form_anggaran.php',
                                        queryParams : r,
                                        method: 'post',
                                        buttons:[{
                                            text:'Save',
                                            handler:function (){                            
                                                $('#fm').form('submit',{  
                                                    success: function(data){
                                                        var data = eval('(' + data + ')');
                                                        if (data.success){
                                                            $.messager.show({  
                                                                title: 'Status',  
                                                                msg: data.message  
                                                            });
                                                            $('.xkegiatan').datagrid('reload');
                                                            $('#x-dialog').dialog('close')
                                                        }
                                                        else {
                                                            $.messager.alert('Warning', data.message);
                                                        } 
                                                    } 
                                                });
                                                }
                                            },{
                                            text:'Close',
                                            handler:function(){
                                                $('#x-dialog').dialog('close')
                                            }
                                        }]
                                    });
                                },
                                method:'post',
                                singleSelect:true,
                                idField:'kd_kegiatan',
                                fit:true,
                                fitColumns:true">
                        <thead>
                            <tr>
                                <th data-options="rowspan:2,field:'kode',hidden:true" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'kd_unit',hidden:true" width="80">Kode</th>
                                <th data-options="rowspan:2,field:'kd_urusan',align:'center'" width="80">Urusan</th>
                                <th data-options="rowspan:2,field:'kd_bidang',align:'center'" width="80">Bidang</th>
                                <th data-options="rowspan:2,field:'kd_program',align:'center'" width="80">Program</th>
                                <th data-options="rowspan:2,field:'kd_kegiatan',align:'center'" width="80">Kegiatan</th>
                                <th data-options="rowspan:2,field:'nm_kegiatan'" width="300">Uraian Nama Kegiatan</th>
                                <th data-options="rowspan:2,field:'pagu_anggaran',
                                    formatter: function(value,row,index){
                                        if (row.pagu_anggaran){
                                            return accounting.formatNumber(row.pagu_anggaran,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="240">Pagu Anggaran</th>
                                <th data-options="colspan:4">Target Per Triwulan</th>
                                <th data-options="colspan:4">Realisasi Per Triwulan</th>
                            </tr>
                            <tr>
                                <th data-options="field:'target_triwulan_1',
                                    formatter: function(value,row,index){
                                        if (row.target_triwulan_1){
                                            return accounting.formatNumber(row.target_triwulan_1,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">I</th>
                                <th data-options="field:'target_triwulan_2',
                                    formatter: function(value,row,index){
                                        if (row.target_triwulan_2){
                                            return accounting.formatNumber(row.target_triwulan_2,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">II</th>
                                <th data-options="field:'target_triwulan_3',
                                    formatter: function(value,row,index){
                                        if (row.target_triwulan_3){
                                            return accounting.formatNumber(row.target_triwulan_3,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">III</th>
                                <th data-options="field:'target_triwulan_4',
                                    formatter: function(value,row,index){
                                        if (row.target_triwulan_4){
                                            return accounting.formatNumber(row.target_triwulan_4,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">IV</th>
                                <th data-options="field:'realisasi_triwulan_1',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_1){
                                            return accounting.formatNumber(row.realisasi_triwulan_1,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">I</th>
                                <th data-options="field:'realisasi_triwulan_2',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_2){
                                            return accounting.formatNumber(row.realisasi_triwulan_2,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">II</th>
                                <th data-options="field:'realisasi_triwulan_3',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_3){
                                            return accounting.formatNumber(row.realisasi_triwulan_3,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">III</th>
                                <th data-options="field:'realisasi_triwulan_4',
                                    formatter: function(value,row,index){
                                        if (row.realisasi_triwulan_4){
                                            return accounting.formatNumber(row.realisasi_triwulan_4,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    },
                                    align:'right'" 
                                    width="180">IV</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

    </script>