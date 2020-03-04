$(document).on('input', 'input:text', function() {

    var frmSearch = document.querySelector('#frmSearch')
    var bIsValid = fnbIsFormValid(frmSearch)
    if( bIsValid == false ){ return }

    $.ajax({

        url : 'api/api-search-zip.php',
        data : $('#txtSearch').serialize(),
        dataType : "JSON"

    }).done(function(matches){

        console.log(matches);
        $('#results').empty();


        $(matches).each(function(index, zip){                        

            zip = zip.replace(/</g, '&lt;');    // Replace all the less than globally (g)
            zip = zip.replace(/>/g, '&gt;');    // Replace all the grather than globally (g)

            // Appends to the div as an A so you can make a query string to another page with the search 
            let divZip = `<div class="div_search_results"><a href="view-all-properties.php?zip=${zip}">${zip}</a></div>`;

            $('#results').append(divZip);

        })

    }).fail(function(){
        console.log('You did not search for anything :D ')
    })

    if($('#txtSearch').val().length == 0){
        $('#results').css('display', 'none');
    }else{
        $('#results').css('display', 'block');
    }

});

