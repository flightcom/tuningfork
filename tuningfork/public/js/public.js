var activePage;
var search = $('#search');
var origOffsetY = search.offset().top;

$(document).ready(function(){

    if ( localStorage.activePage != undefined ) {
        activePage = $.parseJSON(localStorage.getItem('activePage'));
    } else {
        activePage = 0;
    }

    $('.navbar-nav li').eq(activePage).addClass('active');

    $('.navbar-nav li').click(function(){
        var index = $(this).index();
        localStorage.removeItem('activePage');
        localStorage.setItem('activePage', index);
        $('.navbar-nav').removeClass('active');
    });

    document.onscroll = scroll;

    // Recherche
    var instruments = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/ajax/searchInstru/%QUERY',
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

    instruments.initialize();

    $('#search').typeahead(
    {
        highlight: true,
        minLength: 3,
        template: {
            empty: '<div class="empty-message">Aucun résultat</div>'
        }
    },
    {
        name: 'instruments',
        displayKey: 'value',
        source: instruments.ttAdapter(),
        templates: {
            header: '<h4 class="search-result-title">Instruments</h4>',
            suggestion: Handlebars.compile("<p><a href='/instruments/{{id}}'>{{value}}</a></p>")
        }
    });

});


function scroll() 
{
    if ($(window).scrollTop() >= origOffsetY) {
        search.addClass('navbar-fixed-top');
        // $('.content').addClass('menu-padding');
    } else {
        search.removeClass('navbar-fixed-top');
        // $('.content').removeClass('menu-padding');
    }

}
