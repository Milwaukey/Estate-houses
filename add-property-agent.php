<?php session_start(); if( !$_SESSION['jAgent'] ){ header('Location: login-agent.php'); } $jAgent = $_SESSION['jAgent']; ?>
<?php $sPageTitle = 'Add new property - Agent'; $sActive = 'add_properties'; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav-agent.php');  ?>
<?php $sjData = file_get_contents(__DIR__ .'/data/data.json'); $jData = json_decode($sjData); $jAgents = $jData->agents; ?>

<div id="page_container">


    <h1 class="add_new_property_h1">Add new property</h1>
    
    <form id="frmNewProperty">
        
    <input name="txtTitle" type="text" placeholder="Title" data-type="string" data-min="1" data-max="18">
    <input name="txtDescription" type="text" placeholder="Description" data-type="string" data-min="1" data-max="200">
    <input name="txtPrice" type="text" placeholder="Price" data-type="integer" data-min="1">

    <div class="name_wrapper">
    <input name="txtStreetName" type="text" placeholder="Street name" data-type="string" data-min="1" data-max="50">
    <input name="txtStreetNumber" type="text" placeholder="Street number" data-type="string" data-min="1" data-max="6">
    </div>

    <input name="txtZip" type="text" placeholder="Zip" data-type="string" data-min="4" data-max="4">
    <input name="txtPropertySize" type="text" placeholder="Property size in squaremeters" data-type="integer" data-min="5">

    <div class="name_wrapper">
    <input name="txtCoordinateLon" type="text" placeholder="Coordinates Lon">
    <input name="txtCoordinateLat" type="text" placeholder="Coordinates Lat">
    </div>
    <input id="propertyImageUpload" name="addPropertyImages[]" type="file" multiple="multipart/form-data" required>

    <button onclick="add_new_property(this); return false">Add new property</button>
</form>



 
</div>



<?php $sLinkToScript = '<script src="js/add-new-property-agent.js"></script>'; require_once(__DIR__ . '/components/bottom.php'); ?>

