<div id='x-datagrid'/>
<script type="text/javascript">
var halaman = "Data Master Satuan";
$('#x-datagrid').datagrid({
    title: halaman,
    fit:true,
    toolbar: [{
        text:'Tambah',
        iconCls: 'add icon-add',
        handler: function(){
            $('#x-dialog').dialog({
                title: 'Tambah ' + halaman,
                width: 350,
                height: 180,
                modal:true,
                href: BASE_URL+ 'store/satuan/view_create.php',
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
                                    $('#x-datagrid').datagrid('reload');
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
                    $('#nm_satuan').numberbox('textbox').focus(); 
                }
            });  
        }
    },{
        text:'Edit',
        iconCls: 'icon-edit',
        handler: function(){
            var row = $('#x-datagrid').datagrid('getSelected');
            if (row) {
                $('#x-dialog').dialog({
                    title: 'Edit ' + halaman,
                    width: 350,
                    height: 180,
                    modal:true,
                    href: BASE_URL+ 'store/satuan/view_edit.php',
                    queryParams : {id : row.nm_satuan},
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
                                        $('#x-datagrid').datagrid('reload');
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
                        $('#nm_satuan').numberbox('textbox').focus(); 
                    }
                }); 
            }
        }
    },{
        text:'Hapus',
        iconCls: 'icon-remove',
        handler: function(){
            var row = $('#x-datagrid').datagrid('getSelected');
            if (row){
                $.messager.confirm('Hapus ' + halaman, 'Apakah Anda yakin bahwa data tersebut akan anda hapus?', function(r){
                    if (r)
                    {
                        $.post(BASE_URL + 'store/satuan/delete.php', {
                            nm : row.nm_satuan
                        },
                        function (d) {
                            var data = eval('(' + d + ')');
                                if (data.success){
                                    $.messager.show({  
                                        title: 'Status',  
                                        msg: data.message  
                                    });
                                    $('#x-datagrid').datagrid('reload');
                                }
                                else {
                                    $.messager.alert('Warning', data.message);
                                } 
                        });
                    }
                });
            }
        }
    }],
    columns:[[
        {field:'nm_satuan',title:'Nama Satuan',width:480}
    ]],
    rownumbers : true,
    singleSelect:true,
    striped:true,
    remoteSort:false,
    multiSort:true
});

    $('#x-datagrid').datagrid({url:BASE_URL+ 'store/satuan/list.php',resize:true});
</script>