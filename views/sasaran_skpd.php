<script type="text/javascript">
    var rekening, state, parents, kd_unit;
</script>
<div class="easyui-layout" data-options="fit:true">
        <div data-options="region:'south',split:true" style="height:150px;">
            <div class="row p10">
                <div class="row mb20">
                    <div class="small-3 columns">
                        <label for="xSasaran" class="left inline">Sasaran</label>
                    </div>
                    <div class="small-9 columns">
                        <input  type="text" 
                                id="xSasaran" 
                                name="xSasaran" 
                                class="form-control easyui-textbox">
                    </div>
                </div>
                <div class="row mb20">
                    <div class="small-3 columns">
                        <label for="person" class="left inline">Satuan</label>
                    </div>
                    <div class="small-9 columns">
                        <input id="xSatuan" class="easyui-combobox" name="satuan"
                            data-options="valueField:'id',textField:'nm_satuan',url:'store/satuan/list.php'">
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
        <div data-options="region:'center',title:'Data Master Sasaran Organisasi'">
            <div class="easyui-tabs xtab" data-options="fit:true,
                border:false,
                plain:true,
                tabPosition:'left',
                onSelect: function(t,i) {
                    $('#xSasaran').textbox('setValue', '');
                    $('.x-edit,.x-save, .x-del,.x-add').linkbutton({disabled:true});
                    var kd = $('#xSasaran');
                    var nm = $('#xSatuan');     

                    kd.textbox({
                        disabled : true
                    });    
                    nm.combobox({
                        disabled : true
                    });
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
                        parents = 0;
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
                                onSelect : function (i,r) {
                                    var kd = $('#xSasaran');
                                    var nm = $('#xSatuan');     

                                    kd.textbox({
                                        disabled : false,
                                        readonly:true
                                    });

                                    kd.textbox('setValue', r.sasaran);    

                                    $('.x-add, .x-edit, .x-del').linkbutton({disabled:false});
                                    $('.x-save').linkbutton({disabled:true});
                                },
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
                                onSelect : function (i,r) {
                                    var kd = $('#xSasaran');
                                    var nm = $('#xSatuan');     

                                    kd.textbox({
                                        readonly : true,
                                        disabled : false
                                    });    
                                    nm.combobox({
                                        readonly : true,
                                        disabled : false
                                    });

                                    kd.textbox('setValue', r.indikator);    
                                    nm.combobox('setValue', r.satuan_id);

                                    $('.x-add, .x-edit, .x-del').linkbutton({disabled:false});
                                    $('.x-save').linkbutton({disabled:true});
                                }">
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
        
        $(".x-add").bind('click', function () {
            var me =  $(".x-add").linkbutton('options');
            state = "add";
            if (me.disabled) {
                return;
            };

            var kd = $("#xSasaran");
            var nm = $("#xSatuan");     

            kd.textbox({
                readonly : false,
                disabled:false
            });    
            nm.combobox({
                readonly : true,
                disabled:true
            });

            if (rekening == 'indikator') {
                nm.combobox({
                    readonly : false,
                    disabled:false
                });
            };

            kd.textbox('clear');
            nm.combobox('clear');
            kd.textbox('textbox').focus();


            $('.x-edit').linkbutton({disabled:true});
            $('.x-add').linkbutton({disabled:true});
            $('.x-del').linkbutton({disabled:true});
            $('.x-save').linkbutton({disabled:false});

        });   

        $(".x-edit").bind('click', function () {
            var that = $("." + rekening).datagrid('getSelected');
            var me =  $(".x-edit").linkbutton('options');
            state = "edit";
            if (me.disabled) {
                return;
            };
            var kd = $("#xSasaran");
            var nm = $("#xSatuan");     
   
            kd.textbox({
                readonly : false
            });    
            if (rekening == 'indikator') {
                nm.combobox({
                    readonly : false
                });
                nm.combobox('setValue', that.satuan_id);
                
            };

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
            var kd = $("#xSasaran");
            var nm = $("#xSatuan");
            var row = $('.'+rekening).datagrid('getSelected');
            $.post('store/sasaran_skpd/delete.php', row)
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
                        nm.combobox({
                            readonly : true
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

            var kd = $("#xSasaran");
            var nm = $("#xSatuan");

            var KD = kd.textbox('getValue');
            var NM = nm.combobox('getValue');
            // console.log(NM + KD);

            if (rekening == 'sasaran') {
                if (KD == "" || KD == 0) {
                    $.messager.alert('Warning', "Harap di isi data Uraian " + rekening.toUpperCase(),'', function(){
                        nm.combobox('textbox').focus(); 
                    });
                    return;

               }; 
               if (state == "add" ) {
                    var row = {};
                    row.kd_subunit = kd_unit;
                }
                else {
                    var row = $('.'+rekening).datagrid('getSelected');
                }
                row.sasaran = KD;

                $.post('store/sasaran_skpd/save.php', row)
                    .done(function (data) {
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
                            nm.combobox({
                                readonly : true
                            });

                        return;
                        }
                        else {
                            $.messager.alert('Warning', data.message);
                            return;
                        }
                    });

               return;
            };

            if (rekening == 'indikator') {
                if (KD == "" || NM == "" || KD == 0 || NM == 0){
                    $.messager.alert('Warning', "Harap di isi data Uraian " + rekening.toUpperCase(),'', function(){
                        nm.combobox('textbox').focus(); 
                    });
                    return;
                }

                if (state == "add" ) {
                    var Sasaran = $('.sasaran').datagrid('getSelected');
                    var row = {};
                    row.sasaran_id = Sasaran.id;
                }
                else {
                    var row = $('.'+rekening).datagrid('getSelected');
                }
                row.satuan_id = NM;
                row.indikator = KD;

                $.post('store/sasaran_skpd/saveindikator.php', row)
                    .done(function (data) {
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
                            nm.combobox({
                                readonly : true
                            });

                        }
                        else {
                            $.messager.alert('Warning', data.message);
                        }
                    });

               return;


            };

            
            // validasi inputan
            if (rekening != 'sasaran' && (KD == "" || NM == "" || KD == 0 || NM == 0)){
            }

            
            if (state == "add" ) {
                var row = {};
                row.parent_id = parents
            }
            else {
                var row = $('.'+rekening).datagrid('getSelected');
            }
            row.unit_organisasi = KD;
            row.person = NM;
            row.kd_unit = kd_unit;
            row.kd_subunit = kd_subunit;
            row.state = state;
            
            $.post('store/sasaran_skpd/save.php', row)
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
                        nm.combobox({
                            readonly : true
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