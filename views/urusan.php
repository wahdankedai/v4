<div id='x-datagrid'/>
<script type="text/javascript">
var halaman = "Data Master Urusan";
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
                href: BASE_URL+ 'store/urusan/view_create.php',
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
                                    $('#x-dialog').dialog('close')
                                    $('#x-datagrid').datagrid('reload');
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
                    $('#kd_urusan').numberbox('textbox').focus(); 
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
                        $.post(BASE_URL + 'store/urusan/delete.php', function (data) {
                            $.messager.show({  
                                title: 'Status',  
                                msg: data  
                            });
                        });
                        $('#x-dialog').dialog('close');
                        $('#x-datagrid').datagrid('reload');
                    }
                });
            }
        }
    }],
    columns:[[
        {field:'kd_urusan',title:'Kode',width:100, align:'right'},
        {field:'nm_urusan',title:'Nama Urusan',width:280}
    ]],
    rownumbers : true,
    singleSelect:true,
    striped:true
});

    $('#x-datagrid').datagrid({url:BASE_URL+ 'store/urusan/list.php',resize:true});
</script>