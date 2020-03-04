<?php session_start(); if( !$_SESSION['jAgent'] ){ header('Location: login-agent.php'); } $jAgent = $_SESSION['jAgent']; ?>
<?php $sPageTitle = 'Profile - Agent'; $sActive = 'my_properties'; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav-agent.php');  ?>
<?php $sjData = file_get_contents(__DIR__ .'/data/data.json'); $jData = json_decode($sjData); $jAgents = $jData->agents; ?>

<div id="page_container">

<div id="my_properties_container">

<? 


foreach($jAgents->$jAgent->properties as $jProperty){


        echo '
        
        <div class="property_container">
            <div class="top">
                <div>DKK '.$jProperty->price.'</div>
                <img src="images/uploadedImages/agent-images/properties/'.$jProperty->images[0].'">
            </div>
            <div class="bottom">
                <div class="icons">
                    <a href="edit-property-agent.php?id='.$jProperty->id.'"><img src="images/icons/edit.svg"></a>
                    <a href="delete-property-agent.php?id='.$jProperty->id.'"><img src="images/icons/delete.svg"></a>
                </div>
                <h2>'.$jProperty->title.'</h2>
                <h5>'.$jProperty->adress->steet.' '.$jProperty->adress->streetNumber.', '.$jProperty->adress->zip.'</h5>
                <p>'.$jProperty->description.'</p>
                <div class="line"></div>
                <div class="house_info">
                    <div>'.$jProperty->size->value.' '.$jProperty->size->unit.'</div>
                </div>
            </div>
        </div>
        
        ';

}

?>


</div>

</div>

<?php $sLinkToScript = '<script src="js/profile-agent.js"></script>'; require_once(__DIR__ . '/components/bottom.php'); ?>

