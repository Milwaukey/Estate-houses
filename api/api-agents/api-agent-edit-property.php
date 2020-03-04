<?php 
    require_once(__DIR__ . '/../functions.php');

    // // VALIDATION BACKEND
    // // TITLE 
    $sPropertyTitle = $_POST['txtTitle'];
    // if( empty($sPropertyTitle) ){ echo'You must write a title'; }
    // if( strlen($sPropertyTitle) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
    // if( strlen($sPropertyTitle) > 25 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

    // // Description 
    $sDescription = $_POST['txtDescription'];
    // if( empty($sDescription) ){ sendResponse(0, 'You must write a title', __LINE__); }
    // if( strlen($sDescription) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
    // if( strlen($sDescription) > 500 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }

    // // PRICE 
    $sPrice = $_POST['txtPrice'];
    // if( empty($sPrice) ){ sendResponse(0, 'txtPrice is empty', __LINE__); }
    // if( !ctype_digit( $sPrice ) ){ sendResponse(0, 'Not a number', __LINE__); }
    // if( strlen($sPrice) < 1 ){ sendResponse(0,'txtPrice must be min 2 digits', __LINE__); }
    // if( strlen($sPrice) > 20 ){ sendResponse(0, 'txtPrice must be max 20 digits', __LINE__); }

    // if( $sPrice < 1 ){ sendResponse(0,'txtPrice must cost at least 5 DKK', __LINE__); }
    // if( $sPrice > 10000000 ){ sendResponse(0,'txtPrice can max cost 10.000.000', __LINE__); }

    // // Streetname
    $sStreetname = $_POST['txtStreetName'];
    // if( empty($sStreetname) ){ sendResponse(0, 'You must write a street', __LINE__); }
    // if( strlen($sStreetname) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
    // if( strlen($sStreetname) > 50 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }


    // // Street number
    $sStreetNumber = $_POST['txtStreetNumber'];
    // if( empty($sStreetNumber) ){ sendResponse(0, 'You must write a street', __LINE__); }
    // if( strlen($sStreetNumber) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
    // if( strlen($sStreetNumber) > 6 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }


    // // Zip
    $sZip = $_POST['txtZip'];
    // if( empty($sZip) ){ sendResponse(0, 'You must write a street', __LINE__); }
    // if( strlen($sZip) < 1 ){ sendResponse(0,'Must be more than 1 character', __LINE__); }
    // if( strlen($sZip) > 5 ){ sendResponse(0, 'Must be max 25 characters', __LINE__); }


    // // SIZE OF PROPERTY
    $sSizeOfProperty = $_POST['txtPropertySize'];
    // if( empty($sSizeOfProperty)){ sendResponse(0, 'txtPropertySize is empty', __LINE__); }
    // if( !ctype_digit( $sSizeOfProperty) ){ sendResponse(0, 'Not a number', __LINE__); }
    // if( strlen($sSizeOfProperty) < 1 ){ sendResponse(0,'txtPropertySize must be at least 2 digits', __LINE__); }
    // if( strlen($sSizeOfProperty) > 20 ){ sendResponse(0, 'txtPropertySize can max 20 digits', __LINE__); }

    // if( $_POST['txtPropertySize'] < 5 ){ sendResponse(0,'txtPropertySize must be at last 5squaremeters', __LINE__); }
    // if( $_POST['txtPropertySize'] > 500000 ){ sendResponse(0,'txtPropertySize must be at last 5squaremeters', __LINE__); }


    // // Coordinates
    $sCoordinatesLon = $_POST['txtCoordinateLon'];
    // if( empty($sCoordinatesLon)){ sendResponse(0, 'txtPropertySize is empty', __LINE__); }

    $sCoordinatesLat = $_POST['txtCoordinateLat'];
    // if( empty($sCoordinatesLat)){ sendResponse(0, 'txtPropertySize is empty', __LINE__); }


    $jAgent = $_POST['agentId'];

    $sjData = file_get_contents(__DIR__ . '/../../data/data.json');

    $jData = json_decode($sjData);

    $sLoggedInAgentPorperties = count($jData->agents->$jAgent->properties);


    // Loops though the array of properties 
    for($i = 0; $i < $sLoggedInAgentPorperties; $i++){


        // Variable that contains the single value of the click looped proprety
        $sEditingProperty = $jData->agents->$jAgent->properties[$i];

        // Checks if the matching ID passing through URL matches one of the objects in the array of properties 
        if($_POST['propertyId'] == $sEditingProperty->id){

            // echo $sEditingProperty->id;
        
            $sEditingProperty->title = $sPropertyTitle;
            $sEditingProperty->description = $sDescription;
            $sEditingProperty->price = intval($sPrice);
            $sEditingProperty->adress->steet = $sStreetname;
            $sEditingProperty->adress->streetNumber = $sStreetNumber;
            $sEditingProperty->adress->zip = $sZip;
            $sEditingProperty->size->value = $sSizeOfProperty;
            $sEditingProperty->geometry->coordinates[0] = floatval($sCoordinatesLon);
            $sEditingProperty->geometry->coordinates[1] = floatval($sCoordinatesLat);

            $sjData = json_encode($jData, JSON_PRETTY_PRINT);

            file_put_contents(__DIR__ . '/../../data/data.json', $sjData);

            sendResponse(1, 'Updated', __LINE__);

            
        }
    
}

sendResponse(0, 'No update', __LINE__);
