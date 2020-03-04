<?php 

$sActivationKey = $_GET['activationKey'];
$sAgentId = $_GET['agentId'];


// echo $sActivationKey . '<br>' . $sAgentId;


$sjData = file_get_contents(__DIR__ . '/data/data.json');

$jData = json_decode($sjData);




//Check if the activation key is a match
if( $jData->users->$sAgentId->activationKey != $sActivationKey ){  echo 'Not possible to activate account';  }


if( $jData->users->$sAgentId->active == 1 ){

    echo "<h1>Hello {$jData->users->$sAgentId->firstName}, you can't activate your account again</h1>";
    exit;

}

$jData->users->$sAgentId->active = 1;


$sjData = json_encode($jData, JSON_PRETTY_PRINT);

file_put_contents(__DIR__ . '/data/data.json', $sjData);