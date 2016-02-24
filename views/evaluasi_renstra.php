<script type="text/javascript">
    var rekening, state, eselon, parents, kd_unit, kd_subunit;
</script>   
<div class="easyui-layout main" data-options="fit:true">

        <!-- Panel untuk Indikator -->
        <div data-options="region:'east',split:true,collapsible:false" title="Indikator" style="width:55%;">
            <div class="easyui-layout main-indikator" data-options="fit:true">
                <div data-options="region:'north',split:false,collapsible:false"style="height:410px;">
                    <table class="xindikator">
                    </table>
                </div>
                <div data-options="region:'center',title:'Target dan Realiasasi Outcome'">
                    <div class="layoutIndikator easyui-accordion" data-options="fit:true">
                        <div title="Target">
                            <table class="indikatorTarget">
                            </table>
                        </div>
                        <div title="Realisasi">
                            <table class="indikatorRealisasi">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel untuk Indikator -->
        <div data-options="region:'south',split:true,collapsible:false" style="height:15%;">
            <div class="row p10">
                <div class="small-4 columns"> 
                    Pilih Program
                </div>
                <div class="small-8 columns"> 
                    <input class="pilihan easyui-combobox"
                        data-options="valueField:'kode',textField:'oke',url:'store/evaluasi_renstra/combo.php'">
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div data-options="region:'center',title:'Data Master Evaluasi Kinerja'">
            <div class="easyui-tabs xtab" data-options="fit:true,
                border:false,
                plain:true,
                tabPosition:'left',
                onSelect: function(t,i) {
                    var panelEast = $('.main').layout('panel', 'east');
                    if (i==0) {
                        $('.xtab').tabs('disableTab', 1);
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        $('.xtab').tabs('disableTab', 4);
                        $('.xtab').tabs('disableTab', 5);
                        rekening = 'organisasi';
                        $('.main').layout('collapse', 'east');
                    } else if (i==1) {
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        $('.xtab').tabs('disableTab', 4);
                        $('.xtab').tabs('disableTab', 5);
                        rekening = 'unit';
                        $('.main').layout('collapse', 'east');
                    } else if (i == 2) {
                        $('.xtab').tabs('disableTab', 3);
                        $('.xtab').tabs('disableTab', 4);
                        $('.xtab').tabs('disableTab', 5);
                        rekening = 'urusan';
                        $('.main').layout('collapse', 'east');
                    } else if (i == 3) {
                        $('.xtab').tabs('disableTab', 4);
                        $('.xtab').tabs('disableTab', 5);
                        $('.main').layout('collapse', 'east');
                        rekening = 'bidang';

                    } else if (i == 4) {
                        $('.xtab').tabs('disableTab', 5);
                        panelEast.panel('setTitle', 'Indokator Outcome')
                        $('.main').layout('expand', 'east');
                        $('.xindikator').datagrid({
                            fit:true,
                            rownumbers:true,
                            singleSelect:true,
                            toolbar: '',
                            url:'store/evaluasi_renstra/list_indikator_outcome.php',
                            queryParams : {
                                kd_unit : 0,
                                kd_subunit : 0,
                                kd_program : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true },
                                {field:'kd_unit',title:'kd_unit',width:100,hidden:true },
                                {field:'satuan',title:'satuan',width:100,hidden:true },
                                {field:'kd_subunit',title:'kd_subunit',width:100,hidden:true },
                                {field:'kd_program',title:'kd_program',width:100,hidden:true },
                                {field:'indikator',title:'Indikator',width:350},
                                {field:'nm_satuan',title:'Satuan',width:100}
                            ]],
                            onSelect : function(i,r) {
                                $('.indikatorTarget,.indikatorRealisasi').datagrid({
                                    queryParams: {
                                        id : r.id
                                    }
                                });
                            }
                        });
                        $('.indikatorTarget').datagrid({
                            fit:true,
                            singleSelect:true,
                            url:'store/evaluasi_renstra/list_target_outcome.php',
                            queryParams : {
                                id : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'unit_eselon_id',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'id_indikator',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'tahun',title:'tahun',width:100,hidden:true,rowspan:2 },
                                {title:'Target',colspan:4},
                                {field:'unit_organisasi',title:'Organisasi',width:120,rowspan:2 },
                                {field:'person',title:'Penanggungjawab',width:120,rowspan:2 },
                            ],[
                                {field:'target_triwulan_1',title:'I',width:50,align:'center'},
                                {field:'target_triwulan_2',title:'II',width:50,align:'center'},
                                {field:'target_triwulan_3',title:'III',width:50,align:'center'},
                                {field:'target_triwulan_4',title:'IV',width:50,align:'center'}
                            ]],
                            onSelect : function(i,r) {
                                console.log(i);
                            },
                            onDblClickRow : function(i,r) {
                                var indikator = $('.xindikator').datagrid('getSelected');

                                if(indikator) {
                                    $('#x-dialog').dialog({
                                        title : 'Target dan Penanggungjawab ' + indikator.indikator,
                                        href : 'store/evaluasi_renstra/form/target_outcome.php',
                                        method: 'post',
                                        width: 500,
                                        height:300,
                                        modal:true,
                                        queryParams : {
                                            id : r.id,
                                            id_indikator : indikator.id,
                                            unit_eselon_id : r.unit_eselon_id,
                                            nm_satuan : indikator.nm_satuan
                                        },
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
                                                            $('.indikatorTarget').datagrid('reload');
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
                                        }],
                                        onLoad : function() {

                                        }
                                    });
                                }
                            }
                        });
                        $('.indikatorRealisasi').datagrid({
                            fit:true,
                            singleSelect:true,
                            url:'store/evaluasi_renstra/list_target_outcome.php',
                            queryParams : {
                                id : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'unit_eselon_id',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'id_indikator',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'tahun',title:'tahun',width:100,hidden:true,rowspan:2 },
                                {title:'Target',colspan:4},
                                {title:'Realisasi',colspan:4}
                            ],[
                                {field:'target_triwulan_1',title:'I',width:50,align:'center'},
                                {field:'target_triwulan_2',title:'II',width:50,align:'center'},
                                {field:'target_triwulan_3',title:'III',width:50,align:'center'},
                                {field:'target_triwulan_4',title:'IV',width:50,align:'center'},
                                {field:'realisasi_triwulan_1',title:'I',width:50,align:'center'},
                                {field:'realisasi_triwulan_2',title:'II',width:50,align:'center'},
                                {field:'realisasi_triwulan_3',title:'III',width:50,align:'center'},
                                {field:'realisasi_triwulan_4',title:'IV',width:50,align:'center'}
                            ]],
                            onSelect : function(i,r) {
                                console.log(i);
                            },
                            onDblClickRow : function(i,r) {
                                if (r.id == '') {
                                    $.messager.alert('Warning', 'Harap Isi Target terlebih dahulu!');
                                    return;
                                }
                                var indikator = $('.xindikator').datagrid('getSelected');
                                if(indikator) {
                                    $('#x-dialog').dialog({
                                        title : 'Realisasi ' + indikator.indikator,
                                        href : 'store/evaluasi_renstra/form/realisasi_target_outcome.php',
                                        method: 'post',
                                        width: 500,
                                        height:300,
                                        modal:true,
                                        queryParams : {
                                            id : r.id,
                                            id_indikator : indikator.id,
                                            unit_eselon_id : r.unit_eselon_id,
                                            nm_satuan : indikator.nm_satuan
                                        },
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
                                                            $('.indikatorRealisasi').datagrid('reload');
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
                                        }],
                                        onLoad : function() {

                                        }
                                    });
                                }
                            }
                        });
                        rekening = 'program';
                    } else if (i == 5) {
                        panelEast.panel('setTitle', 'Indokator Output')
                        $('.main').layout('expand', 'east');
                        rekening = 'kegiatan';
                        $('.xindikator').datagrid({
                            fit:true,
                            toolbar: '',
                            singleSelect:true,
                            url:'store/evaluasi_renstra/list_indikator_output.php',
                            queryParams : {
                                kd_unit : 0,
                                kd_subunit : 0,
                                kd_kegiatan : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true },
                                {field:'kd_unit',title:'kd_unit',width:100,hidden:true },
                                {field:'satuan',title:'satuan',width:100,hidden:true },
                                {field:'kd_subunit',title:'kd_subunit',width:100,hidden:true },
                                {field:'kd_program',title:'kd_kegiatan',width:100,hidden:true },
                                {field:'indikator',title:'Indikator',width:350},
                                {field:'nm_satuan',title:'Satuan',width:100}
                            ]]
                        });
                        $('.indikatorTarget').datagrid({
                            fit:true,
                            singleSelect:true,
                            url:'store/evaluasi_renstra/list_target_output.php',
                            queryParams : {
                                id : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'unit_eselon_id',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'id_indikator',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'tahun',title:'tahun',width:100,hidden:true,rowspan:2 },
                                {title:'Target',colspan:4},
                                {field:'unit_organisasi',title:'Organisasi',width:120,rowspan:2 },
                                {field:'person',title:'Penanggungjawab',width:120,rowspan:2 },
                            ],[
                                {field:'target_triwulan_1',title:'I',width:50,align:'center'},
                                {field:'target_triwulan_2',title:'II',width:50,align:'center'},
                                {field:'target_triwulan_3',title:'III',width:50,align:'center'},
                                {field:'target_triwulan_4',title:'IV',width:50,align:'center'}
                            ]],
                            onDblClickRow : function(i,r) {
                                var indikator = $('.xindikator').datagrid('getSelected');

                                if(indikator) {
                                    $('#x-dialog').dialog({
                                        title : 'Target dan Penanggungjawab ' + indikator.indikator,
                                        href : 'store/evaluasi_renstra/form/target_output.php',
                                        method: 'post',
                                        width: 500,
                                        height:300,
                                        modal:true,
                                        queryParams : {
                                            id : r.id,
                                            id_indikator : indikator.id,
                                            unit_eselon_id : r.unit_eselon_id,
                                            nm_satuan : indikator.nm_satuan
                                        },
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
                                                            $('.indikatorTarget').datagrid('reload');
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
                                        }],
                                        onLoad : function() {

                                        }
                                    });
                                }
                            }
                        });
                        $('.indikatorRealisasi').datagrid({
                            fit:true,
                            singleSelect:true,
                            url:'store/evaluasi_renstra/list_target_output.php',
                            queryParams : {
                                id : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'unit_eselon_id',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'id_indikator',title:'id',width:100,hidden:true,rowspan:2 },
                                {field:'tahun',title:'tahun',width:100,hidden:true,rowspan:2 },
                                {title:'Target',colspan:4},
                                {title:'Realisasi',colspan:4}
                            ],[
                                {field:'target_triwulan_1',title:'I',width:50,align:'center'},
                                {field:'target_triwulan_2',title:'II',width:50,align:'center'},
                                {field:'target_triwulan_3',title:'III',width:50,align:'center'},
                                {field:'target_triwulan_4',title:'IV',width:50,align:'center'},
                                {field:'realisasi_triwulan_1',title:'I',width:50,align:'center'},
                                {field:'realisasi_triwulan_2',title:'II',width:50,align:'center'},
                                {field:'realisasi_triwulan_3',title:'III',width:50,align:'center'},
                                {field:'realisasi_triwulan_4',title:'IV',width:50,align:'center'}
                            ]],
                            onDblClickRow : function(i,r) {
                                var indikator = $('.xindikator').datagrid('getSelected');
                                if (r.id == '') {
                                    $.messager.alert('Warning', 'Harap Isi Target terlebih dahulu!');
                                    return;
                                }
                                if(indikator) {
                                    $('#x-dialog').dialog({
                                        title : 'Realisasi ' + indikator.indikator,
                                        href : 'store/evaluasi_renstra/form/realisasi_target_output.php',
                                        method: 'post',
                                        width: 500,
                                        height:300,
                                        modal:true,
                                        queryParams : {
                                            id : r.id,
                                            id_indikator : indikator.id,
                                            unit_eselon_id : r.unit_eselon_id,
                                            nm_satuan : indikator.nm_satuan
                                        },
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
                                                            $('.indikatorRealisasi').datagrid('reload');
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
                                        }],
                                        onLoad : function() {

                                        }
                                    });
                                }
                            }
                        });

                    }

            }">
                <!-- Tab Organisasi / SKPD -->
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
                                     kd_subunit = 1;
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
                <!-- End Tab Organisasi -->
                <div title="Unit Organisasi">                    
                    <table class="easyui-datagrid unit"
                            data-options="url:'store/organisasi/list.php',
                                method:'post',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kd_urusan',
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 2);
                                     $('.xurusan').datagrid({
                                        queryParams:{
                                            kode : r.kode,
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
                                <th data-options="field:'kode',hidden:true,align:'center'" width="80">Kode</th>
                                <th data-options="field:'kd_subunit',align:'center'" width="80">Kode</th>
                                <th data-options="field:'nama'" width="500">Uraian Nama Unit Organisasi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Urusan">                    
                    <table class="easyui-datagrid xurusan"
                            data-options="url:'store/evaluasi_renstra/list_urusan.php',
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
                                            kode : kd_unit,
                                            kd_subunit : kd_subunit,
                                            kd_urusan : r.kd_urusan
                                        }
                                     });
                                     $('.xtab').tabs('select', 3);
                                }"
                                >
                        <thead>
                            <tr>
                                <th data-options="field:'kd_urusan',align:'center'" width="80">Urusan</th>
                                <th data-options="field:'nm_urusan'" width="500">Uraian Nama Urusan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Bidang">
                    <table class="easyui-datagrid xbidang"
                            data-options="url:'store/evaluasi_renstra/list_bidang.php',
                                method:'post',
                                queryParams:{
                                    kd_urusan : 0
                                },
                                idField:'kd_bidang',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                onSelect : function (i,r) {
                                    
                                },
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 4);
                                     $('.xprogram').datagrid({
                                        queryParams:{
                                            kode : kd_unit,
                                            kd_subunit : kd_subunit,
                                            kd_urusan : r.kd_urusan,
                                            kd_bidang : r.kd_bidang,
                                        }
                                     });
                                     $('.xtab').tabs('select', 4);
                                }">
                        <thead>
                            <tr>
                                <th data-options="field:'kd_urusan',align:'center'" width="80">Urusan</th>
                                <th data-options="field:'kd_bidang',align:'center'" width="80">Bidang</th>
                                <th data-options="field:'nm_bidang'" width="500">Uraian Nama Bidang</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Program">
                    <table class="easyui-datagrid xprogram"
                            data-options="url:'store/evaluasi_renstra/list_program.php',
                                method:'post',
                                queryParams:{
                                    kd_urusan : 0,
                                    kd_bidang : 0
                                },
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kd_program',
                                onSelect : function (i,r) {
                                    $('.indikatorTarget,.indikatorRealisasi').datagrid({
                                        queryParams: {
                                            id : 0
                                        }
                                    });
                                     $('.xindikator').datagrid({
                                        toolbar : [{
                                            text:'Tambah',
                                            disabled: ! configApp.evaluasi.add_indikator_outcome,
                                            iconCls: 'icon-add',
                                            handler: function(){
                                                $('#x-dialog').dialog({
                                                    title: 'Tambah Indikator',
                                                    width: 450,
                                                    height: 180,
                                                    modal:true,
                                                    method:'post',
                                                    href: BASE_URL+ 'store/evaluasi_renstra/form/add_outcome.php',
                                                    queryParams: {
                                                        kd_unit : kd_unit,
                                                        kd_subunit : kd_subunit,
                                                        kd_program : r.kd_urusan + r.kd_bidang +r.kd_program
                                                    },
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
                                                                        $('.xindikator').datagrid('reload');
                                                                        $('.indikatorTarget').datagrid({
                                                                            queryParams : {id:0}
                                                                        });
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
                                                    }],
                                                    onLoad: function() {
                                                        $('#indikator').combobox('textbox').focus(); 
                                                    }
                                                });
                                            }
                                        },'-',{
                                            text:'Edit',
                                            disabled : ! configApp.evaluasi.edit_indikator_outcome,
                                            iconCls: 'icon-edit',
                                            handler: function(){
                                                var row = $('.xindikator').datagrid('getSelected');
                                                if(! row) {
                                                    console.log('Harap Pilih data yang akan di edit');
                                                    return;
                                                }

                                                $('#x-dialog').dialog({
                                                    title: 'Edit Indikator',
                                                    width: 450,
                                                    height: 180,
                                                    modal:true,
                                                    method:'post',
                                                    href: BASE_URL+ 'store/evaluasi_renstra/form/edit_outcome.php',
                                                    queryParams: row,
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
                                                                        $('.xindikator').datagrid('reload');
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
                                                    }],
                                                    onLoad: function() {
                                                        $('#indikator').combobox('textbox').focus(); 
                                                        $('#indikator').combobox('setValue', row.indikator); 
                                                        $('#satuan').combobox('setValue', row.satuan); 
                                                    }
                                                });
                                                
                                            }
                                        },'-',{
                                            text:'Hapus',
                                            disabled : ! configApp.evaluasi.delete_indikator_outcome,
                                            iconCls: 'icon-remove',
                                            handler: function(){
                                                var row = $('.xindikator').datagrid('getSelected');
                                                if(! row) {
                                                    console.log('Harap Pilih data yang akan di hapus');
                                                    return;
                                                }
                                                $.messager.confirm('Hapus data Indikator', 'Apakah Anda yakin bahwa data tersebut akan anda hapus?', function(r){
                                                    if (r)
                                                    {
                                                        $.post(BASE_URL + 'store/evaluasi_renstra/delete_outcome.php', {
                                                            id : row.id
                                                        },
                                                        function (d) {
                                                            var data = eval('(' + d + ')');
                                                                if (data.success) {
                                                                    $.messager.show({  
                                                                        title: 'Status',  
                                                                        msg: data.message  
                                                                    });
                                                                    $('.xindikator').datagrid('reload');
                                                                }
                                                                else {
                                                                    $.messager.alert('Warning', data.message);
                                                                } 
                                                        });
                                                    }
                                                });
                                            }
                                        }],
                                        queryParams : {
                                            kd_unit : kd_unit,
                                            kd_subunit : kd_subunit,
                                            kd_program : r.kd_urusan + r.kd_bidang +r.kd_program
                                        }
                                    });
                                },
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 5);
                                     $('.xkegiatan').datagrid({
                                        queryParams:{
                                            kode : kd_unit,
                                            kd_subunit : kd_subunit,
                                            kd_urusan : r.kd_urusan,
                                            kd_bidang : r.kd_bidang,
                                            kd_program : r.kd_program
                                        }
                                     });
                                     $('.xtab').tabs('select', 5);
                                }">
                        <thead>
                            <tr>
                                <th data-options="field:'kd_urusan',align:'center'" width="80">Urusan</th>
                                <th data-options="field:'kd_bidang',align:'center'" width="80">Bidang</th>
                                <th data-options="field:'kd_program',align:'center'" width="80">Program</th>
                                <th data-options="field:'nm_program'" width="500">Uraian Nama Program</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Kegiatan">
                    <table class="easyui-datagrid xkegiatan"
                            data-options="url:'store/evaluasi_renstra/list_kegiatan.php',
                                queryParams:{
                                    kd_urusan : 0,
                                    kd_bidang : 0,
                                    kd_program : 0
                                },
                                method:'post',
                                singleSelect:true,
                                idField:'kd_kegiatan',
                                fit:true,
                                fitColumns:true,
                                onSelect : function (i,r) {
                                    $('.indikatorTarget,.indikatorRealisasi').datagrid({
                                        queryParams: {
                                            id : 0
                                        }
                                    });
                                     $('.xindikator').datagrid({
                                        toolbar : [{
                                            text:'Tambah',
                                            disabled: ! configApp.evaluasi.add_indikator_output,
                                            iconCls: 'icon-add',
                                            handler: function(){
                                                $('#x-dialog').dialog({
                                                    title: 'Tambah Indikator',
                                                    width: 450,
                                                    height: 180,
                                                    modal:true,
                                                    method:'post',
                                                    href: BASE_URL+ 'store/evaluasi_renstra/form/add_output.php',
                                                    queryParams: {
                                                        kd_unit : kd_unit,
                                                        kd_subunit : kd_subunit,
                                                        kd_kegiatan : r.kd_urusan + r.kd_bidang +r.kd_program + r.kd_kegiatan
                                                    },
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
                                                                        $('.xindikator').datagrid('reload');
                                                                        $('.indikatorTarget').datagrid({
                                                                            queryParams : {id:0}
                                                                        });
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
                                                    }],
                                                    onLoad: function() {
                                                        $('#indikator').combobox('textbox').focus(); 
                                                    }
                                                });
                                            }
                                        },'-',{
                                            text:'Edit',
                                            disabled : ! configApp.evaluasi.edit_indikator_output,
                                            iconCls: 'icon-edit',
                                            handler: function(){
                                                var row = $('.xindikator').datagrid('getSelected');
                                                if(! row) {
                                                    console.log('Harap Pilih data yang akan di edit');
                                                    return;
                                                }

                                                $('#x-dialog').dialog({
                                                    title: 'Edit Indikator',
                                                    width: 450,
                                                    height: 180,
                                                    modal:true,
                                                    method:'post',
                                                    href: BASE_URL+ 'store/evaluasi_renstra/form/edit_output.php',
                                                    queryParams: row,
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
                                                                        $('.xindikator').datagrid('reload');
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
                                                    }],
                                                    onLoad: function() {
                                                        $('#indikator').combobox('textbox').focus(); 
                                                        $('#indikator').combobox('setValue', row.indikator); 
                                                        $('#satuan').combobox('setValue', row.satuan); 
                                                    }
                                                });
                                                
                                            }
                                        },'-',{
                                            text:'Hapus',
                                            disabled : ! configApp.evaluasi.delete_indikator_output,
                                            iconCls: 'icon-remove',
                                            handler: function(){
                                                var row = $('.xindikator').datagrid('getSelected');
                                                if(! row) {
                                                    console.log('Harap Pilih data yang akan di hapus');
                                                    return;
                                                }
                                                $.messager.confirm('Hapus data Indikator', 'Apakah Anda yakin bahwa data tersebut akan anda hapus?', function(r){
                                                    if (r)
                                                    {
                                                        $.post(BASE_URL + 'store/evaluasi_renstra/delete_output.php', {
                                                            id : row.id
                                                        },
                                                        function (d) {
                                                            var data = eval('(' + d + ')');
                                                                if (data.success) {
                                                                    $.messager.show({  
                                                                        title: 'Status',  
                                                                        msg: data.message  
                                                                    });
                                                                    $('.xindikator').datagrid('reload');
                                                                }
                                                                else {
                                                                    $.messager.alert('Warning', data.message);
                                                                } 
                                                        });
                                                    }
                                                });
                                            }
                                        }],
                                        queryParams : {
                                            kd_unit : kd_unit,
                                            kd_subunit : kd_subunit,
                                            kd_kegiatan : r.kd_urusan + r.kd_bidang +r.kd_program + r.kd_kegiatan
                                        }
                                    });
                                },">
                        <thead>
                            <tr>
                                <th data-options="field:'kd_urusan',align:'center'" width="80">Urusan</th>
                                <th data-options="field:'kd_bidang',align:'center'" width="80">Bidang</th>
                                <th data-options="field:'kd_program',align:'center'" width="80">Program</th>
                                <th data-options="field:'kd_kegiatan',align:'center'" width="80">Kegiatan</th>
                                <th data-options="field:'nm_kegiatan'" width="500">Uraian Nama Kegiatan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

    </script>