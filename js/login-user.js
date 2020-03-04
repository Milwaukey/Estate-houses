function login_user(){

    console.log('clicked')
    var frmLoginUser = document.querySelector('#frmLogin')
    var bIsValid = fnbIsFormValid(frmLoginUser)
    if( bIsValid == false ){ return }


    $.ajax({

        url: "api/api-users/api-user-login.php",
        method : "POST",
        data : $('#frmLogin').serialize(),
        dataType : "JSON" 

 
    }).done(function(jData){

        console.log(jData);

        if( jData.status == 0 ){
            console.log(jData.message);
            return;
        }

        location.href = 'profile-user';


    }).fail(function(){

        console.log('Error');

    })


    return false;
}

