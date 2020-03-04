<?php 

require_once(__DIR__ . '/../functions.php');



// ************* VALIDATE ************* //
// NAME
$sFirstName = $_POST['txtFirstName'];
if( empty($sFirstName) ){ sendResponse(0, 'You must write a first name', __LINE__); }
if( strlen($sFirstName) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
if( strlen($sFirstName) > 25 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

// LASTNAME
$sLastName = $_POST['txtLastName'];
if( empty($sLastName) ){ sendResponse(0, 'You must write a last name', __LINE__); }
if( strlen($sLastName) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
if( strlen($sLastName) > 25 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

// EMAIL 
$sEmail = $_POST['txtEmail'];
if( empty($sEmail) ){ sendResponse(0, 'You must write an email', __LINE__); }
if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) { sendResponse(0, 'Not a valid email', __LINE__);}


// PHONE 
$sPhone = $_POST['txtPhone'];
if( empty($sPhone) ){ sendResponse(0, 'You must write a phone number', __LINE__); }
if( !ctype_digit( $sPhone ) ){ sendResponse(0, 'You must write numbers', __LINE__); }
if( strlen($sPhone) != 8 ){ sendResponse(0,'Must be more than 7 character', __LINE__); }


// PASSWORD + PASSWORD CONFIRM
$sPassword = $_POST['txtPassword'];
$sConfirmPassword = $_POST['txtConfirmPassword'];
if( empty($sPassword) ){ sendResponse(0, 'You must write a password', __LINE__); }
if( strlen($sPassword) < 5 ){ sendResponse(0,'Must be more than 4 character', __LINE__); }
if( strlen($sPassword) > 25 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

if($sPassword != $sConfirmPassword){ sendResponse(0, 'The password must be the same', __LINE__); }

// PROFILE IMAGE
$sProfilePicture = $_FILES['agentProfileImage']['name'];
if( empty($sProfilePicture) ){ sendResponse(0, 'Must upload a profile image', __LINE__); };

$sFileSize = $_FILES['agentProfileImage']['size'];
if( $_FILES['agentProfileImage']['size'] < 20480 ){ sendResponse('0', 'The file is too small', __LINE__); }
if( $_FILES['agentProfileImage']['size'] > 5242880){ sendResponse('0', 'The file is too large', __LINE__); }

$sExtension = pathinfo( $_FILES['agentProfileImage']['name'] , PATHINFO_EXTENSION) ;
$sExtension = strtolower($sExtension);

$aAllowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
if( !in_array($sExtension, $aAllowedExtensions) ){
    sendResponse('0', 'Must be png, jpg, jpeg, gif', __LINE__);
}



/* ************************************************************************************************ */

$sjData = file_get_contents(__DIR__ . '/../../data/data.json');

$jData = json_decode($sjData);

 // Loop though and check if the email already exsist in the database
 foreach($jData->agents as $jAgent){

    if($sEmail == $jAgent->email ){

        sendResponse('0', 'Email does already excist', __LINE__);
        
    } 

}

$sUniqueId = uniqid();
$jData->agents->$sUniqueId = new stdClass();

$jData->agents->$sUniqueId->firstName = $sFirstName;
$jData->agents->$sUniqueId->lastName = $sLastName;
$jData->agents->$sUniqueId->email = $sEmail;
$jData->agents->$sUniqueId->phone = $sPhone;
$jData->agents->$sUniqueId->password = $sPassword;
$jData->agents->$sUniqueId->active = 0;



$sUniqueImagesName = uniqid().'.'. $sExtension ;
$jData->agents->$sUniqueId->profileImage = $sUniqueImagesName;
move_uploaded_file($_FILES['agentProfileImage']['tmp_name'], __DIR__ . "/../../images/uploadedImages/agent-images/profile/$sUniqueImagesName");


$jData->agents->$sUniqueId->properties = [];


$sjData = json_encode($jData, JSON_PRETTY_PRINT);

file_put_contents(__DIR__ . '/../../data/data.json', $sjData);

sendResponse(1, 'Done', __LINE__); 

