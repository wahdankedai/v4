<script type="text/javascript">
    var rekening, state, eselon, parents, kd_unit, kd_subunit;
</script>   
<div class="easyui-layout main" data-options="fit:true">

        <!-- Panel untuk Indikator -->
        <div data-options="region:'east',split:true,collapsible:false" title="Indikator" style="width:55%;">
            <div class="easyui-layout mainIndikator" data-options="fit:true">
                <div data-options="region:'center'">
                    <table class="xindikator">
                    </table>
                </div>
                <div data-options="region:'south',title:'Anggaran',split:true,collapsible:false" style="height:35%;">
                    <table class="xAnggaran">
                    
                    </table>
                </div>
            </div>

        </div>

        <!-- Main Content -->
        <div data-options="region:'center',title:'Data Master Renstra'">
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
                        $('.mainIndikator').layout('collapse', 'south');
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
                        $('.mainIndikator').layout('collapse', 'south');
                        $('.main').layout('collapse', 'east');
                    } else if (i == 3) {
                        $('.xtab').tabs('disableTab', 4);
                        $('.xtab').tabs('disableTab', 5);
                        $('.main').layout('collapse', 'east');
                        $('.mainIndikator').layout('collapse', 'south');
                        rekening = 'bidang';

                    } else if (i == 4) {
                        $('.xtab').tabs('disableTab', 5);
                        panelEast.panel('setTitle', 'Indokator Outcome')
                        $('.mainIndikator').layout('collapse', 'south');
                        $('.main').layout('expand', 'east');
                        $('.xindikator').datagrid({
                            fit:true,
                            fitColumns:true,
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
                                {rowspan:2,field:'id',title:'id',width:100,hidden:true },
                                {rowspan:2,field:'kd_unit',title:'kd_unit',width:100,hidden:true },
                                {rowspan:2,field:'satuan',title:'satuan',width:100,hidden:true },
                                {rowspan:2,field:'kd_subunit',title:'kd_subunit',width:100,hidden:true },
                                {rowspan:2,field:'kd_program',title:'kd_program',width:100,hidden:true },
                                {rowspan:2,field:'indikator',title:'Indikator',width:350},
                                {rowspan:2,field:'nm_satuan',title:'Satuan',width:100},
                                {colspan:6,title:'TARGET'} 
                            ],[
                                {field:'awal',title:'Awal',width:80},
                                {field:'tahun1',title:'I',width:80},
                                {field:'tahun2',title:'II',width:80},
                                {field:'tahun3',title:'III',width:80},
                                {field:'tahun4',title:'IV',width:80},
                                {field:'tahun5',title:'V',width:80}
                            ]]
                        });
                        rekening = 'program';
                    } else if (i == 5) {
                        panelEast.panel('setTitle', 'Indokator Output')
                        $('.main').layout('expand', 'east');
                        $('.mainIndikator').layout('expand', 'south');
                        rekening = 'kegiatan';
                        $('.xindikator').datagrid({
                            fit:true,
                            fitColumns:true,
                            toolbar: '',
                            singleSelect:true,
                            url:'store/evaluasi_renstra/list_indikator_output.php',
                            queryParams : {
                                kd_unit : 0,
                                kd_subunit : 0,
                                kd_kegiatan : 0
                            },
                            columns:[[
                                {rowspan:2,field:'id',title:'id',width:100,hidden:true },
                                {rowspan:2,field:'kd_unit',title:'kd_unit',width:100,hidden:true },
                                {rowspan:2,field:'satuan',title:'satuan',width:100,hidden:true },
                                {rowspan:2,field:'kd_subunit',title:'kd_subunit',width:100,hidden:true },
                                {rowspan:2,field:'kd_kegiatan',title:'kd_kegiatan',width:100,hidden:true },
                                {rowspan:2,field:'indikator',title:'Indikator',width:350},
                                {rowspan:2,field:'nm_satuan',title:'Satuan',width:100},
                                {colspan:6,title:'TARGET'} 
                            ],[
                                {field:'awal',title:'Awal',width:80},
                                {field:'tahun1',title:'I',width:80},
                                {field:'tahun2',title:'II',width:80},
                                {field:'tahun3',title:'III',width:80},
                                {field:'tahun4',title:'IV',width:80},
                                {field:'tahun5',title:'V',width:80}
                            ]]
                        });
                        $('.xAnggaran').datagrid({
                            fit:true,
                            fitColumns:true,
                            toolbar: '',
                            singleSelect:true,
                            url:'store/evaluasi_renstra/list_anggaran.php',
                            queryParams : {
                                kd_unit : 0,
                                kd_subunit : 0,
                                kd_kegiatan : 0
                            },
                            onDblClickRow: function(i,r) {
                                $('#x-dialog').dialog({
                                    title : 'Edit Anggaran',
                                    width : 450,
                                    height : 300,
                                    href : 'store/evaluasi_renstra/form_anggaran.php',
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
                                                        $('.xAnggaran').datagrid('reload');
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
                                        $('.awals').numberbox('textbox').focus();
                                    }
                                });
                            },
                            columns:[[
                                {field:'id',title:'id',width:100,hidden:true },
                                {field:'kd_unit',title:'kd_unit',width:100,hidden:true },
                                {field:'satuan',title:'satuan',width:100,hidden:true },
                                {field:'kd_subunit',title:'kd_subunit',width:100,hidden:true },
                                {field:'kd_kegiatan',title:'kd_kegiatan',width:100,hidden:true },
                                {field:'awal',title:'Awal',align:'right',width:80,
                                    formatter: function(value,row,index){
                                        if (row.awal){
                                            return accounting.formatNumber(row.awal,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    }},
                                {field:'tahun1',title:'I',align:'right',width:80,
                                    formatter: function(value,row,index){
                                        if (row.tahun1){
                                            return accounting.formatNumber(row.tahun1,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    }},
                                {field:'tahun2',title:'II',align:'right',width:80,
                                    formatter: function(value,row,index){
                                        if (row.tahun2){
                                            return accounting.formatNumber(row.tahun2,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    }},
                                {field:'tahun3',title:'III',align:'right',width:80,
                                    formatter: function(value,row,index){
                                        if (row.tahun3){
                                            return accounting.formatNumber(row.tahun3,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    }},
                                {field:'tahun4',title:'IV',align:'right',width:80,
                                    formatter: function(value,row,index){
                                        if (row.tahun4){
                                            return accounting.formatNumber(row.tahun4,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    }},
                                {field:'tahun5',title:'V',align:'right',width:80,
                                    formatter: function(value,row,index){
                                        if (row.tahun5){
                                            return accounting.formatNumber(row.tahun5,{decimal : ',',  thousand: '.',  precision : 0});
                                        } else {
                                            return value;
                                        }
                                    }}
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
                                queryParams : {
                                    <?php echo App::filterUserOrganisasi($session->role, $session->kd_subunit); ?>
                                },
                                idField:'kd_urusan',
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
                                toolbar : [{
                                    text:'Tambah',
                                    disabled: ! configApp.evaluasi.add_program_renstra,
                                    iconCls: 'icon-add',
                                    handler: function(){
                                        var r = $('.xbidang').datagrid('getSelected');
                                        r.kd_unit = kd_unit;
                                        r.kd_subunit = kd_subunit;
                                        $('#x-dialog').dialog({
                                            title: 'Tambah Program',
                                            width: 450,
                                            height: 340,
                                            modal:true,
                                            method:'post',
                                            href: BASE_URL+ 'store/evaluasi_renstra/form/add_program_renstra.php',
                                            queryParams: r,
                                            buttons:[{
                                                text:'Save',
                                                handler:function (){                            
                                                    var keg = $('.list-kegiatan').datagrid('getChecked');
                                                    for(var i=0; i<keg.length; i++){
                                                        keg[i].kd_unit = kd_unit;
                                                        keg[i].kd_sub_unit = kd_subunit;
                                                        keg[i].kd_kegiatan = keg[i].kode;
                                                        delete keg[i].nm_kegiatan;
                                                        delete keg[i].kode;
                                                    }
                                                    $.post(BASE_URL + 'store/evaluasi_renstra/add_program_renstra.php', {
                                                        d : keg
                                                    },
                                                    function (d) {
                                                        var data = eval('(' + d + ')');
                                                            if (data.success) {
                                                                $.messager.show({  
                                                                    title: 'Status',  
                                                                    msg: data.message  
                                                                });
                                                                $('.xprogram').datagrid('reload');
                                                                $('#x-dialog').dialog('close');
                                                            }
                                                            else {
                                                                $.messager.alert('Warning', data.message);
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
                                    }
                                },'-',{
                                    text:'Hapus',
                                    disabled : ! configApp.evaluasi.delete_program_renstra,
                                    iconCls: 'icon-remove',
                                    handler: function(){
                                        var row = $('.xprogram').datagrid('getSelected');
                                        if(! row) {
                                            console.log('Harap Pilih data yang akan di hapus');
                                            return;
                                        }
                                        $.messager.confirm('Hapus data Indikator', 'Apakah Anda yakin bahwa data tersebut akan anda hapus?', function(r){
                                            if (r)
                                            {
                                                row.kd_unit = kd_unit;
                                                row.kd_sub_unit = kd_subunit;
                                                delete row.nm_program;
                                                $.post(BASE_URL + 'store/evaluasi_renstra/delete_program_renstra.php', row,
                                                function (d) {
                                                    var data = eval('(' + d + ')');
                                                        if (data.success) {
                                                            $.messager.show({  
                                                                title: 'Status',  
                                                                msg: data.message  
                                                            });
                                                            $('.xprogram').datagrid('reload');
                                                        }
                                                        else {
                                                            $.messager.alert('Warning', data.message);
                                                        } 
                                                });
                                            }
                                        });
                                    }
                                }],
                                onSelect : function (i,r) {
                                     $('.xindikator').datagrid({
                                        toolbar : [{
                                            text:'Tambah',
                                            disabled: ! configApp.evaluasi.add_indikator_outcome_renstra,
                                            iconCls: 'icon-add',
                                            handler: function(){
                                                $('#x-dialog').dialog({
                                                    title: 'Tambah Indikator',
                                                    width: 450,
                                                    height: 340,
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
                                            disabled : ! configApp.evaluasi.edit_indikator_outcome_renstra,
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
                                                    height: 340,
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
                                            disabled : ! configApp.evaluasi.delete_indikator_outcome_renstra,
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
                                toolbar : [{
                                    text:'Tambah',
                                    disabled: ! configApp.evaluasi.add_kegiatan_renstra,
                                    iconCls: 'icon-add',
                                    handler: function(){
                                        var r = $('.xprogram').datagrid('getSelected');
                                        r.kd_unit = kd_unit;
                                        r.kd_subunit = kd_subunit;
                                        $('#x-dialog').dialog({
                                            title: 'Tambah Program',
                                            width: 450,
                                            height: 340,
                                            modal:true,
                                            method:'post',
                                            href: BASE_URL+ 'store/evaluasi_renstra/form/add_kegiatan_renstra.php',
                                            queryParams: r,
                                            buttons:[{
                                                text:'Save',
                                                handler:function (){                            
                                                    var keg = $('.list-kegiatan').datagrid('getChecked');
                                                    for(var i=0; i<keg.length; i++){
                                                        keg[i].kd_unit = kd_unit;
                                                        keg[i].kd_sub_unit = kd_subunit;
                                                        keg[i].kd_kegiatan = keg[i].kode;
                                                        delete keg[i].nm_kegiatan;
                                                        delete keg[i].kode;
                                                    }
                                                    $.post(BASE_URL + 'store/evaluasi_renstra/add_kegiatan_renstra.php', {
                                                        d : keg
                                                    },
                                                    function (d) {
                                                        var data = eval('(' + d + ')');
                                                            if (data.success) {
                                                                $.messager.show({  
                                                                    title: 'Status',  
                                                                    msg: data.message  
                                                                });
                                                                $('.xkegiatan').datagrid('reload');
                                                                $('#x-dialog').dialog('close');
                                                            }
                                                            else {
                                                                $.messager.alert('Warning', data.message);
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
                                    }
                                },'-',{
                                    text:'Hapus',
                                    disabled : ! configApp.evaluasi.delete_kegiatan_renstra,
                                    iconCls: 'icon-remove',
                                    handler: function(){
                                        var row = $('.xkegiatan').datagrid('getSelected');
                                        if(! row) {
                                            console.log('Harap Pilih data yang akan di hapus');
                                            return;
                                        }
                                        $.messager.confirm('Hapus data Indikator', 'Apakah Anda yakin bahwa data tersebut akan anda hapus?', function(r){
                                            if (r)
                                            {
                                                row.kd_unit = kd_unit;
                                                row.kd_sub_unit = kd_subunit;
                                                delete row.nm_kegiatan;
                                                $.post(BASE_URL + 'store/evaluasi_renstra/delete_kegiatan_renstra.php', row,
                                                function (d) {
                                                    var data = eval('(' + d + ')');
                                                        if (data.success) {
                                                            $.messager.show({  
                                                                title: 'Status',  
                                                                msg: data.message  
                                                            });
                                                            $('.xkegiatan').datagrid('reload');
                                                        }
                                                        else {
                                                            $.messager.alert('Warning', data.message);
                                                        } 
                                                });
                                            }
                                        });
                                    }
                                }],
                                onSelect : function (i,r) {
                                    $('.xAnggaran').datagrid({
                                        queryParams: {
                                            kd_unit : kd_unit,
                                            kd_subunit : kd_subunit,
                                            kd_kegiatan : r.kd_urusan + r.kd_bidang +r.kd_program + r.kd_kegiatan
                                        }
                                    });
                                     $('.xindikator').datagrid({
                                        toolbar : [{
                                            text:'Tambah',
                                            disabled: ! configApp.evaluasi.add_indikator_output_renstra,
                                            iconCls: 'icon-add',
                                            handler: function(){
                                                $('#x-dialog').dialog({
                                                    title: 'Tambah Indikator',
                                                    width: 450,
                                                    height: 340,
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
                                            disabled : ! configApp.evaluasi.edit_indikator_output_renstra,
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
                                                    height: 340,
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
                                            disabled : ! configApp.evaluasi.delete_indikator_output_renstra,
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