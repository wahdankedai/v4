<div id='x-datagrid'/>

<div id="toolbar">
        Urusan: 
        <input id="pilihUrusan" class="easyui-combobox" data-options="
            valueField: 'kd_urusan',
            textField: 'nm_urusan',
            url: BASE_URL + 'store/urusan/list.php',
            onChange: function (n,o) {
                if(n!=o && $.isNumeric(n)) {
                    $('#pilihBidang').combobox({
                        disabled:false, 
                        queryParams : {
                            kd_urusan : n
                        }
                    });
                }
            }" />
         Bidang: 
        <input id="pilihBidang" class="easyui-combobox" data-options="
            valueField: 'kd_bidang',
            textField: 'nm_bidang',
            disabled:true,
            panelWidth:500,
            url: BASE_URL + 'store/bidang/list.php',
            onChange : function (n,o) {
                var me = $('#pilihBidang');
                if(n!=o && $.isNumeric(n)) {
                    me.combobox('hidePanel');
                    var l = $('#pilihUrusan').combobox('getValue');
                    $('#x-datagrid').datagrid({
                        queryParams : {
                            kd_urusan : l,
                            kd_bidang : n,
                        }
                    });
                }
            }" />
        <a id="addSatker" class="easyui-linkbutton" iconCls="icon-add">Tambah</a>
        <a id="editSatker" class="easyui-linkbutton" iconCls="icon-edit">Edit</a>
        <a id="delSatker" class="easyui-linkbutton" iconCls="icon-remove">Hapus</a>
</div>
<script type="text/javascript">
var halaman = "Data Master Satuan Kerja";
$('#x-datagrid').datagrid({
    title: halaman,
    fit:true,
    toolbar: "#toolbar",
    columns:[[
        {field:'kd_urusan',title:'Kode Urusan',width:100, align:'right',sortable:true,order:'asc'},
        {field:'kd_bidang',title:'Kode Bidang',width:100, align:'right',sortable:true,order:'asc'},
        {field:'kd_satker',title:'Kode Satker',width:100, align:'right',sortable:true,order:'asc'},
        {field:'nm_singkat',title:'Nama Singkat',width:280},
        {field:'nm_satker',title:'Nama Satker',width:480}
    ]],
    rownumbers : true,
    singleSelect:true,
    remoteSort:false,
    multiSort:true,
    striped:true
});

    $('#x-datagrid').datagrid({url:BASE_URL+ 'store/satker/list.php',resize:true,queryParams : {
        kd_urusan : 0,
        kd_bidang : 0,
    }});

    $("#delSatker").bind('click', function(){
        var row = $('#x-datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Hapus ' + halaman, 'Apakah Anda yakin bahwa data tersebut akan anda hapus?', function(r){
                if (r)
                {
                    $.post(BASE_URL + 'store/satker/delete.php', 
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
    $("#addSatker").bind('click', function(){
        var pilihUrusan = $('#pilihUrusan').combobox('getValue');
        var pilihBidang = $('#pilihBidang').combobox('getValue');
        
        if (pilihUrusan =="" || pilihBidang =="") {
             $.messager.alert('Warning', 'Pilih Urusan dan Bidang terlebih Dahulu!!');
        } else {
            $('#x-dialog').dialog({
                title: 'Tambah ' + halaman,
                width: 450,
                height: 180,
                modal:true,
                href: BASE_URL+ 'store/satker/view_create.php?kd_urusan=' + pilihUrusan + '&kd_bidang='+pilihBidang,
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
                    $('#kd_satker').numberbox('textbox').focus(); 
                }
            });  
        }
    });

    $("#editSatker").bind('click', function(){
        var rowSatker = $('#x-datagrid').datagrid('getSelected');

        if (! rowSatker) {
             $.messager.alert('Warning', 'Pilih data yang akan dirubah terlebih Dahulu!!');
        } else {
            $('#x-dialog').dialog({
                title: 'Edit ' + halaman,
                width: 480,
                height: 180,
                modal:true,
                href: BASE_URL+ 'store/satker/view_edit.php',
                queryParams : rowSatker,
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
                    $('#nm_satker').textbox('textbox').focus(); 
                }
            });  
        }
    });
</script>