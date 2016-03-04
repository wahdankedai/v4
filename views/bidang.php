<div id='x-datagrid'/>

<div id="toolbar">
        Urusan: 
        <input id="pilihUrusan" class="easyui-combobox" data-options="
            valueField: 'kd_urusan',
            textField: 'nm_urusan',
            url: BASE_URL + 'store/urusan/list.php',
            onChange: function (n,o) {
                $('#x-datagrid').datagrid({
                    queryParams : {
                        kd_urusan : n
                    }
                });
            }" />
        <a id="addBidang" class="easyui-linkbutton" iconCls="icon-add">Tambah</a>
        <a id="editBidang" class="easyui-linkbutton" iconCls="icon-edit">Edit</a>
        <a id="delBidang" class="easyui-linkbutton" iconCls="icon-remove">Hapus</a>
</div>
<script type="text/javascript">
var halaman = "Data Master Bidang";
$('#x-datagrid').datagrid({
    title: halaman,
    fit:true,
    toolbar: "#toolbar",
    columns:[[
        {field:'kd_urusan',title:'Kode Urusan',width:100, align:'right',sortable:true,order:'asc'},
        {field:'kd_bidang',title:'Kode Bidang',width:100, align:'right',sortable:true,order:'asc'},
        {field:'nm_bidang',title:'Nama bidang',width:280}
    ]],
    rownumbers : true,
    singleSelect:true,
    remoteSort:false,
    multiSort:true,
    striped:true
});

    $('#x-datagrid').datagrid({url:BASE_URL+ 'store/bidang/list.php',resize:true,queryParams : {
        kd_urusan : 0
    }});

    $("#delBidang").bind('click', function(){
        var row = $('#x-datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Hapus ' + halaman, 'Apakah Anda yakin bahwa data tersebut akan anda hapus?', function(r){
                if (r)
                {
                    $.post(BASE_URL + 'store/bidang/delete.php', 
                        row
                    ,
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
    });
    $("#addBidang").bind('click', function(){
        var pilihUrusan = $('#pilihUrusan').combobox('getValue');
        
        if (pilihUrusan =="") {
             $.messager.alert('Warning', 'Pilih Urusan terlebih Dahulu!!');
        } else {
            $('#x-dialog').dialog({
                title: 'Tambah ' + halaman,
                width: 350,
                height: 180,
                modal:true,
                href: BASE_URL+ 'store/bidang/view_create.php?kd_urusan=' + pilihUrusan,
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
                    $('#kd_bidang').numberbox('textbox').focus(); 
                }
            });  
        }
    });

    $("#editBidang").bind('click', function(){
        var pilihUrusan = $('#x-datagrid').datagrid('getSelected');

        if (! pilihUrusan) {
             $.messager.alert('Warning', 'Pilih data yang akan dirubah terlebih Dahulu!!');
        } else {
            $('#x-dialog').dialog({
                title: 'Tambah ' + halaman,
                width: 350,
                height: 180,
                modal:true,
                href: BASE_URL+ 'store/bidang/view_edit.php',
                queryParams : pilihUrusan,
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
                    $('#kd_bidang').numberbox('textbox').focus(); 
                }
            });  
        }
    });
</script>