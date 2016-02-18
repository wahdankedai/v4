<script type="text/javascript">
    var rekening, state, eselon, parents, kd_unit, kd_subunit;
</script>   
<div class="easyui-layout main" data-options="fit:true">

        <!-- Panel untuk Indikator -->
        <div data-options="region:'east',split:true,collapsible:false" title="Indikator" style="width:450px;">
            <div class="easyui-layout main-indikator" data-options="fit:true">
                <div data-options="region:'north',split:false,collapsible:false"style="height:400px;">
                    <table class="xindikator">
                    </table>
                </div>
                <div data-options="region:'center',title:'Target dan Realiasasi'">
                    <table class="xtarget">
                    </table>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div data-options="region:'center',title:'Data Master Unit Eselon Organisasi'">
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
                            singleSelect:true,
                            url:'store/evaluasi/list_indikator_outcome.php',
                            queryParams : {
                                kd_unit : 0,
                                kd_subunit : 0,
                                kd_program : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true },
                                {field:'kd_unit',title:'kd_unit',width:100,hidden:true },
                                {field:'kd_subunit',title:'kd_subunit',width:100,hidden:true },
                                {field:'kd_program',title:'kd_program',width:100,hidden:true },
                                {field:'indikator',title:'Indikator',width:350},
                                {field:'satuan',title:'Satuan',width:100}
                            ]]
                        });
                        rekening = 'program';
                    } else if (i == 5) {
                        panelEast.panel('setTitle', 'Indokator Output')
                        $('.main').layout('expand', 'east');
                        rekening = 'kegiatan';
                        $('.xindikator').datagrid({
                            fit:true,
                            singleSelect:true,
                            url:'store/evaluasi/list_indikator_output.php',
                            queryParams : {
                                kd_unit : 0,
                                kd_subunit : 0,
                                kd_kegiatan : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true },
                                {field:'kd_unit',title:'kd_unit',width:100,hidden:true },
                                {field:'kd_subunit',title:'kd_subunit',width:100,hidden:true },
                                {field:'kd_program',title:'kd_kegiatan',width:100,hidden:true },
                                {field:'indikator',title:'Indikator',width:350},
                                {field:'satuan',title:'Satuan',width:100}
                            ]]
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
                            data-options="url:'store/evaluasi/list_urusan.php',
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
                            data-options="url:'store/evaluasi/list_bidang.php',
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
                            data-options="url:'store/evaluasi/list_program.php',
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
                                     $('.xindikator').datagrid({
                                        toolbar : [{
                                            text:'Tambah',
                                            iconCls: 'icon-add',
                                            handler: function(){
                                                $('#x-dialog').dialog({
                                                    title: 'Tambah Indikator',
                                                    width: 450,
                                                    height: 180,
                                                    modal:true,
                                                    method:'post',
                                                    href: BASE_URL+ 'store/evaluasi/form/add_outcome.php',
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
                                                        $('#indikator').numberbox('textbox').focus(); 
                                                    }
                                                });
                                            }
                                        },'-',{
                                            text:'Edit',
                                            iconCls: 'icon-edit',
                                            handler: function(){

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
                            data-options="url:'store/evaluasi/list_kegiatan.php',
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
                                  $('.xindikator').datagrid({
                                        toolbar : [{
                                            iconCls: 'icon-edit',
                                            handler: function(){alert('edit')}
                                        },'-',{
                                            iconCls: 'icon-help',
                                            handler: function(){alert('help')}
                                        }],
                                        queryParams : {
                                            kd_unit : kd_unit,
                                            kd_subunit : kd_subunit,
                                            kd_program : r.kd_urusan + r.kd_bidang +r.kd_program + r.kd_kegiatan
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
        var gridIndikator = $(".xindikator");
        var mainTab = $(".xtab");
        var mainContent = $(".main");

    </script>