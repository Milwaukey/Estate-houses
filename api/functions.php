<?php 

function sendResponse($iStatus, $sMessage, $iLineNumber){
    echo '{"status":'.$iStatus.', "message":"'.$sMessage.'", "line":'. $iLineNumber .'}';
    exit;
}

