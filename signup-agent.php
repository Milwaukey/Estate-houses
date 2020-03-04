<?php $sPageTitle = 'Sign up as agent'; $sActive = 'signup'; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav.php'); require_once(__DIR__ . '/api/functions.php'); ?>


<div id="search_container">


    <h1 style="padding-top: 120px;">Signup<div class="login_signup_special_title">as agent</div></h1>
    
    <form id="signupForm">
    <div class="name_wrapper">
        <div>Firstname</div>
        <div>Lastname</div>
        <input name="txtFirstName" type="text" placeholder="First Name" data-type="string" data-min="1" data-max="25">
        <input name="txtLastName" type="text" placeholder="Last Name" data-type="string" data-min="1" data-max="25">
    </div>

        <div>Email</div>
        <input name="txtEmail" type="text" placeholder="Email"  data-type="email" data-min="3" data-max="20">

    <div class="name_wrapper">
        <div>Password</div>
        <div>Confirm password</div>
        <input name="txtPassword" type="text" placeholder="Password" data-type="string" data-min="5" data-max="25">
        <input name="txtConfirmPassword" type="text" placeholder="Confirm Password" data-type="string" data-min="5" data-max="25">
    </div>

        <div>Phone</div>
        <input name="txtPhone" type="text" placeholder="Phone" data-type="string" data-min="8" data-max="8">

        <div>Upload Profile Image</div>
        <input id="signUpImage" name="agentProfileImage" type="file" required>
        <button onclick="signup_agent(this); return false">Signup</button>
    </form>

<div class="overlay"></div>
<div id="background_image_search"></div>

</div>



<?php $sLinkToScript = '<script src="js/signup-agent.js"></script>'; require_once(__DIR__ . '/components/bottom.php'); ?>

  