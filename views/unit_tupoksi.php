<script type="text/javascript">
    var rekening;
</script>
<div class="easyui-layout tupoksi" data-options="fit:true">
        <div data-options="region:'south',split:true" style="height:50px;">
            <div class="row p10">
                <div class="row mb20">
                    <div class="small-4 columns">
                        <label for="kd_bidang" class="left inline">Pilih Bidang Urusan</label>
                    </div>
                    <div class="small-8 columns">
                        <input id="kd_bidang" class="easyui-combobox" data-options="
                            valueField: 'kd_bidang',
                            textField: 'nm_bidang',
                            disabled:true,
                            panelWidth:500,
                            url: BASE_URL + 'store/bidang/list_tupoksi.php',
                            queryParams : {
                                kode : 0
                            },
                            onChange : function (n,o) {
                                var me = $('#kd_bidang');
                                var dg = $('.xunit');

                                var dgs = dg.datagrid('getSelected');

                                var r = {};

                                r.kd_unit = dgs.kode;


                                if(n!=o && $.isNumeric(n)) {
                                    r.kd_bidang = n;
                                   $.post('store/organisasi/add_tupoksi.php', r)
                                    .done(function(data) {
                                        var data = eval('(' + data + ')');
                                        if (data.success){
                                            $.messager.show({  
                                                title: 'Status',  
                                                msg: data.message  
                                            });
                                            $('.xbidang').datagrid({
                                                queryParams:{
                                                    kd_bidang : r.kd_unit
                                            }});
                                            $('#kd_bidang').combobox({
                                                queryParams:{
                                                    kode : r.kd_unit
                                                }
                                             });

                                        }
                                        else {
                                            $.messager.alert('Warning', data.message);
                                        }
                                    })
                                    .fail(function() {
                                        console.log(data);
                                    });
                                }
            }" />
                    </div>
                </div>
            </div>
        </div>
        <div data-options="region:'center',title:'Data Master Tupoksi Organisasi'">
            <div class="easyui-tabs xtab" data-options="fit:true,
                border:false,
                plain:true,
                tabPosition:'left',
                onSelect: function(t,i) {
                
                    if (i==0) {
                        $('.xtab').tabs('disableTab', 1);
                        $('#kd_bidang').combobox({disabled:true});

                        var l = $('.tupoksi');
                        var lc = l.layout('panel', 'center');

                        lc.panel('setTitle', 'Data Master Tupoksi Organisasi');


                    } else if (i == 1) {
                        $('#kd_bidang').combobox({disabled:false});
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
                                onDblClickRow: function(i,r) {

                                    var l = $('.tupoksi');
                                    var lc = l.layout('panel', 'center');

                                    lc.panel('setTitle', 'Data Master Tupoksi Organisasi : ' + r.nama);

                                     xUrusan = r.kd_urusan;
                                     $('.xtab').tabs('enableTab', 1);
                                     $('.xbidang').datagrid({
                                        queryParams:{
                                            kd_bidang : r.kode
                                        }
                                     })
                                     $('#kd_bidang').combobox({
                                        queryParams:{
                                            kode : r.kode
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
                                onDblClickRow: function(i,r) {
                                    $.post('store/organisasi/delete_tupoksi.php', r)
                                        .done(function(data) {
                                            var data = eval('(' + data + ')');
                                            if (data.success){
                                                $.messager.show({  
                                                    title: 'Status',  
                                                    msg: data.message  
                                                });
                                                $('.xbidang').datagrid('reload');
                                                $('#kd_bidang').combobox('reload');

                                            }
                                            else {
                                                $.messager.alert('Warning', data.message);
                                            }
                                        })
                                        .fail(function() {
                                            console.log(data);
                                        });
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