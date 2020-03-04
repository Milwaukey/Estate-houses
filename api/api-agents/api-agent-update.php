<?php 
require_once(__DIR__ . '/../functions.php');


$sId = $_POST['id'];
$sUpdateKey = $_POST['key'];
$sNewValue = $_POST['value'];

// Checks if there is a session with agent
session_start();
if( !$_SESSION['jAgent'] ){
    sendResponse(0, 'You must log in to edit your profile', __LINE__);
}

// VALIDATION
if( empty($sNewValue) ){ sendResponse(0, 'You must write something', __LINE__); }

if( $sUpdateKey == 'firstName' || $sUpdateKey == 'lastName' ){

    if( strlen($sNewValue) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
    if( strlen($sNewValue) > 25 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

}

if( $sUpdateKey == 'email' ){
    
    if (!filter_var($sNewValue, FILTER_VALIDATE_EMAIL)) { sendResponse(0, 'Not a valid email', __LINE__); }

}

if( $sUpdateKey == 'phone' ){

    if( !ctype_digit( $sNewValue ) ){ sendResponse(0, 'You must write numbers', __LINE__); }
    if( strlen($sNewValue) != 8 ){ sendResponse(0,'Must be excatly 8 digits', __LINE__); }

}

if( $sUpdateKey == 'password' ){

    if( strlen($sNewValue) < 5 ){ sendResponse(0,'Must be more than 4 character', __LINE__); }
    if( strlen($sNewValue) > 25 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

}


// Get the file 
$sjData = file_get_contents(__DIR__ . '/../../data/data.json');

// convert the file 
$jData = json_decode($sjData);

// update the data 
$jData->agents->$sId->$sUpdateKey = $sNewValue;

// convert the file
$sjData = json_encode($jData, JSON_PRETTY_PRINT);

// Save the file 
file_put_contents(__DIR__ . '/../../data/data.json', $sjData);

sendResponse(1, 'Agent updated!', __LINE__);