activePage = null;

$(document).ready(function(){

    $('.navbar-nav li').click(function(){ activePage = $(this); });
    if(activePage) activePage.addClass('active');

    $(".tablesorter").tablesorter({
        theme: "bootstrap",
        widthFixed: true,
        headerTemplate: '{content} {icon}',
        widgets: ["uitheme", "filter", "zebra"],
    }).tablesorterPager({
        container: $(".ts-pager"),
        cssGoto: ".pagenum",
        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
    });

});

$( document.body ).on( 'click', '.dropdown-menu li', function( event ) {
 
   var $target = $( event.currentTarget );
 
   $target.closest( '.btn-group' )
      .find( '[data-bind="label"]' ).text( $target.text() )
         .end()
      .find( 'input' ).val( $target.attr('data-value') )
         .end()
      .children( '.dropdown-toggle' ).dropdown( 'toggle' );
 
   return false;
 
});

function loadAddInstruView(){

	// $('#add').load('/admin/ajouter_instrument');
    $('#add button').hide();
    $.ajax({
        type: 'GET', 
        url: '/admin/ajouter_instrument',
        success: function(data){
            $('#add').append(data);
        }
    });

}

function cancelNewInstrument(){

    $('#add > *:not(button)').remove();
    $('#add button').show();
}

function addMarque(){

    $('#add-marque button').hide();
    $.ajax({
        type: 'GET', 
        url: '/admin/ajouter_marque',
        success: function(data){
            $('#add-marque').append(data);
        }
    });
}

function cancelAddMArque(){

    $('#add-marque form').remove();
    $('#add-marque button').show();
    return false;

}

function addCategorie(){

    $('#add-categorie button').hide();
    $.ajax({
        type: 'GET', 
        url: '/admin/ajouter_categorie',
        success: function(data){
            $('#add-categorie').append(data);
        }
    });
}

function cancelAddCategorie(){

    $('#add-categorie form').remove();
    $('#add-categorie button').show();
    return false;

}

function loadAddMemberView(){

    $('#add').load('/admin/ajouter-membre');

}