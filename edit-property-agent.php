<?php session_start(); if( !$_SESSION['jAgent'] ){ header('Location: login-agent.php'); } $jAgent = $_SESSION['jAgent']; ?>
<?php $sPageTitle = 'Edit property - Agent'; $sActive = ' '; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav-agent.php'); require_once(__DIR__ . '/api/functions.php');  ?>




<div id="page_container">

<h1 class="add_new_property_h1">Edit property</h1>

<?php

$sjData = file_get_contents(__DIR__ .'/data/data.json');

$jData = json_decode($sjData);


// Sets a counter that count how many object that excist in the array of properties 
$sLoggedInAgentPorperties = count($jData->agents->$jAgent->properties);

// Loops though the array of properties 
for($i = 0; $i < $sLoggedInAgentPorperties; $i++){

    // Variable that contains the single value of the click looped proprety
    $sEditingProperty = $jData->agents->$jAgent->properties[$i];

    // Checks if the matching ID passing through URL matches one of the objects in the array of properties 
    if($_GET['id'] == $sEditingProperty->id){
    
        echo '
        <form id="frmEditProperty" method="POST">
            <input name="agentId" type="hidden" value="'.$jAgent.'">
            <input name="propertyId" type="hidden" value="'.$sEditingProperty->id.'">

            <div>Title</div>
            <input name="txtTitle" data-type="string" data-min="5" data-max="20" type="text" placeholder="Title" value="'.$sEditingProperty->title.'">
            
            <div>Description</div>
            <input name="txtDescription" data-type="string" data-min="6" data-max="150" type="text" placeholder="Description" value="'. $sEditingProperty->description.'">
            
            <div>Price</div>
            <input name="txtPrice" data-type="integer" data-min="1" type="text" placeholder="Price" value="'.$sEditingProperty->price.'">
            
            <div>Adress</div>
            <div class="name_wrapper">
            <input name="txtStreetName" data-type="string" data-min="2" data-max="20" type="text" placeholder="Street" value="'.$sEditingProperty->adress->steet.'">
            <input name="txtStreetNumber" data-type="string" data-min="1" data-max="8" type="text" placeholder="Street Number" value="'.$sEditingProperty->adress->streetNumber.'">
            </div>

            <div>Zip</div>
            <input name="txtZip" data-type="string" data-min="4" data-max="4" type="text" placeholder="Zip" value="'.$sEditingProperty->adress->zip.'">
            
            <div>Property size in squaremeters</div>
            <input name="txtPropertySize" data-type="integer" data-min="5" data-max="1000" type="text" placeholder="Size" value="'.$sEditingProperty->size->value.'">
            
            <div>Coordinates (Lon/Lat)</div>
            <div class="name_wrapper">
            <input name="txtCoordinateLon" type="text" placeholder="Lon" value="'.$sEditingProperty->geometry->coordinates[0].'">
            <input name="txtCoordinateLat" type="text" placeholder="Lat" value="'.$sEditingProperty->geometry->coordinates[1].'">
            </div>
            
            <button onclick="edit_property(this); return false">Save</button>
        </form>
    
        ';
        
    }

}


?>


</div>
<?php $sLinkToScript = '<script src="js/edit-property-agent.js"></script>'; require_once(__DIR__ . '/components/bottom.php'); ?>

