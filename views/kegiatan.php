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
            queryParams : {
                kd_urusan : 0
            },
            onChange : function (n,o) {
                var me = $('#pilihBidang');
                if(n!=o && $.isNumeric(n)) {
                    me.combobox('hidePanel');
                    var l = $('#pilihUrusan').combobox('getValue');
                    $('#pilihProgram').combobox({
                        disabled:false, 
                        queryParams : {
                            kd_urusan : l,
                            kd_bidang : n
                        }
                    });
                }
            }" />
         Program: 
        <input id="pilihProgram" class="easyui-combobox" data-options="
            valueField: 'kd_program',
            textField: 'nm_program',
            disabled:true,
            panelWidth:500,
            url: BASE_URL + 'store/program/list.php',
            queryParams : {
                kd_urusan : 0,
                kd_bidang : 0
            },
            onChange : function (n,o) {
                var me = $('#pilihProgram');
                if(n!=o && $.isNumeric(n)) {
                    me.combobox('hidePanel');
                    var l = $('#pilihUrusan').combobox('getValue');
                    var m = $('#pilihBidang').combobox('getValue');
                    $('#x-datagrid').datagrid({
                        queryParams : {
                            kd_urusan : l,
                            kd_bidang : m,
                            kd_program : n
                        }
                    });
                }
            }" />
        <a id="addKegiatan" class="easyui-linkbutton" iconCls="icon-add">Tambah</a>
        <a id="editKegiatan" class="easyui-linkbutton" iconCls="icon-edit">Edit</a>
        <a id="delKegiatan" class="easyui-linkbutton" iconCls="icon-remove">Hapus</a>
</div>
<script type="text/javascript">
var halaman = "Data Master Kegiatan";
$('#x-datagrid').datagrid({
    title: halaman,
    fit:true,
    toolbar: "#toolbar",
    columns:[[
        {field:'kd_urusan',title:'Kode Urusan',width:100, align:'right'},
        {field:'kd_bidang',title:'Kode Bidang',width:100, align:'right'},
        {field:'kd_program',title:'Kode Program',width:100, align:'right'},
        {field:'kd_kegiatan',title:'Kode Kegiatan',width:100, align:'right'},
        {field:'nm_kegiatan',title:'Nama Kegiatan',width:480}
    ]],
    rownumbers : true,
    singleSelect:true,
    striped:true
});

    $('#x-datagrid').datagrid({url:BASE_URL+ 'store/kegiatan/list.php',resize:true,queryParams : {
                            kd_urusan : 0,
                            kd_bidang : 0,
                            kd_program : 0
                        }});

    $("#delKegiatan").bind('click', function(){
        var row = $('#x-datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Hapus ' + halaman, 'Apakah Anda yakin bahwa data tersebut akan anda hapus?', function(r){
                if (r)
                {
                    $.post(BASE_URL + 'store/kegiatan/delete.php', 
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
    $("#addKegiatan").bind('click', function(){
        var pilihUrusan = $('#pilihUrusan').combobox('getValue');
        var pilihBidang = $('#pilihBidang').combobox('getValue');
        var pilihProgram = $('#pilihProgram').combobox('getValue');
        
        if (pilihUrusan =="" || pilihBidang =="" || pilihProgram =="") {
             $.messager.alert('Warning', 'Pilih Urusan dan Bidang dan Program terlebih Dahulu!!');
        } else {
            $('#x-dialog').dialog({
                title: 'Tambah ' + halaman,
                width: 450,
                height: 180,
                modal:true,
                href: BASE_URL+ 'store/kegiatan/view_create.php?kd_urusan=' + pilihUrusan + '&kd_bidang='+pilihBidang + '&kd_program='+pilihProgram,
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
                    $('#kd_kegiatan').numberbox('textbox').focus(); 
                }
            });  
        }
    });

    $("#editKegiatan").bind('click', function(){
        var rowKegiatan = $('#x-datagrid').datagrid('getSelected');

        if (! rowKegiatan) {
             $.messager.alert('Warning', 'Pilih data yang akan dirubah terlebih Dahulu!!');
        } else {
            $('#x-dialog').dialog({
                title: 'Edit ' + halaman,
                width: 350,
                height: 180,
                modal:true,
                href: BASE_URL+ 'store/kegiatan/view_edit.php',
                queryParams : rowKegiatan,
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
                    $('#nm_kegiatan').textbox('textbox').focus(); 
                }
            });  
        }
    });
</script>