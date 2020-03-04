function edit_property(){

    console.log('clicked')
    var frmEditProperty = document.querySelector('#frmEditProperty')
    var bIsValid = fnbIsFormValid(frmEditProperty)
    if( bIsValid == false ){ return }

    $.ajax({

        url :  'api/api-agents/api-agent-edit-property',
        method : 'POST',
        data : $('#frmEditProperty').serialize(),
        dataType : "JSON"

    }).done(function(jData){

        console.log(jData.message)

        location.href = 'my-properties-agent';

    }).fail(function(){
        console.log('Not working well')
    })


}