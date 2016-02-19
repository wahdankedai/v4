<!DOCTYPE html>
<?php require 'boot.php'; ?>
<?php $aplikasi =  Config::get('aplikasi'); ?>
<?php 
    if (! isset($_SESSION[$aplikasi->name]) || $_SESSION[$aplikasi->name]['auth'] == "") {
        App::redirectTo('login');
    } 
?>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $aplikasi->name . " " .$aplikasi->client; ?></title>
	<link rel="stylesheet" type="text/css" href="static/css/easyui.css">
	<script type="text/javascript" src="static/js/jquery.min.js"></script>
	<script type="text/javascript" src="static/js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="app.js"></script>
    <script type="text/javascript">
        var BASE_URL = "<?php echo BASE_URL; ?>"; 
    </script>
    <script type="text/javascript">
        var configApp = {};

        $.post('store/config.php')
            .done( function (data) {
                configApp = JSON.parse(data);
            });

    </script>
</head>
<body class="easyui-layout">

	<div data-options="region:'west',split:true,border:false"  style="width:230px;padding:0px;">
		<div class="easyui-layout" data-options="fit:true">
            <div id="x-menu"data-options="region:'center',border:true,collapsible:false,iconCls:'icon-app-menu'" title="Main Menu">
			 <ul id="x-menu-tree" style="padding:0 10px">
			</ul>
			</div>
            
            <div id="x-status" data-options="region:'north',border:true,collapsible:false" style="overflow:hidden;height:170px;padding:10px;">
				<div class="row">
					<img src="static/images/logo.png">
				</div>
				<div class="row mt10 ">
					<div class="flr">
						<b>Modul</b> : <input class="modulSelector"  name="modulSelector">
					</div>
				</div>
			</div>
        </div>
	</div>

    <div id="x-content" data-options="region:'center'">
        <div id="" class="bg-kotak"  title="Selamat Datang di Emoneva - Sistem Informasi Monitoring & Evaluasi">
            
        </div>

    </div>

    <div id="x-dialog"></div>
    <div id="x-dialog2"></div>
    <div id="x-dialog3"></div>

    <script type="text/javascript">

	    $(".modulSelector").combobox({
	    	url: BASE_URL + 'store/modul/list.php',
		    valueField:'id',
		    textField:'modul',
		    width:120,
            onChange: function (n,o) {
                $("#x-menu-tree").tree({
                    queryParams : {
                        modul : n
                    }
                })
            } 
	    });

        $("#x-menu-tree").tree({
            url : BASE_URL + 'store/menu/list.php',
            lines : true,
            onClick: function(node){
                
                if (node.component != "") {

                    $.post( "view.php", { view: node.id })
                        .done(function( data ) {
                            $("#x-content").empty();
                            $("#x-content").append(data);
                            $.parser.parse();   
                        })
                        .fail(function(e) {
                            console.log(e);
                        });
                }

            }
        });


    </script>
</body>
</html>