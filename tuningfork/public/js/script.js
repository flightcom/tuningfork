var activePage;
var activeMenu = 0;

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
        var tmpMenu1 = localStorage.getItem('activeMenu');
        console.log(tmpMenu1);
        var tmpMenu2 = tmpMenu1.split('-');
        activePageMenu = tmpMenu2[0];
        if ( activePageMenu != activePage )  { 
            localStorage.removeItem('activeMenu');
        } else {
            activeMenu = tmpMenu2[1];
        }
    }

    $('.nav-menu li').eq(activeMenu).addClass('active');

    $('.nav-menu li').click(function(){
        var index = $(this).index();
        localStorage.removeItem('activeMenu');
        localStorage.setItem('activeMenu', activePage + '-' + index);
        $('.nav-menu').removeClass('active');
    });

    // Instantiate the Bloodhound suggestion engine
    var membres = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/admin/ajax/searchMember/%QUERY',
            filter: function (membres) {
                return $.map(membres, function (membre) {
                    return {
                        value: membre.membre_prenom + ' ' + membre.membre_nom,
                        id: membre.membre_id
                    };
                });
            }
        }
    });

    var instruments = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/admin/ajax/searchInstru/%QUERY',
            filter: function (instruments) {
                return $.map(instruments, function (instru) {
                    return {
                        value: instru.marque_nom + ' ' + instru.instru_modele,
                        id: instru.instru_id
                    };
                });
            }
        }
    });

    // Initialize the Bloodhound suggestion engine
    membres.initialize();
    instruments.initialize();

    // Instantiate the Typeahead UI
    $('#search').typeahead(
    {
        highlight: true,
        minLength: 3,
        template: {
            empty: '<div class="empty-message">Aucun résultat</div>'
        }
    },
    {
        name: 'membres',
        displayKey: 'value',
        source: membres.ttAdapter(),
        templates: {
            header: '<h4 class="search-result-title">Membres</h4>',
            suggestion: Handlebars.compile("<p><a href='/admin/membres/{{id}}'>{{value}}</a></p>")
        }
    },
    {
        name: 'instruments',
        displayKey: 'value',
        source: instruments.ttAdapter(),
        templates: {
            header: '<h4 class="search-result-title">Instruments</h4>',
            suggestion: Handlebars.compile("<p><a href='/admin/instruments/{{id}}'>{{value}}</a></p>")
        }
    }
    );

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
        sortReset: true,
        headerTemplate: '{content} {icon}',
        widgets: ["uitheme", "filter", "zebra", "saveSort"],
        widgetOptions: {
            saveSort : true,
            filter_saveFilters: true,
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

$('#wrap .dropdown-menu li').on( 'click', function( event ) {
 
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

function loadAddMemberView(){

    $('#add').load('/admin/membres/ajouter_membre');

}
