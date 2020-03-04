<?php 
require_once(__DIR__ . '/../functions.php');

$sId = $_POST['id'];

// Checks if there is a session with agent
session_start();
if( !$_SESSION['jAgent'] ){
    sendResponse(0, 'You must log in to edit your profile', __LINE__);
}


// Get the file 
$sjData = file_get_contents(__DIR__ . '/../../data/data.json');

// convert the file 
$jData = json_decode($sjData);



// Delete account
unset($jData->agents->$sId);



// convert the file
$sjData = json_encode($jData, JSON_PRETTY_PRINT);


// Save the file 
file_put_contents(__DIR__ . '/../../data/data.json', $sjData);


session_destroy();


sendResponse(1, 'Account Deleted', __LINE__);

