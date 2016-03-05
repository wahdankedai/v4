<script type="text/javascript">
    var rekening, state, parents, kd_unit;
</script>
<div class="easyui-layout main" data-options="fit:true">
        <div data-options="region:'east',split:false,collapsible:false" style="width:40%;">
            <div data-options="fit:true" class="easyui-layout program-sasaran">
                <div data-options="collapsible:false,region:'north', title:'Target dan Realisasi'" style="height:250px;">
                    <div class="targetsasaran easyui-accordion" data-options="fit:true">
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
                <div data-options="collapsible:false,region:'south'" style="height:100px;">
                    <div class="row p10">
                        <div class="small-12 columns">
                                <p>Pilih Program dibawah ini untuk menambahkan</p>
                        </div>
                        <div class="small-4 columns"> 
                            Pilih Program
                        </div>
                        <div class="small-8 columns"> 
                            <select class="pilih-program" class="easyui-combogrid" style="width:100%;"
                                data-options="
                                    panelWidth:450,
                                    idField:'kd_program',
                                    textField:'nm_program',
                                    fitColumns:true,
                                    novalidate:true,
                                    url:'store/sasaran_skpd/list_program_sasaran.php',
                                    columns:[[
                                        {field:'kd_program',title:'Kode',width:60},
                                        {field:'nm_program',title:'Name',width:200}
                                    ]],
                                  onChange : function (n,o) {
                                        var me = $('.pilih-program');
                                        var dg = $('.indikator');

                                        var dgs = dg.datagrid('getSelected');

                                        var r = {};

                                        r.id_sasaran = dgs.id;


                                        if(n!=o && $.isNumeric(n)) {
                                            r.kd_program = n;
                                            $.post('store/sasaran_skpd/add_sasaran_program.php', r)
                                            .done(function(data) {
                                                var data = eval('(' + data + ')');
                                                if (data.success){
                                                    $.messager.show({  
                                                        title: 'Status',  
                                                        msg: data.message  
                                                    });
                                                    $('.list-program').datagrid('reload');
                                                    me.combogrid('clear');
                                                    me.combogrid('grid').datagrid('reload');

                                                }
                                                else {
                                                    $.messager.alert('Warning', data.message);
                                                }
                                            })
                                            .fail(function() {
                                                console.log(data);
                                            });
                                        }
                    }
                                "></select>
                        </div>
                        </div>
                </div>
                <div data-options="region:'center', title:'List Program'">
                    <table class="list-program">
                        
                    </table>
                </div>
            </div>
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
                        $('.main').layout('collapse', 'east');
                    } else if (i==1) {
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        rekening = 'unit';
                        $('.main').layout('collapse', 'east');
                    } else if (i == 2) {
                        $('.xtab').tabs('disableTab', 3);
                        $('.x-add').linkbutton({disabled:false});
                        rekening = 'sasaran';
                        $('.main').layout('collapse', 'east');
                    } else if (i == 3) {
                        $('.x-add').linkbutton({disabled:false});
                        rekening = 'indikator';
                        $('.main').layout('expand', 'east');

                        $('.indikatorTarget').datagrid({
                            fit:true,
                            singleSelect:true,
                            fitColumns:true,
                            url:'store/sasaran_skpd/list_target_sasaran.php',
                            queryParams : {
                                id : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true },
                                {field:'target_triwulan_1',title:'I',width:50,align:'center'},
                                {field:'target_triwulan_2',title:'II',width:50,align:'center'},
                                {field:'target_triwulan_3',title:'III',width:50,align:'center'},
                                {field:'target_triwulan_4',title:'IV',width:50,align:'center'}
                            ]]
                        });

                        $('.indikatorRealisasi').datagrid({
                            fit:true,
                            fitColumns:true,
                            singleSelect:true,
                            url:'store/sasaran_skpd/list_target_sasaran.php',
                            queryParams : {
                                id : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true },
                                {field:'realisasi_triwulan_1',title:'I',width:50,align:'center'},
                                {field:'realisasi_triwulan_2',title:'II',width:50,align:'center'},
                                {field:'realisasi_triwulan_3',title:'III',width:50,align:'center'},
                                {field:'realisasi_triwulan_4',title:'IV',width:50,align:'center'}
                            ]]
                        });

                         $('.indikatorRealisasi, .indikatorTarget').datagrid({ 
                            onDblClickRow : function (i,r) {
                                $('#x-dialog').dialog({
                                    title : 'Edit Target dan Realisasi',
                                    width : 450,
                                    height : 300,
                                    href : 'store/sasaran_skpd/form/edit_realisasi.php',
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
                                                        $('.indikatorRealisasi, .indikatorTarget').datagrid('reload');
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
                         });

                        $('.list-program').datagrid({
                            fit:true,
                            fitColumns:true,
                            singleSelect:true,
                            url:'store/sasaran_skpd/list_program.php',
                            queryParams : {
                                id : 0
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true },
                                {field:'kd_program',title:'Kode Program',width:150},
                                {field:'nm_program',title:'Nama Program',width:350}
                            ]],
                            onDblClickRow : function (i,r) {
                                $.post('store/sasaran_skpd/delete_sasaran_program.php' , r)
                                    .done(function (data) {
                                        $('.list-program').datagrid('reload');
                                        $('.pilih-program').combogrid('grid').datagrid('reload');;
                                    });
                            }
                        });
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
                                idField:'id',
                                onClickRow : function(i,r) {
                                    $('.indikatorTarget,.list-program, .indikatorRealisasi').datagrid({
                                        queryParams : {
                                            id : r.id
                                        }
                                    });
                                    $('.pilih-program').combogrid({
                                        queryParams : {
                                            id : r.id,
                                            kd_sub_unit : kd_unit
                                        }
                                    });
                                }
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