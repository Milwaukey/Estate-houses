function add_new_property(){

    console.log('clicked')
    var frmNewProperty = document.querySelector('#frmNewProperty')
    var bIsValid = fnbIsFormValid(frmNewProperty)
    if( bIsValid == false ){ return }


    var data = new FormData(frmNewProperty); // <-- 'this' is your form element

        $.ajax({

            method: 'POST',
            url: 'api/api-agents/api-agent-add-new-property',
            data: data,
            contentType: false,
            processData: false,
            
        }).
        done(function(sjData){

            jData = JSON.parse(sjData);

            console.log(jData.message)

            if(jData.status == 1){
                
                  location.href = 'my-properties-agent';
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


 