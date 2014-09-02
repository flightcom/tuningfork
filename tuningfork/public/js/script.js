var activePage;

$(document).ready(function(){

    // Pour la selection de la page
    if(document.referrer.indexOf('admin') == -1) {
        localStorage.removeItem('activePage');        
    }

    if ( localStorage.activePage != undefined ) {
        activePage = $.parseJSON(localStorage.getItem('activePage'));
    } else {
        activePage = 0;
    }

    $('.nav-sidebar li').eq(activePage).addClass('active');

    $('.nav-sidebar li').click(function(){
        var index = $(this).index();
        localStorage.removeItem('activePage');
        localStorage.setItem('activePage', index);
        $('.nav-sidebar').removeClass('active');
    });

    // Pour la selection du menu
    if(document.referrer.indexOf('admin') == -1) {
        localStorage.removeItem('activeMenu');        
    }

    if ( localStorage.activeMenu != undefined ) {
        activeMenu = $.parseJSON(localStorage.getItem('activeMenu'));
    } else {
        activeMenu = 0;
    }

    $('.nav-menu li').eq(activeMenu).addClass('active');

    $('.nav-menu li').click(function(){
        var index = $(this).index();
        localStorage.removeItem('activeMenu');
        localStorage.setItem('activeMenu', index);
        $('.nav-menu').removeClass('active');
    });

    // Pour la recherche depuis la topbar
    $('#search').keyup(function(){

        var search = $(this).val();

        $.ajax({
            url: '/admin/ajax/searchMember/'+ search,
            type: 'post',
            async: false,
            success: function(data){
                console.log(data);
            }
        });


    });

    $('#search').typeahead({
        name: 'search',
        remote: '/admin/ajax/searchMember/'+ $(this).val(),
        minLength: 3
    });

    $('.tablesorter').bind('filterInit', function(){
        var tr1 = $(this).find('thead tr').eq(0);
        var tr2 = $(this).find('thead tr').eq(1);
        var ths = tr1.find('th');
        var tds = tr2.find('td');
        ths.each(function(index){
            if( $(this).is('[class*="hidden-"]') || $(this).is('[class*="visible-"]') ) {
                var classes = $(this).attr('class').split(' ');
                for(i = 0; i < classes.length; i++){
                    var classe = classes[i];
                    if(classe.indexOf('hidden') != -1 || classe.indexOf('visible') != -1){
                        tds.eq(index).addClass(classe);
                    }
                }
            }
        });
    });

    $(".tablesorter").tablesorter({
        theme: "bootstrap",
        widthFixed: true,
        headerTemplate: '{content} {icon}',
        widgets: ["uitheme", "filter", "zebra"],
        widgetOptions: {
            filter_reset: '.reset',
            filter_onlyAvail : 'filter-onlyAvail'
        }
    }).tablesorterPager({
        container: $(".ts-pager"),
        cssGoto: ".pagenum",
        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
    });

    $(window).resize(function(){
        $('table.tablesorter tfoot th').attr('colspan', $('table.tablesorter thead th').not(':hidden').size());
    });

});

$( document.body ).on( 'click', '.dropdown-menu li', function( event ) {
 
   var $target = $( event.currentTarget );
 
   $target.closest( '.btn-group' )
      .find( '[data-bind="label"]' ).text( $target.text() )
         .end()
      .find( 'input' ).val( $target.attr('data-value') ).change()
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

function addType(categorie){

    $('#add-type button').hide();
    $.ajax({
        type: 'GET', 
        url: '/admin/ajouter_type/'+categorie,
        success: function(data){
            $('#add-type').append(data);
        }
    });
}

function cancelAddType(){

    $('#add-type form').remove();
    $('#add-type button').show();
    return false;

}

function getInstruTypes(categ_id){

    $.ajax({
        type: 'GET', 
        url: '/admin/selectionner_type/'+categ_id,
        success: function(data){
            $('#select-type').html(data);
        }
    });

}

function loadAddMemberView(){

    $('#add').load('/admin/ajouter-membre');

}
