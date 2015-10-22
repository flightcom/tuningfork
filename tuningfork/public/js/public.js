var activePage;

function scrollTo(hash) {
    location.hash = "#" + hash;
}

$(function(){

    $('#main-navbar li a[href^="#"]').click(function(e){
        if(window.location.pathname != '/') window.location.href = '/';
        $(this).closest('ul').find('li').removeClass('active');
        $(this).closest('li').addClass('active');

       // prevent default anchor click behavior
       e.preventDefault();

       // store hash
       var hash = this.hash;
       // animate
       $('html, body').animate({
//           scrollTop: $(hash).offset().top - $('.topbar').height()
           scrollTop: $(hash).offset().top
         }, 300, function(){

           // when done, add hash to url
           // (default click behaviour)
           window.location.hash = hash;
         });
    });

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
