function deleteUnnecesaryDiv () {
	var d = document.getElementsByClassName('')
}


$(document).ready(function(){

	$('#logout').click(function(e) {
		e.preventDefault();

		$.messager.confirm('Log Out', 'Apakah Anda yakin untuk Keluar?', function(r){
			if (r){
				window.location.replace("logout.php");
			}
		});
	});


	$('#menu-manager').click(function(e) {
		e.preventDefault();

		$.post("view/administrator/menu-manager.php",
		function (data) {
			$("#x-content").empty();
			if (data == "404")
			{
				window.location.replace("logout");
			} 
			else 
			{
				$("#x-content").append(data);
			}
		});

	});

	$('#user-manager').click(function(e) {
		e.preventDefault();

		$.post("view/administrator/user-manager.php",
		function (data) {
			$("#x-content").empty();
			if (data == "404")
			{
				window.location.replace("logout");
			} 
			else 
			{
				$("#x-content").append(data);
			}
		});

	});

	

});
