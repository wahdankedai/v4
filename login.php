<!DOCTYPE html>
<?php require 'boot.php'; ?>
<?php $app =  Config::get('aplikasi'); ?>

<?php 
    if ( isset($_SESSION[$app->name]) || $_SESSION[$app->name]['auth'] != "") {
        App::redirectTo('index');
    } 
?>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $app->name . " " .$app->client; ?></title>
    <link rel="stylesheet" type="text/css" href="static/css/easyui.css">
    <script type="text/javascript" src="static/js/jquery.min.js"></script>
    <script type="text/javascript" src="static/js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="app.js"></script>
    <script type="text/javascript">
        var BASE_URL = "<?php echo BASE_URL; ?>"; 
    </script>
</head>
<body class="loginBody">
    <div id="x-dialog"></div>


    <script type="text/javascript">

    $(document).ready(function(){
        $("#x-dialog").dialog({
            title: 'Authenticate First',
            width: 500,
            height: 170,
            closable: false,
            draggable: false,
            cache: false,
            href: 'formlogin.php',
            modal: false,
            onLoad : function () {
                var user = document.getElementById('username');
                user.focus();
            }
        });
    });


    </script>
</body>
</html>