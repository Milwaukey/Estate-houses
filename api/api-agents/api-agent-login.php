<?php 

require_once(__DIR__ . '/../functions.php');
 
    // VALIDATE EMAIL
    $sEmail = $_POST['txtEmail'];
    if( empty($sEmail) ){ sendResponse(0, 'You must write an email', __LINE__); }
    if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) { sendResponse(0, 'Not a valid email', __LINE__);}

    // VALIDATE PASSWORD
    $sPassword = $_POST['txtPassword'];
    if( strlen($sPassword) < 5 ){ sendResponse(0,'Must be more than 4 character', __LINE__); }
    if( strlen($sPassword) > 25 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

    // TO-DO: If not activated - block visit to account


    // Open the file 
    $sjData = file_get_contents(__DIR__ . '/../../data/data.json');
    // echo $sjData;

    // Convert the file
    $jData = json_decode($sjData);

    // echo json_encode($jData->agents);

        // // Loop though and see if email // password is matching
        foreach($jData->agents as $sAgentId => $jAgent){

            // The email MUST match AND(&&) password must also be a match 
            if($jAgent->email == $sEmail && $jAgent->password == $sPassword ){
    
                //Starts the session
                session_start();

                $_SESSION['jAgent'] = $sAgentId;

                // returns value to ajax
                sendResponse(1, 'Match', __LINE__);
            }

    
        }

        sendResponse(0, 'Credentials does not match', __LINE__);



