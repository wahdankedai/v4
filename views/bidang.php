<div id='x-datagrid'/>
<script type="text/javascript">
var halaman = "Data Master Bidang";
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
                href: BASE_URL+ 'store/bidang/view_create.php',
                buttons:[{
                    text:'Save',
                    handler:function (){                            
                        $('#fm').form('submit',{  
                            onSubmit:function(){
                                return $('#fm').form('enableValidation').form('validate');
                            },
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
                    $('#kd_bidang').numberbox('textbox').focus(); 
                }
            });  
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
                        $.post(BASE_URL + 'store/bidang/delete.php', {
                            id : row.kd_bidang,
                            nm : row.nm_bidang
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
        {field:'kd_bidang',title:'Kode',width:100, align:'right'},
        {field:'nm_bidang',title:'Nama bidang',width:280}
    ]],
    rownumbers : true,
    singleSelect:true,
    striped:true
});

    $('#x-datagrid').datagrid({url:BASE_URL+ 'store/bidang/list.php',resize:true});
</script>