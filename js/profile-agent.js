$(document).on( 'blur', 'input' , function(){

    console.log('clicked')

    
    var updateAgent = document.querySelector('.profile_information')
    var bIsValid = fnbIsFormValid(updateAgent)
    if( bIsValid == false ){ return }


    let sId = $(this).parent().attr('id');
    let sUpdateKey = $(this).attr('data-update');
    let sNewValue = $(this).val(); 

    setTimeout(function(){

        // CONNECT THE FRONTEND TO THE BACKEND
       $.ajax({
            
        url : "api/api-agents/api-agent-update.php",
        method: "POST",
        data : { id : sId , key : sUpdateKey, value : sNewValue } // KEY:VALUE, must match with the api part POST/GET part.
    
        })
        .done(function(sjData){

            // Converts it into json, so what i get back can tell me the problem from the server
            let jData = JSON.parse(sjData);

            console.log(jData.message);
        })
    
    }, 100)
    

})




$('.delete_account').click(function(){

    let sId = $(this).parent().attr('id');

    setTimeout(function(){

    // CONNECT THE FRONTEND TO THE BACKEND
    $.ajax({
            
        url : "api/api-agents/api-agent-delete-account.php",
        method: "POST",
        data : { id : sId } // KEY:VALUE, must match with the api part POST/GET part.
    
        })
        
        .done(function(jData){

            // Converts it into json, so what i get back can tell me the problem from the server
            
            if(jData.status == 0){
                
                console.log(jData.message);

            }

            location.href = 'index';

        })
    }, 100)

})
