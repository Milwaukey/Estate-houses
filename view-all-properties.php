<?php $sPageTitle = 'View All properties'; $sActive = 'view_all_properties'; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav.php'); ?>


<div id="view_all_properties_container">

<div id="map">
</div>

<div id="properties">

<div class="properties_wrapper">
    <?php 

        // CREATING GLOBAL variable, that i can use properties for JS
        $sGlobalProperites = [];  

        $sjData = file_get_contents(__DIR__ . '/data/data.json');

        $jData = json_decode($sjData);


    
        foreach($jData->agents as $sAgentId){

            foreach($sAgentId->properties as $jProperty){

                if(isset($_GET['zip'])){

                    if( $_GET['zip'] == $jProperty->adress->zip ){

                        
                        array_push($sGlobalProperites, $jProperty);

                        echo '
    
                        <div id="Right'.$jProperty->id.'" class="property_container">
                        <div class="top">
                            <div>DKK '. $jProperty->price .'</div>
                            <img src="images/uploadedImages/agent-images/properties/'.$jProperty->images[0].'">
                        </div>
                        <div class="bottom">
                            <h2>'.$jProperty->title.'</h2>
                            <h4>'.$jProperty->adress->steet.' '.$jProperty->adress->streetNumber.', '.$jProperty->adress->zip.'</h4>
                            <p>'.$jProperty->description.'</p>
                            <div class="line"></div>
                            <div class="house_info">
                                <div>'.$jProperty->size->value.' '.$jProperty->size->unit.'</div>
                            </div>
                        </div>
                        </div>
        
                    ';

                    }


                }else{

                    array_push($sGlobalProperites, $jProperty);
                    
                    // Echoing each property
                    echo '
    
                    <div id="Right'.$jProperty->id.'" class="property_container">
                    <div class="top">
                        <div>DKK '. $jProperty->price .'</div>
                        <img src="images/uploadedImages/agent-images/properties/'.$jProperty->images[0].'">
                    </div>
                    <div class="bottom">
                        <h2>'.$jProperty->title.'</h2>
                        <h4>'.$jProperty->adress->steet.' '.$jProperty->adress->streetNumber.', '.$jProperty->adress->zip.'</h4>
                        <p>'.$jProperty->description.'</p>
                        <div class="line"></div>
                        <div class="house_info">
                            <div>'.$jProperty->size->value.' '.$jProperty->size->unit.'</div>
                        </div>
                    </div>
                    </div>
    
                ';

            
                }

            }

        }
    
    

    ?>
    </div>
</div>

</div>

<script>
        const sjProperties = '<?php echo json_encode($sGlobalProperites) ?>';

</script>

<?php $sLinkToScript = '<script src="js/view_all_properties.js"></script>'; require_once(__DIR__ . '/components/bottom.php'); ?>

