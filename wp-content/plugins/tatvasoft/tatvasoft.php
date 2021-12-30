<?php
 
/*
 
Plugin Name: Tatvasoft
 
Plugin URI: https://tatvasoft.com/
 
Description: Login, Register,Forgot password Page
 
Version: 1.1.0
 
Author: Tatvasoft
 
Author URI: https://tatvasoft.com
 
License: GPLv2 or later
 
Text Domain: tatvasoft
 
*/

function tatvasoft_activate() { 
    $my_post1 = array(
		'post_type'     => 'page',
		'post_title'    => 'Register',
		'post_content'  => '[custom_register]',
		'post_status'   => 'publish',
		'post_author'   => 1
	  );
	  wp_insert_post( $my_post1 );
	
	  // Create post object
	$my_post2 = array(
		'post_type'     => 'page',
		'post_title'    => 'Login',
		'post_content'  => '[custom_login]',
		'post_status'   => 'publish',
		'post_author'   => 1
	  );
	  wp_insert_post( $my_post2 );
}

register_activation_hook( __FILE__, 'tatvasoft_activate' );


function sd_add_scripts(){
	wp_enqueue_script( 'custom', plugins_url( 'js/custom.js', __FILE__ ), array('jquery') );
	wp_localize_script( 'custom', 'custom_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'customregister', plugins_url( 'js/customregister.js', __FILE__ ), array('jquery') );
	wp_localize_script( 'customregister', 'customregister_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'sd_add_scripts' );

add_shortcode('custom_login','customlogin');
function customlogin(){ 
  // Insert the post into the database
 
		$login = '<form action="" metod="post" class="loginajax" enctype="multipart/form-data">
		<div class="mb-3">
		<label for="username" class="form-label">Email Id/ Username</label>
		<input type="text" name="username" class="form-control username" id="username" aria-describedby="emailHelp">
		<div id="usernameerror" style="color:red"></div>
		</div>
		<div class="mb-3">
		<label for="password" class="form-label">Password</label>
		<input type="password" name="password" class="form-control password" id="password">
		<div id="passworderror" style="color:red"></div>
		</div>
		<input type="submit" value="submit" class="btn btn-primary">
		<div id="loginmsg"></div>
		</form>';

  return $login;
}

add_action( 'wp_ajax_nopriv_logindata', 'logindata_function' );
add_action( 'wp_ajax_logindata', 'logindata_function' );

function logindata_function() {
    $username = $_POST['username'];
    $password = $_POST['password'];

	$json= [];

	if($username !== '' && $password != ''){
		$login_data = array();  
		$login_data['user_login'] = $username;  
		$login_data['user_password'] = $password;  
		$login_data['remember'] = 'true';  
	   
		$user_verify = wp_signon( $login_data, false );   
	   
		if ( is_wp_error($user_verify) )   
		{  
			$json['success'] = false;
		   // Note, I have created a page called "Error" that is a child of the login page to handle errors. This can be anything, but it seemed a good way to me to handle errors.  
		 } else
		{    
			$json['success'] = true;
			
		 }
	}else{
		if($username == ''){
			$json['success'] = false;
			$json['error']['username']= 'Please Enter Username Or Email id';
		}
		if($password == ''){
			$json['success'] = false;
			$json['error']['password']= 'Please Enter Password';
		}
	}

	wp_send_json($json);
	die();
	  
}

add_shortcode('custom_register','customregister');
function customregister(){
	$homeurl = get_site_url();
	$registerform = '<form id="wp_signup_form" action="" metod="post" enctype="multipart/form-data">
	<div class="mb-3">
	<label for="username">Username</label>  
	<input type="text" name="username" id="username">  
	<div id="usernameerror" style="color:red"></div>
	</div>
	<div class="mb-3">
	<label for="email">Email address</label>  
	<input type="text" name="email" id="email"> 
	<div id="emailerror" style="color:red"></div> 
	</div>
	<div class="mb-3">
	<label for="password">Password</label>  
	<input type="password" name="password" id="password">
	<div id="passworderror" style="color:red"></div>
	</div>
	<div class="mb-3">  
	<label for="password_confirmation">Confirm Password</label>  
	<input type="password" name="password_confirmation" id="password_confirmation"> 
	<div id="confirmerror" style="color:red"></div> 
	</div>
	<input type="hidden" id="homeurl" name="homeurl" value="'.$homeurl.'" />
	<input type="submit" id="submitbtn" name="submit" value="Sign Up" />  
	<div id="loginerror" style="color:red"></div>
</form>';

return $registerform;
}

add_action( 'wp_ajax_nopriv_registerdata', 'registerdata_function' );
add_action( 'wp_ajax_registerdata', 'registerdata_function' );

function registerdata_function() {
	
	$json = [];
	$errors = [];

		$username = $_POST['username'];  

        if($username == '') 
        {   
            $errors['username'] = "Please enter a username";  
        } elseif( username_exists( $username ) ) 
        {  
            $errors['username'] = "Username already exists, please try another";  
        }  
		
   
        // Check email address is present and valid  
        $email = $_POST['email'];  
        if( !is_email( $email ) ) 
        {   
            $errors['email'] = "Please enter a valid email";  
        } elseif( email_exists( $email ) ) 
        {  
            $errors['email'] = "This email address is already in use";  
        } 
		$password = $_POST['password'];
        // Check password is valid  
        if( $password == '') 
        {   
            $errors['password'] = "Please enter a valid password";  
        } elseif(0 === preg_match("(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}", $_POST['password']))
        {  
          $errors['password'] = "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";  
        }  
   
        // Check password confirmation_matches  
        if(0 !== strcmp($_POST['password'], $_POST['password_confirmation']))
         {  
          $errors['password_confirmation'] = "Passwords do not match";  
        }  
		
   
        if(0 === count($errors)) 
         {  
   
            $password = $_POST['password'];  
   
            $new_user_id = wp_create_user( $username, $password, $email );  
   
            // You could do all manner of other things here like send an email to the user, etc. I leave that to you.  
   
            $json['success'] = true;  

			$creds = array();
			$creds['user_login'] = $username;
			$creds['user_password'] = $password;
			$creds['remember'] = true;

				$user = wp_signon( $creds, false );

				if ( is_wp_error($user) ){
					$errors['loginerror'] =  $user->get_error_message();
				}else{
					$json['loginsuccess'] = true;
				}

   
        }  else{
			$json['error'] = $errors;
			$json['success'] = false;  
		}
	wp_send_json($json);
	die();
}
