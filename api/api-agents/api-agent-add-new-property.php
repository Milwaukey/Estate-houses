<?php 
require_once(__DIR__ . '/../functions.php');


session_start();

if( !$_SESSION['jAgent'] ){
    sendResponse(0, 'You must login to add new property', __LINE__);
}

// TITLE 
$sPropertyTitle = $_POST['txtTitle'];
if( empty($sPropertyTitle) ){ sendResponse(0, 'You must write a title', __LINE__); }
if( strlen($sPropertyTitle) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
if( strlen($sPropertyTitle) > 25 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

// TITLE 
$sDescription = $_POST['txtDescription'];
if( empty($sDescription) ){ sendResponse(0, 'You must write a title', __LINE__); }
if( strlen($sDescription) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
if( strlen($sDescription) > 200 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

// PRICE 
$sPrice = $_POST['txtPrice'];
if( empty($sPrice) ){ sendResponse(0, 'txtPrice is empty', __LINE__); }
if( !ctype_digit( $sPrice ) ){ sendResponse(0, 'Not a number', __LINE__); }
if( strlen($sPrice) < 1 ){ sendResponse(0,'txtPrice must be min 2 digits', __LINE__); }
if( strlen($sPrice) > 20 ){ sendResponse(0, 'txtPrice must be max 20 digits', __LINE__); }

if( $sPrice < 1 ){ sendResponse(0,'txtPrice must cost at least 5 DKK', __LINE__); }
if( $sPrice > 10000000 ){ sendResponse(0,'txtPrice can max cost 10.000.000', __LINE__); }

// Streetname
$sStreetname = $_POST['txtStreetName'];
if( empty($sStreetname) ){ sendResponse(0, 'You must write a street', __LINE__); }
if( strlen($sStreetname) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
if( strlen($sStreetname) > 50 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }


// Street number
$sStreetNumber = $_POST['txtStreetNumber'];
if( empty($sStreetNumber) ){ sendResponse(0, 'You must write a street', __LINE__); }
if( strlen($sStreetNumber) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
if( strlen($sStreetNumber) > 6 ){ sendResponse(0, 'Must be max 6 characters', __LINE__); }


// Zip
$sZip = $_POST['txtZip'];
if( empty($sZip) ){ sendResponse(0, 'You must write a street', __LINE__); }
if( strlen($sZip) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
if( strlen($sZip) > 5 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }


// SIZE OF PROPERTY
$sSizeOfProperty = $_POST['txtPropertySize'];
if( empty($sSizeOfProperty)){ sendResponse(0, 'txtPropertySize is empty', __LINE__); }
if( !ctype_digit( $sSizeOfProperty) ){ sendResponse(0, 'Not a number', __LINE__); }
if( strlen($sSizeOfProperty) < 1 ){ sendResponse(0,'txtPropertySize must be at least 2 digits', __LINE__); }
if( strlen($sSizeOfProperty) > 20 ){ sendResponse(0, 'txtPropertySize can max 20 digits', __LINE__); }

if( $_POST['txtPropertySize'] < 5 ){ sendResponse(0,'txtPropertySize must be at last 5squaremeters', __LINE__); }
if( $_POST['txtPropertySize'] > 500000 ){ sendResponse(0,'txtPropertySize must be at last 5squaremeters', __LINE__); }


// Coordinates
$sCoordinatesLon = floatval($_POST['txtCoordinateLon']); // E 12
if( empty($sCoordinatesLon)){ sendResponse(0, 'txtPropertySize is empty', __LINE__); }

$sCoordinatesLat = floatval($_POST['txtCoordinateLat']); // N 55
if( empty($sCoordinatesLat)){ sendResponse(0, 'txtPropertySize is empty', __LINE__); }

// PROPERTY IMAGES
$sPropertyImages = $_FILES['addPropertyImages']['name'];
if( empty($_FILES['addPropertyImages']['name']) ){ sendResponse(0, 'Must contain at least 1 image', __LINE__); };


// Get the file 
$sjData = file_get_contents(__DIR__ . '/../../data/data.json');


// Convert the file 
$jData = json_decode($sjData);


//////// DO YOUR STUFF // $_SESSION['jAgent'];
$sAgentId = $_SESSION['jAgent'];
$sPropertyId = uniqid();


$jProperty = new stdClass();
$jProperty->id = $sPropertyId;
$jProperty->title = $sPropertyTitle;
$jProperty->description = $sDescription;
$jProperty->price = intVal($sPrice);
$jProperty->upLoadedDate = time();
$jProperty->adress = new stdClass();
$jProperty->adress->steet = $sStreetname;
$jProperty->adress->streetNumber = $sStreetNumber;
$jProperty->adress->zip = $sZip;

$jProperty->geometry = new stdClass();

$jProperty->geometry->coordinates = [];

array_push($jProperty->geometry->coordinates, $sCoordinatesLon);
array_push($jProperty->geometry->coordinates, $sCoordinatesLat);

$jProperty->size = new stdClass();
$jProperty->size->value = intVal($sSizeOfProperty);
$jProperty->size->unit = 'squaremeters';
$jProperty->images = [];


// Pushes the single property to the array of properties
array_push($jData->agents->$sAgentId->properties, $jProperty);



// COUNTS the number op oploadeds images in the array
$iNumberOfImages = count($_FILES['addPropertyImages']['name']);

// Loops though the number of oploades images, gives the possible to get path, size and so one for validation
for($i = 0; $i < $iNumberOfImages ; $i++){

    $sImageName = $_FILES['addPropertyImages']['name'][$i]; // $i Makes sure that i loops though all the items so you can access them
    $iImageSize = $_FILES['addPropertyImages']['size'][$i];
    $sTempPathImages = $_FILES['addPropertyImages']['tmp_name'][$i];

    // VALIDATE size, name extension
    $sFileSize = $_FILES['addPropertyImages']['size'][$i];
    if( $_FILES['addPropertyImages']['size'][$i] < 20480 ){ sendResponse('0', 'The file is too small', __LINE__); }
    if( $_FILES['addPropertyImages']['size'][$i] > 5242880){ sendResponse('0', 'The file is too large', __LINE__); }

    $sExtension = pathinfo( $_FILES['addPropertyImages']['name'][$i] , PATHINFO_EXTENSION) ;
    $sExtension = strtolower($sExtension);

    $aAllowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    if( !in_array($sExtension, $aAllowedExtensions) ){
        sendResponse('0', 'Must be png, jpg, jpeg, gif', __LINE__);
    }

    // Add unique name to the image
    $sUniqueImagesName = uniqid().'.'. $sExtension ;
    
    // Removing images from the uploaded folder, to the one i want to store them in
    move_uploaded_file($_FILES['addPropertyImages']['tmp_name'][$i], __DIR__ . "/../../images/uploadedImages/agent-images/properties/$sUniqueImagesName");

    // Adds it to the array in images, property for the json file
    array_push( $jProperty->images, $sUniqueImagesName );

}


// // Convert the file 
$sjData = json_encode($jData, JSON_PRETTY_PRINT);


// Save the file 
file_put_contents(__DIR__ . '/../../data/data.json', $sjData);



sendResponse(1, 'New property added!', __LINE__);
