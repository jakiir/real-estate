jQuery(document).ready(function($) {

    // Show the login dialog box on click
    $('a#show_login').on('click', function(e){
        $('body').prepend('<div class="login_overlay"></div>');
        $('form#login').fadeIn(500);
        $('div.login_overlay, form#login a.close').on('click', function(){
            $('div.login_overlay').remove();
            $('form#login').hide();
        });
        e.preventDefault();
    });

    // Perform AJAX login on form submit
    $('form#login').on('submit', function(e){
        $('div.login_message').show().html('<font class="alert alert-info">'+ajax_login_object.loadingmessage+'</font>');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(), 
                'password': $('form#login #password').val(), 
                'security': $('form#login #security').val() },
            success: function(data){                
				console.log(data.loggedin);
                if (data.loggedin == true){
					if(data.user_roles == 'administrator'){
						document.location.href = ajax_login_object.homeurl;
					} else if(data.user_roles == 'inspector') {
						document.location.href = ajax_login_object.homeurl;
					} else {
						document.location.href = ajax_login_object.homeurl;
					}					
                    //document.location.href = ajax_login_object.redirecturl;
					$('div.login_message').html('<font style="color:green" class="alert alert-success">'+data.message+'</font>');
                } else {
					$('div.login_message').html('<font class="alert alert-danger">'+data.message+'</font>');
				}
            }
        });
        e.preventDefault();
    });

});