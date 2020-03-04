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


/* ************************************************************************************************ */

$sjData = file_get_contents(__DIR__ . '/../../data/data.json');

$jData = json_decode($sjData);

 // Loop though and check if the email already exsist in the database
 foreach($jData->users as $jUser){

    if($sEmail == $jUser->email ){

        sendResponse('0', 'Email does already excist', __LINE__);
        
    }

}

$sUniqueId = uniqid();
$sActivationKey = uniqid() .'-'. uniqid();
$jData->users->$sUniqueId = new stdClass();

$jData->users->$sUniqueId->firstName = $sFirstName;
$jData->users->$sUniqueId->lastName = $sLastName;
$jData->users->$sUniqueId->email = $sEmail;
$jData->users->$sUniqueId->phone = $sPhone;
$jData->users->$sUniqueId->password = $sPassword;
$jData->users->$sUniqueId->active = 0;
$jData->users->$sUniqueId->activationKey = $sActivationKey;



/******  SEND EMAIL FOR ACTIVATION  **********/

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'src/PHPMailer.php';
require 'src/Exception.php';
require 'src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'information.kea.web08@gmail.com';      // SMTP username
    $mail->Password   = '1234kea1234';                          // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('information.kea.web08@gmail.com', 'KEA VERIFY TEST');
    $mail->addAddress('information.kea.web08@gmail.com', 'KEA MAIL');     // Add a recipient
    $mail->addAddress($sEmail, 'KEA MAIL');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $sPath = "https://localhost/estate-houses/verify-your-account-user.php?activationKey=$sActivationKey&agentId=$sUniqueId";
    $mail->Body    = 'Welcome, <a href="'.$sPath.'">click here to verify your account!</a>';
    $mail->Subject = 'Welcome to Estate-Houses - Verify your account!';

    $mail->send(); // Send the email 
    // echo 'Message has been sent';


} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


$sjData = json_encode($jData, JSON_PRETTY_PRINT);

file_put_contents(__DIR__ . '/../../data/data.json', $sjData);

sendResponse(1, 'Done', __LINE__); 

