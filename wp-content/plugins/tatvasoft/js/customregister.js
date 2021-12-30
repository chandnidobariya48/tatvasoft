jQuery(document).ready(function($){
    $('#wp_signup_form').on('submit', function(e){
        e.preventDefault();
        var that = $(this);
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        var homeurl = $('#homeurl').val();

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: customregister_object.ajax_url,
            data: {
                action: 'registerdata',
                username:username,
                email:email,
                password:password,
                password_confirmation:password_confirmation,
                homeurl:homeurl
            },
            success: function(json){
                console.log(json,'json')
                $('#emailerror').html('');
                $('#usernameerror').html('');
                $('#passworderror').html('');
                $('#confirmerror').html('');
                $('#loginerror').html('');

                if(json['success']){
                    
                    if(json['loginsuccess']){
                        window.location.replace(homeurl);
                    }
                 }else{
                    if(json['error']){
                        if(json['error']['email']){
                            $('#emailerror').html(json['error']['email'])
                        }
                        if(json['error']['username']){
                            $('#usernameerror').html(json['error']['username'])
                        }
                        if(json['error']['password']){
                            $('#passworderror').html(json['error']['password'])
                        }
                        if(json['error']['password_confirmation']){
                            $('#confirmerror').html(json['error']['password_confirmation'])
                        }
                        if(json['error']['loginerror']){
                            $('#loginerror').html('user not register properly')
                        }
                    }
                 }
               
            }
        });

    });
});