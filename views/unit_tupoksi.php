<script type="text/javascript">
    var rekening, state;
</script>
<div class="easyui-layout" data-options="fit:true">
        <div data-options="region:'south',split:true" style="height:150px;">
            <div class="row p10">
                <div class="row mb20">
                    <div class="small-4 columns">
                        <label for="kd_bidang" class="left inline">Pilih Bidang Urusan</label>
                    </div>
                    <div class="small-8 columns">
                        <input  type="text" 
                                id="kd_bidang" 
                                name="kd_bidang" 
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
        <div data-options="region:'center',title:'Data Master Tupoksi Organisasi'">
            <div class="easyui-tabs xtab" data-options="fit:true,
                border:false,
                plain:true,
                tabPosition:'left',
                onSelect: function(t,i) {
                    $('#nama').textbox('setValue', '');
                    $('.x-edit,.x-save, .x-del,.x-add').linkbutton({disabled:true});
                    var kd = $('#kode');
                    var nm = $('#nama');     

                    kd.numberbox({
                        readonly : true
                    });    
                    nm.textbox({
                        readonly : true
                    });
                    if (i==0) {
                        $('.xtab').tabs('disableTab', 1);

                        rekening = 'urusan';
                    } else if (i == 1) {
                        rekening = 'bidang';
                    }

            }">
                <div title="Unit Organisasi">                    
                    <table class="easyui-datagrid xunit"
                            data-options="url:'store/organisasi/list.php',
                                method:'post',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                idField:'kode',
                                onSelect : function (i,r) {
                                    var kd = $('#kode');
                                    var nm = $('#nama');     

                                    kd.numberbox({
                                        readonly : true
                                    });    
                                    nm.textbox({
                                        readonly : true
                                    });

                                    $('#kode').numberbox('setValue', '');
                                    $('#nama').textbox('setValue', '');
                                },
                                onDblClickRow: function(i,r) {
                                     xUrusan = r.kd_urusan;
                                     $('.xtab').tabs('enableTab', 1);
                                     $('.xbidang').datagrid({
                                        queryParams:{
                                            kd_bidang : r.kode
                                        }
                                     });
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
                <div title="Bidang Urusan">
                    <table class="easyui-datagrid xbidang"
                            data-options="url:'store/organisasi/list_bidang.php',
                                method:'post',
                                queryParams:{
                                    kd_unit : 0
                                },
                                idField:'kd_bidang',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                onSelect : function (i,r) {
                                    var kd = $('#kode');
                                    var nm = $('#nama');     

                                    kd.numberbox({
                                        readonly : true
                                    });    
                                    nm.textbox({
                                        readonly : true
                                    });

                                    $('#kode').numberbox('setValue', '');
                                    $('#nama').textbox('setValue', '');
                                },
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 2);
                                     xUrusan = r.kd_urusan;
                                     xBidang = r.kd_bidang;
                                     $('.xunit').datagrid({
                                        queryParams:{
                                            kd_urusan : r.kd_urusan,
                                            kd_bidang : r.kd_bidang
                                        }
                                     });
                                     $('.xtab').tabs('select', 2);
                                }">
                        <thead>
                            <tr>
                                <th data-options="field:'kd_bidang',align:'center'" width="100">Kode Bidang Urusan</th>
                                <th data-options="field:'nm_bidang'" width="500">Uraian Nama Bidang</th>
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
                if(rekening == 'subunit') {
                    row.kd_unit = xUnit;
                }
                // console.log(row);
            }
            else {
                var row = rows[0];
            }
                 // console.log('abis itu ' +row);
            row.tipe = rekening;
            row.kode = KD;
            row.nama = NM;
            
            $.post('store/organisasi/save.php', row)
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