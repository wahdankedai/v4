<?php 
?>

<div class="easyui-layout" data-options="fit:true">
    
    <!-- Kolom Detail User -->
    <div data-options="region:'east',split:true,collapsible:false" title="Detail User" style="width:60%;">
        
    </div>
    
    <!-- List Data User -->
    <div data-options="region:'center',title:'Data User'">
        <table class="easyui-datagrid"
                data-options="url:'store/user/list.php',
                    method:'get',
                    border:false,
                    singleSelect:true,
                    fit:true,
                    singleSelect:true,
                    rownumbers:true">
            <thead>
                <tr>
                    <th data-options="field:'id',hidden:true" width="80">ID</th>
                    <th data-options="field:'username'" width="170">Username</th>
                    <th data-options="field:'email'" width="250">E Mail</th>
                    <th data-options="field:'password'" width="150">Password</th>
                </tr>
            </thead>
        </table>
    </div>
</div>