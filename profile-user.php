<?php session_start(); if( !$_SESSION['jUser'] ){ header('Location: login.php'); } $jUser = $_SESSION['jUser']; ?>
<?php $sPageTitle = 'Profile - User'; $sActive = 'profile'; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav-user.php');  ?>
<?php $sjData = file_get_contents(__DIR__ .'/data/data.json'); $jData = json_decode($sjData); $jUsers = $jData->users; ?>


<div id="background_image_container">


<div id="agent_user_profile_container">
<h1>Profile</h1>

<img id="agent_profileImages" src="images/uploadedImages/user-images/default-profile.png">


<div id="<?= $jUser; ?>" class="profile_information">
    <div>Firstname</div>
    <input data-update="firstName" placeholder="Firstname" type="text" value="<?= $jUsers->$jUser->firstName; ?>" data-type="string" data-min="1" data-max="25">
    <div>Lastname</div>
    <input data-update="lastName" placeholder="Lastname" type="text" value="<?= $jUsers->$jUser->lastName; ?>" data-type="string" data-min="1" data-max="25">
    <div>Phone</div>
    <input data-update="phone" placeholder="Phone" type="text" value="<?= $jUsers->$jUser->phone; ?>" data-type="string" data-min="8" data-max="8">
    <div>Email</div>
    <input data-update="email" placeholder="Email" type="text" value="<?= $jUsers->$jUser->email; ?>" data-type="email" data-min="3" data-max="20">
    <div>Password</div>
    <input data-update="password" placeholder="New password here" type="text" value="<?= $jUsers->$jUser->password ?>" data-type="string" data-min="5" data-max="25">
</div>


<div id="<?= $jUser; ?>">
    <div class="delete_account">Delete Account</div>
</div>

</div>

<div class="overlay"></div>
<div id="background_image_search"></div>
</div>


<?php $sLinkToScript = '<script src="js/profile-user.js"></script>'; require_once(__DIR__ . '/components/bottom.php'); ?>

