<?php session_start(); if( !$_SESSION['jAgent'] ){ header('Location: login-agent.php'); } $jAgent = $_SESSION['jAgent']; ?>
<?php $sPageTitle = 'Agent'; $sActive = ' '; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav-agent.php');  ?>

<?php 
$sjData = file_get_contents(__DIR__ .'/data/data.json'); $jData = json_decode($sjData);


// Sets a counter that count how many object that excist in the array of properties 
$sLoggedInAgentPorperties = count($jData->agents->$jAgent->properties);

// Loops though the array of properties 
for($i = 0; $i < $sLoggedInAgentPorperties; $i++){

    // Variable that contains the single value of the click looped proprety
    $sEditingProperty = $jData->agents->$jAgent->properties[$i];

    // Checks if the matching ID passing through URL matches one of the objects in the array of properties 
    if($_GET['id'] == $sEditingProperty->id){
    
        unset($jData->agents->$jAgent->properties[$i]);
        // OBS Unset laver array om the objects, hvis vi fjerner index 0
        

        // Derfor bruger vi array_values til at genopbygge array'et
        $jData->agents->$jAgent->properties = array_values($jData->agents->$jAgent->properties);

        $sjData = json_encode($jData, JSON_PRETTY_PRINT);

        file_put_contents(__DIR__ . '/data/data.json', $sjData);
        
        header('Location: my-properties-agent');
    }
}

?>

<?php require_once(__DIR__ . '/components/bottom.php'); ?>


