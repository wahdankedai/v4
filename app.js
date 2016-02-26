 /**
  * restrict history back
  * jika terjadi ketidak sengajaan menekan tombol backspace
  * maka halaman tetap, tidak berubah
  */
history.pushState(null, null, 'index.php');
window.addEventListener('popstate', function(event) {
  history.pushState(null, null, 'index.php');
});


/**
 * auto logout 
 */


idleTimer = null;
idleState = false;
idleWait = 5 * 60 * 1000; // 5 menit non aktif = logout

(function ($) {

    $(document).ready(function () {
    
        $('*').bind('mousemove keydown scroll', function () {
        
            clearTimeout(idleTimer);
                    
            if (idleState == true) {             
            }
            
            idleState = false;
            
            idleTimer = setTimeout(function () { 
                
                $.post("logout.php").done(function() {
                   window.location.reload();
                });

                idleState = true; }, idleWait);
        });
        
        $("body").trigger("mousemove");
    
    });
}) (jQuery)


