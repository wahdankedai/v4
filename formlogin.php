 <div class="row p10">

    <div class="row">
        <div class="small-3 columns">
            <label for="username" class="left inline">Username</label>
        </div>
        <div class="small-9 columns">
            <input type="text" id="username" placeholder="username" name="username" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="small-3 columns">
            <label for="password" class="left inline">Password</label>
        </div>
        <div class="small-9 columns">
            <input type="password" placeholder="password" id="password" name="password" class="form-control">
        </div>
    </div>            
    <div class="row">
        <div class="small-3 columns">
            <label for="tahun" class="left inline">Tahun</label>
        </div>
        <div class="small-3 columns">
           <input id="x-tahun" name="tahun" />
        </div>
        <div class="small-6 columns">
          
        </div>
    </div>

    <div class="row">
        <a id="x-login-submit" class='right easyui-linkbutton'type="submit" ><i class="fa fa-lock"></i> Login</a>
    </div>
 </div>
<script type="text/javascript">

$("#x-tahun").combobox({
    valueField:'tahun',
    textField:'tahun',
    url:'store/tahun.php',
    inputEvents: $.extend({}, $.fn.combobox.defaults.inputEvents, {
        blur: function(e){
            $.fn.combobox.defaults.keyHandler.enter.call(e.data.target);
        }
    })
});

$("#x-login-submit").click(function() {
		var user = document.getElementById('username').value;
		var pass = document.getElementById('password').value;
		var th = $('#x-tahun').combobox('getValue');
		
        $.post("store/user/login.php", { 
            username: user,
            password:pass,
            tahun:th
        }).done(function(d) {
            // console.log(d);
            window.location.reload();

        }).fail(function() {
            $.messager.show({
                title:'Gagal',
                msg:'Gagal Login',
                timeout:5000,
                showType:'slide'
            });
        });


	});
</script>