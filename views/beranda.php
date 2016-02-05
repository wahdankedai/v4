<div class="easyui-layout" data-options="fit:true">
        <div data-options="region:'south',split:true" style="height:250px;">
            <div class="row p10">
                <div class="row mb20">
                    <div class="small-3 columns">
                        <label for="kd_bidang" class="left inline">Kode Program</label>
                    </div>
                    <div class="small-9 columns">
                        <input  type="text" 
                                id="kd_program" 
                                name="kd_program" 
                                class="form-control easyui-numberbox" 
                                data-options="
                                    min:1,
                                    precision:0">
                    </div>
                </div>
                <div class="row mb20">
                    <div class="small-3 columns">
                        <label for="nm_program" class="left inline">Nama</label>
                    </div>
                    <div class="small-9 columns">
                        <input  type="text" 
                                id="nm_program" 
                                name="nm_program" 
                                class="form-control easyui-textbox">
                    </div>
                </div>
                <div class="row p10 mb20">
                    <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Add</a>
                    <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove'">Remove</a>
                    <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'">Save</a>
                    <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-cut',disabled:true">Cut</a>
                    <a href="#" class="easyui-linkbutton">Text Button</a>
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
                    } else if (i == 1) {
                        $('.xtab').tabs('disableTab', 2);
                        $('.xtab').tabs('disableTab', 3);
                    } else if (i == 2) {
                        $('.xtab').tabs('disableTab', 3);
                    }
            }">
                <div title="Urusan">                    
                    <table class="easyui-datagrid xurusan"
                            data-options="url:'store/urusan/list.php',
                                method:'post',
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 1);
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
                                singleSelect:true,
                                fit:true,
                                fitColumns:true,
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 2);
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
                                onDblClickRow: function(i,r) {
                                     $('.xtab').tabs('enableTab', 3);
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
                                fit:true,
                                fitColumns:true">
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