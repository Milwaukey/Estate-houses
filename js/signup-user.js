function signup_user(){

    console.log('clicked')
    var frmSignup = document.querySelector('#signupForm')
    var bIsValid = fnbIsFormValid(frmSignup)
    if( bIsValid == false ){ return }


    var data = new FormData(frmSignup); // <-- 'this' is your form element

        $.ajax({

            method: 'POST',
            url: 'api/api-users/api-user-signup.php',
            data: data,
            contentType: false,
            processData: false,
            
        }).
        done(function(sjData){

            jData = JSON.parse(sjData);

            console.log(jData)

            if(jData.status == 1){
                
                swal({
                    title: "Good job!",
                    text: "You have succesfully signed up, check your email for activation!",
                    icon: "success",
                  })
               
                  $('#signupForm input').val('');
            }


        }).
        fail(function(){
            swal({
                title: "System Mainstance",
                text: "Come back again later, ;D",
                icon: "warning",
              })
        })


return false;

}

