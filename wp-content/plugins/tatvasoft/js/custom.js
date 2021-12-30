jQuery(document).ready(function($){
    $('form.loginajax').on('submit', function(e){
        e.preventDefault();
        var that = $(this);
        var username = $('.username').val();
        var password = $('.password').val();
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: custom_object.ajax_url,
            data: {
                action: 'logindata',
                username:username,
                password:password
            },
            success: function(json){
                $('#loginmsg').html('');
                $('#usernameerror').html('');
                $('#passworderror').html('');

                if(json['success']){
                    $('#loginmsg').html('User Successfully login');
                }else{
                    if(json['error']){
                        if(json['error']['username']){
                            $('#usernameerror').html(json['error']['username'])
                        }
                        if(json['error']['password']){
                            $('#passworderror').html(json['error']['password'])
                        }
                    }
                    $('#loginmsg').html('Login Id Password Not match');
                }
               
            }
        });

    });
});