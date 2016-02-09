<script type="text/javascript">
    var rekening, state, xUrusan, xBidang, xProgram, xKegiatan;
</script>
<div class="easyui-layout" data-options="fit:true">
        <div data-options="region:'south',split:true" style="height:150px;">
            <div class="row p10">
                <div class="row mb20">
                    <div class="small-3 columns">
                        <label for="kode" class="left inline">Kode</label>
                    </div>
                    <div class="small-9 columns">
                        <input  type="text" 
                                id="kode" 
                                name="kode" 
                                class="form-control easyui-numberbox" 
                                data-options="
                                    min:1,
                                    precision:0,
                                    readonly:true">
                    </div>
                </div>
                <div class="row mb20">
                    <div class="small-3 columns">
                        <label for="nama" class="left inline">Uraian</label>
                    </div>
                    <div class="small-9 columns">
                        <input  type="text" 
                                id="nama" 
                                name="nama" 
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
        <div data-options="region:'center',title:'Data Master Program Kegiatan'">
            <div class="easyui-tabs xtab" data-options="fit:true,
                border:false,
                plain:true,
                tabPosition:'left',
                onSelect: function(t,i) {
                    if (i==0) {
                        $('.xtab').tabs('disableTab', 1);
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        rekening = 'urusan';
                         xUrusan = undefined;
                    } else if (i == 1) {
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                        rekening = 'bidang';
                         xBidang = undefined;
                    } else if (i == 2) {
                        $('.xtab').tabs('disableTab', 3);
                        rekening = 'program';
                         xProgram = undefined;
                    } else {
                        rekening = 'kegiatan';
                         xKegiatan = undefined;
                    }
                    $('#kode').numberbox('setValue', '');
                    $('#nama').textbox('setValue', '');
                    $('.x-add').linkbutton({disabled:false});
                    $('.x-edit,.x-save, .x-del').linkbutton({disabled:true});
                    var kd = $('#kode');
                    var nm = $('#nama');     

                    kd.numberbox({
                        readonly : true
                    });    
                    nm.textbox({
                        readonly : true
                    });

            }">
                <div title="Urusan">                    
                    <table class="easyui-datagrid xurusan"
                            data-options="url:'store/urusan/list.php',
                                method:'post',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kd_urusan',
                                onSelect : function (i,r) {
                                    $('#kode').numberbox('setValue', r.kd_urusan);
                                    $('#nama').textbox('setValue', r.nm_urusan);
                                    $('.x-edit,.x-add, .x-del').linkbutton({disabled:false});
                                    $('.x-save').linkbutton({disabled:true});
                                    var kd = $('#kode');
                                    var nm = $('#nama');     

                                    kd.numberbox({
                                        readonly : true
                                    });    
                                    nm.textbox({
                                        readonly : true
                                    });
                                },
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 1);
                                     xUrusan = r.kd_urusan;
                                     $('.xbidang').datagrid({
                                        queryParams:{
                                            kd_urusan : r.kd_urusan
                                        }
                                     });
                                     $('.xtab').tabs('select', 1);
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
                            data-options="url:'store/bidang/list.php',
                                method:'post',
                                queryParams:{
                                    kd_urusan : 0
                                },
                                idField:'kd_bidang',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                onSelect : function (i,r) {
                                    $('#kode').numberbox('setValue', r.kd_bidang);
                                    $('#nama').textbox('setValue', r.nm_bidang);
                                     $('.x-edit,.x-add, .x-del').linkbutton({disabled:false});
                                     $('.x-save').linkbutton({disabled:true});
                                     var kd = $('#kode');
                                    var nm = $('#nama');     

                                    kd.numberbox({
                                        readonly : true
                                    });    
                                    nm.textbox({
                                        readonly : true
                                    });
                                },
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 2);
                                     xUrusan = r.kd_urusan;
                                     xBidang = r.kd_bidang;
                                     $('.xprogram').datagrid({
                                        queryParams:{
                                            kd_urusan : r.kd_urusan,
                                            kd_bidang : r.kd_bidang
                                        }
                                     });
                                     $('.xtab').tabs('select', 2);
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
                            data-options="url:'store/program/list.php',
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
                                    var kd = $('#kode');
                                    var nm = $('#nama');     
                                    kd.textbox('setValue', r.kd_program);
                                    nm.textbox('setValue', r.nm_program);
                                    $('.x-edit,.x-add, .x-del').linkbutton({disabled:false});
                                    $('.x-save').linkbutton({disabled:true});

                                    kd.numberbox({
                                        readonly : true
                                    });    
                                    nm.textbox({
                                        readonly : true
                                    });
                                },
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 3);
                                     xUrusan = r.kd_urusan;
                                     xBidang = r.kd_bidang;
                                     xProgram = r.kd_program;
                                     $('.xkegiatan').datagrid({
                                        queryParams:{
                                            kd_urusan : r.kd_urusan,
                                            kd_program : r.kd_program,
                                            kd_bidang : r.kd_bidang
                                        }
                                     });
                                     $('.xtab').tabs('select', 3);
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
                            data-options="url:'store/kegiatan/list.php',
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
                                    $('#kode').numberbox('setValue', r.kd_kegiatan);
                                    $('#nama').textbox('setValue', r.nm_kegiatan);
                                    var kd = $('#kode');
                                    var nm = $('#nama');     

                                    kd.numberbox({
                                        readonly : true
                                    });    
                                    nm.textbox({
                                        readonly : true
                                    });
                                    $('.x-edit,.x-add, .x-del').linkbutton({disabled:false});
                                    $('.x-save').linkbutton({disabled:true});
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
        
        $(".x-add").bind('click', function () {
            var me =  $(".x-add").linkbutton('options');
            state = "add";
            if (me.disabled) {
                return;
            };

            var kd = $("#kode");
            var nm = $("#nama");     

            kd.numberbox({
                readonly : false
            });    
            nm.textbox({
                readonly : false
            });

            kd.numberbox('clear');
            nm.textbox('clear');
            kd.numberbox('textbox').focus();


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
            var kd = $("#kode");
            var nm = $("#nama");     
   
            nm.textbox({
                readonly : false
            });
            nm.textbox('textbox').focus();


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
            var kd = $("#kode");
            var nm = $("#nama");
            var row = $('.x'+rekening).datagrid('getSelected');
            row.tipe = rekening;
            $.post('store/program_kegiatan/delete.php', row)
                .done(function(data) {
                    var data = eval('(' + data + ')');
                    if (data.success){
                        $.messager.show({  
                            title: 'Status',  
                            msg: data.message  
                        });
                        $('.x'+rekening).datagrid('reload');
                        $('.x-edit').linkbutton({disabled:true});
                        $('.x-add').linkbutton({disabled:false});
                        $('.x-del').linkbutton({disabled:true});
                        $('.x-save').linkbutton({disabled:true});

                        kd.numberbox({
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


            var kd = $("#kode");
            var nm = $("#nama");

            var KD = kd.numberbox('getValue');
            var NM = nm.textbox('getValue');

            // validasi inputan
            if (KD == "" || NM == "" || KD == 0 || NM == 0){
                $.messager.alert('Warning', "Harap di isi data Uraian " + rekening.toUpperCase(),'', function(){
                    nm.textbox('textbox').focus(); 
                });
                return;
            }

            if ( state == "add") {
                var a = $('.x'+rekening).datagrid('getRowIndex', parseInt(KD));
                // console.log(a);
                if (a != "-1") {
                    $.messager.alert('Warning', "Kode Rekening " + KD + " Sudah Ada!",'', function(){
                        kd.numberbox('textbox').focus(); 
                    });

                    return;
                }

            }

            var rows = $('.x'+rekening).datagrid('getRows');
            if (rows.length === 0 ) {
                // console.log('masuk trigger');
                var row = {};
                row.kd_urusan = xUrusan;
                row.kd_bidang = xBidang;
                if(rekening == 'kegiatabn') {
                    row.kd_program = xProgram;
                }
                console.log(row);
            }
            else {
                var row = rows[0];
            }

            row.tipe = rekening;
            row.kode = KD;
            row.nama = NM;
            
            $.post('store/program_kegiatan/save.php', row)
                .done(function(data) {
                    var data = eval('(' + data + ')');
                    if (data.success){
                        $.messager.show({  
                            title: 'Status',  
                            msg: data.message  
                        });
                        $('.x'+rekening).datagrid('reload');
                        $('.x-edit').linkbutton({disabled:true});
                        $('.x-add').linkbutton({disabled:false});
                        $('.x-del').linkbutton({disabled:true});
                        $('.x-save').linkbutton({disabled:true});

                        kd.numberbox({
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