function login_agent(){

    console.log('clicked')
    var frmLoginAgent = document.querySelector('#frmLogin')
    var bIsValid = fnbIsFormValid(frmLoginAgent)
    if( bIsValid == false ){ return }


    $.ajax({

        url: "api/api-agents/api-agent-login.php",
        method : "POST",
        data : $('#frmLogin').serialize(),
        dataType : "JSON" 

 
    }).done(function(jData){

        console.log(jData);

        if( jData.status == 0 ){
            console.log(jData.message);
            return;
        }

        location.href = 'profile-agent';


    }).fail(function(){

        console.log('Error');

    })


    return false;
}

