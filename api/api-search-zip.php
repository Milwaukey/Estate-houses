<?php 


// Eventually this will come from another place with file_get_contents

$sjData = file_get_contents(__DIR__ . '/../data/data.json');

$jData = json_decode($sjData);


// Array that contains the zipcodes
$ZipCodes = [];


// Loops  though the the data, and find all the properties, and add the property zip code to t he array of zipcodes IF it's not already in there
foreach( $jData->agents as $sAgentId => $jAgents ){

    foreach($jAgents->properties as $jProperty){

        if(!in_array ( $jProperty->adress->zip, $ZipCodes )){

            array_push($ZipCodes, $jProperty->adress->zip);

        }
    }
}


if(!isset($_GET['txtSearch'])){

    echo '[]';
    exit;

}

// The users input
$sSearchFor = $_GET['txtSearch'] ?? ' ';


// VALIDATE THE INPUT FIELD



// What i want to send back to the browser
$matches = [];


// Loops though the zipcodes and take it as each individual zipcode
foreach($ZipCodes as $zipCode){


    // Check if the users input mathces, try to find 2400 inside what the user wrote. If any charaters match it matches
    if( strpos( $zipCode,  $sSearchFor ) !== false){
    
        array_push($matches, $zipCode);
    
    }

}    

echo json_encode($matches);



