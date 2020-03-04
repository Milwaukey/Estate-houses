<?php session_start(); if( !$_SESSION['jAgent'] ){ header('Location: login.php'); } $jAgent = $_SESSION['jAgent']; ?>
<?php $sPageTitle = 'Profile - Agent'; $sActive = 'profile'; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav-agent.php');  ?>
<?php $sjData = file_get_contents(__DIR__ .'/data/data.json'); $jData = json_decode($sjData); $jAgents = $jData->agents; ?>

<div id="background_image_container">


<div id="agent_user_profile_container">
<h1>Profile</h1>


    <img id="agent_profileImages" src="images/uploadedImages/agent-images/profile/<?= $jAgents->$jAgent->profileImage ?>">

    <div id="<?= $jAgent; ?>" class="profile_information">
    <div>Firtname</div>
        <input data-update="firstName" placeholder="Firstname" type="text" value="<?= $jAgents->$jAgent->firstName; ?>" data-type="string" data-min="1" data-max="25">
        <div>Lastname</div>
        <input data-update="lastName" placeholder="Lastname" type="text" value="<?= $jAgents->$jAgent->lastName; ?>" data-type="string" data-min="1" data-max="25">
        <div>Phone</div>
        <input data-update="phone" placeholder="Phone" type="text" value="<?= $jAgents->$jAgent->phone; ?>" data-type="string" data-min="8" data-max="8">
        <div>Email</div>
        <input data-update="email" placeholder="Email" type="text" value="<?= $jAgents->$jAgent->email; ?>" data-type="email" data-min="3" data-max="20">
        <div>Password</div>
        <input data-update="password" placeholder="New password" type="text" value="<?= $jAgents->$jAgent->password; ?>" data-type="string" data-min="5" data-max="25">
    </div>
    
    <div id="<?= $jAgent; ?>">
            <div class="delete_account">Delete Account</div>
    </div>
</div>
        
<div class="overlay"></div>
<div id="background_image_search"></div>
</div>


<?php $sLinkToScript = '<script src="js/profile-agent.js"></script>'; require_once(__DIR__ . '/components/bottom.php'); ?>

