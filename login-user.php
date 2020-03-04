<?php $sPageTitle = 'Login as user'; $sActive = 'login'; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav.php'); ?>



<?php

// Check if the user ALREADY have a session
session_start();
if( $_SESSION ){ header('Location: profile-user.php'); }

?>


<div id="search_container">

<h1>Login<div class="login_signup_special_title">as user</div></h1>


<form id="frmLogin">
    <div>Your Email</div>
    <input name="txtEmail" type="text" placeholder="Email" data-type="email" data-min="3" data-max="20">
    <div>Your Password</div>
    <input name="txtPassword" type="text" placeholder="Password" data-type="string" data-min="5" data-max="25">
    <button type="submit" onclick="login_user(this); return false">Login</button>
</form>


<div class="overlay"></div>
<div id="background_image_search"></div>

</div>




<?php $sLinkToScript = '<script src="js/login-user.js"></script>'; require_once(__DIR__ . '/components/bottom.php'); ?>

