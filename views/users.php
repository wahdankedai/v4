<?php 

?>

<div class="easyui-layout" data-options="fit:true">
    
    <!-- List Data User -->
    <div data-options="region:'center',title:'Data User'">
        <table class="easyui-datagrid xuser"
                data-options="url:'store/user/list.php',
                    method:'get',
                    border:false,
                    singleSelect:true,
                    fit:true,
                    singleSelect:true,
                    rownumbers:true,
                    onSelect : function(i,r) {
                        $('.xdetail-user').datagrid({
                            queryParams : {userid : r.id}
                        });
                    }">
            <thead data-options="frozen:true">
                <tr>
                    <th data-options="field:'id',hidden:true" width="80">ID</th>
                    <th data-options="field:'username'" width="170">Username</th>
                    <th data-options="field:'role'" width="150">Role</th>
                    <th data-options="field:'satker'" width="200">Satker</th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th data-options="field:'email'" width="200">E Mail</th>
                    <th data-options="field:'nama'" width="170">Nama</th>
                    <th data-options="field:'alamat'" width="250">Alamat</th>
                    <th data-options="field:'telepon'" width="150">HP</th>
                    <th data-options="field:'is_whatsapp'" width="30">WA</th>
                    <th data-options="field:'pin_bb'" width="130">PIN BB</th>
                </tr>
            </thead>
        </table>
    </div>
</div>