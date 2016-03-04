<script type="text/javascript">
    var rekening, state, eselon, parents, kd_unit, kd_subunit;
</script>
<div class="easyui-layout" data-options="fit:true">
        <div data-options="region:'south',split:true" style="height:150px;">
            <div class="row p10">
                <div class="row mb20">
                    <div class="small-3 columns">
                        <label for="organisasi" class="left inline">Unit Organisasi</label>
                    </div>
                    <div class="small-9 columns">
                        <input  type="text" 
                                id="organisasi" 
                                name="organisasi" 
                                class="form-control easyui-textbox">
                    </div>
                </div>
                <div class="row mb20">
                    <div class="small-3 columns">
                        <label for="person" class="left inline">Penanggung jawab</label>
                    </div>
                    <div class="small-9 columns">
                        <input  type="text" 
                                id="person" 
                                name="person" 
                                class="form-control easyui-textbox"
                                data-options="readonly:true">
                    </div>
                </div>
                <div class="row p10 mb20">
                    <a class="easyui-linkbutton x-add" data-options="iconCls:'icon-add'">Add</a>
                    <a class="easyui-linkbutton x-edit" data-options="iconCls:'icon-edit',disabled:true">Edit</a>
                    <a class="easyui-linkbutton x-del" data-options="iconCls:'icon-remove',disabled:true">Delete</a>
                    <a class="easyui-linkbutton x-save" data-options="iconCls:'icon-save',disabled:true">Save</a>
                </div>
            </div>
        </div>
        <div data-options="region:'center',title:'Data Master Unit Eselon Organisasi'">
            <div class="easyui-tabs xtab" data-options="fit:true,
                border:false,
                plain:true,
                tabPosition:'left',
                onSelect: function(t,i) {
                    $('#organisasi').textbox('setValue', '');
                    $('#person').textbox('setValue', '');
                    $('.x-edit,.x-save, .x-del,.x-add').linkbutton({disabled:true});
                    var kd = $('#organisasi');
                    var nm = $('#person');     

                    kd.textbox({
                        readonly : true
                    });    
                    nm.textbox({
                        readonly : true
                    });
                    if (i==0) {
                        $('.xtab').tabs('disableTab', 1);
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        $('.xtab').tabs('disableTab', 4);
                        rekening = 'organisasi';
                        eselon = undefined;
                    } else if (i==1) {
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        $('.xtab').tabs('disableTab', 4);
                        rekening = 'unit';
                        eselon = undefined;
                    } else if (i == 2) {
                        $('.xtab').tabs('disableTab', 3);
                        $('.xtab').tabs('disableTab', 4);
                        $('.x-add').linkbutton({disabled:false});
                        rekening = 'eselon2';
                        eselon = 'II';
                        parents = 0;
                    } else if (i == 3) {
                        $('.x-add').linkbutton({disabled:false});
                        $('.xtab').tabs('disableTab', 4);
                        rekening = 'eselon3';
                        eselon = 'III';
                        var cc = $('.eselon2').datagrid('getSelected');
                        parents = cc.id;
                    } else {
                        $('.x-add').linkbutton({disabled:false});
                        rekening = 'eselon4';
                        eselon = 'IV';
                        var cc = $('.eselon3').datagrid('getSelected');
                        parents = cc.id;
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
                                     $('.eselon2').datagrid({
                                        queryParams:{
                                            kode : r.kode,
                                            kd_subunit : r.kd_subunit,
                                            parent_id : 0
                                        }
                                     });
                                     parents = 0;
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
                <div title="Eselon II">
                    <table class="easyui-datagrid eselon2"
                            data-options="url:'store/unit_eselon/list.php',
                                method:'post',
                                queryParams:{
                                    kode : 0,
                                    parent_id :0
                                },
                                idField:'id',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                onSelect : function (i,r) {
                                    var kd = $('#organisasi');
                                    var nm = $('#person');     

                                    kd.textbox({
                                        readonly : true
                                    });    
                                    nm.textbox({
                                        readonly : true
                                    });

                                    $('.x-add, .x-edit, .x-del').linkbutton({disabled:false});
                                    $('.x-save').linkbutton({disabled:true});

                                    $('#organisasi').textbox('setValue', r.unit_organisasi);
                                    $('#person').textbox('setValue', r.person);
                                },
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 3);
                                     $('.eselon3').datagrid({
                                        queryParams:{
                                            kode : r.kd_unit,
                                            kd_subunit : kd_subunit,
                                            parent_id : r.id
                                        }
                                     });
                                     parents = r.id;
                                     $('.xtab').tabs('select', 3);
                                }">
                        <thead>
                            <tr>
                                <th data-options="field:'id',hidden:true" width="200">Unit Organisasi</th>
                                <th data-options="field:'unit_organisasi',align:'left'" width="200">Unit Organisasi</th>
                                <th data-options="field:'person',align:'left'" width="200">Penanggung Jawab</th>
                                <th data-options="field:'eselon'" width="60">Eselon</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Eselon III">
                    <table class="easyui-datagrid eselon3"
                            data-options="url:'store/unit_eselon/list.php',
                                method:'post',
                                queryParams:{
                                    parent_id : 0,
                                    kode : 0
                                },
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'id',
                                onSelect : function (i,r) {
                                    var kd = $('#organisasi');
                                    var nm = $('#person');     

                                    kd.textbox({
                                        readonly : true
                                    });    
                                    nm.textbox({
                                        readonly : true
                                    });
                                    $('.x-add, .x-edit, .x-del').linkbutton({disabled:false});
                                    $('.x-save').linkbutton({disabled:true});
                                    $('#organisasi').textbox('setValue', r.unit_organisasi);
                                    $('#person').textbox('setValue', r.person);
                                },
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 4);
                                     $('.eselon4').datagrid({
                                        queryParams:{
                                            kode : r.kd_unit,
                                            kd_subunit : r.kd_subunit,
                                            parent_id : r.id
                                        }
                                     });
                                     parents = r.id;
                                     $('.xtab').tabs('select', 4);
                                }">
                        <thead>
                            <tr>
                                <th data-options="field:'id',hidden:true" width="200">Unit Organisasi</th>
                                <th data-options="field:'unit_organisasi',align:'left'" width="200">Unit Organisasi</th>
                                <th data-options="field:'person',align:'left'" width="200">Penanggung Jawab</th>
                                <th data-options="field:'eselon'" width="60">Eselon</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div title="Eselon IV">
                    <table class="easyui-datagrid eselon4"
                            data-options="url:'store/unit_eselon/list.php',
                                method:'post',
                                queryParams:{
                                    parent_id : 0,
                                    kode : 0
                                },
                                method:'post',
                                singleSelect:true,
                                idField:'id',
                                fit:true,
                                fitColumns:true,
                                onSelect : function (i,r) {
                                    var kd = $('#organisasi');
                                    var nm = $('#person');     

                                    kd.textbox({
                                        readonly : true
                                    });    
                                    nm.textbox({
                                        readonly : true
                                    });
                                    $('.x-add, .x-edit, .x-del').linkbutton({disabled:false});
                                    $('.x-save').linkbutton({disabled:true});
                                    $('#organisasi').textbox('setValue', r.unit_organisasi);
                                    $('#person').textbox('setValue', r.person);
                                }">
                        <thead>
                            <tr>
                                <th data-options="field:'id',hidden:true" width="200">Unit Organisasi</th>
                                <th data-options="field:'unit_organisasi',align:'left'" width="200">Unit Organisasi</th>
                                <th data-options="field:'person',align:'left'" width="200">Penanggung Jawab</th>
                                <th data-options="field:'eselon'" width="60">Eselon</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        
        $(".x-add").bind('click', function () {
            var me =  $(".x-add").linkbutton('options');
            state = "add";
            if (me.disabled) {
                return;
            };

            var kd = $("#organisasi");
            var nm = $("#person");     

            kd.textbox({
                readonly : false
            });    
            nm.textbox({
                readonly : false
            });

            kd.textbox('clear');
            nm.textbox('clear');
            kd.textbox('textbox').focus();


            $('.x-edit').linkbutton({disabled:true});
            $('.x-add').linkbutton({disabled:true});
            $('.x-del').linkbutton({disabled:true});
            $('.x-save').linkbutton({disabled:false});

        });   

        $(".x-edit").bind('click', function () {
            var me =  $(".x-edit").linkbutton('options');
            state = "edit";
            if (me.disabled) {
                return;
            };
            var kd = $("#organisasi");
            var nm = $("#person");     
   
            kd.textbox({
                readonly : false
            });    
            nm.textbox({
                readonly : false
            });

            kd.textbox('textbox').focus();


            $('.x-edit').linkbutton({disabled:true});
            $('.x-add').linkbutton({disabled:true});
            $('.x-del').linkbutton({disabled:true});
            $('.x-save').linkbutton({disabled:false});

        });


        $(".x-del").bind('click', function () {

            var me =  $(".x-del").linkbutton('options');

            if (me.disabled) {
                return;
            };
            var kd = $("#organisasi");
            var nm = $("#person");
            var row = $('.'+rekening).datagrid('getSelected');
            $.post('store/unit_eselon/delete.php', row)
                .done(function(data) {
                    var data = eval('(' + data + ')');
                    if (data.success){
                        $.messager.show({  
                            title: 'Status',  
                            msg: data.message  
                        });
                        $('.'+rekening).datagrid('reload');
                        $('.x-edit').linkbutton({disabled:true});
                        $('.x-add').linkbutton({disabled:false});
                        $('.x-del').linkbutton({disabled:true});
                        $('.x-save').linkbutton({disabled:true});

                        kd.textbox({
                            readonly : true,
                            value:""
                        });    
                        nm.textbox({
                            readonly : true,
                            value:""
                        });

                    }
                    else {
                        $.messager.alert('Warning', data.message);
                    }
                })
                .fail(function() {
                    console.log(data);
                });
        });

        $(".x-save").bind('click', function () {

            var me =  $(".x-save").linkbutton('options');

            if (me.disabled) {
                return;
            };


            var kd = $("#organisasi");
            var nm = $("#person");

            var KD = kd.textbox('getValue');
            var NM = nm.textbox('getValue');

            // validasi inputan
            if (KD == "" || NM == "" || KD == 0 || NM == 0){
                $.messager.alert('Warning', "Harap di isi data Uraian " + rekening.toUpperCase(),'', function(){
                    nm.textbox('textbox').focus(); 
                });
                return;
            }

            
            if (state == "add" ) {
                var row = {};
                row.parent_id = parents;
                row.eselon = eselon;
            }
            else {
                var row = $('.'+rekening).datagrid('getSelected');
            }
            row.unit_organisasi = KD;
            row.person = NM;
            row.kd_unit = kd_unit;
            row.kd_subunit = kd_subunit;
            row.state = state;
            
            $.post('store/unit_eselon/save.php', row)
                .done(function(data) {
                    var data = eval('(' + data + ')');
                    if (data.success){
                        $.messager.show({  
                            title: 'Status',  
                            msg: data.message  
                        });
                        $('.'+rekening).datagrid('reload');
                        $('.x-edit').linkbutton({disabled:true});
                        $('.x-add').linkbutton({disabled:false});
                        $('.x-del').linkbutton({disabled:true});
                        $('.x-save').linkbutton({disabled:true});

                        kd.textbox({
                            readonly : true,
                            value:""
                        });    
                        nm.textbox({
                            readonly : true,
                            value:""
                        });

                    }
                    else {
                        $.messager.alert('Warning', data.message);
                    }
                })
                .fail(function() {
                    console.log(data);
                });
        });
    </script>