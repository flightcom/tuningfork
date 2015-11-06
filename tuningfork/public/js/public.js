var activePage;
var position = 0;
var scrolling = false;

$(function(){

    if(location.hash) { showSection(location.hash); }

    $(document).on("scroll", onScroll);

    $('nav li a[href^="#"]').click(function(e){
        if(window.location.pathname != '/') window.location.href = '/';
        // prevent default anchor click behavior
        e.preventDefault();

        var hash = this.hash;
        showSection(hash, true);
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

function onScroll(e){
    e.preventDefault();
    e.stopPropagation();
    if(scrolling) return true;
    var scroll = $(document).scrollTop();
    var following = null;
    $('#main-menu a').each(function () {
        // $(this).removeClass("active");
        var anchor = $(this).attr("href");
        // Si on est sur la section en cours de test
        if ($(anchor).position().top < scroll && $(anchor).position().top + $(anchor).height() > scroll) {
            following = scroll > position ? '#' + $(anchor).next().attr('id') : anchor;
            return false;
        }

    });
    if (following && following !== undefined) {
        showSection(following);
    }

}

function showSection(hash, log) {
    if(hash.indexOf('#') == -1) return;
    var section = $(hash);
    var menu = $('nav li a[href="'+hash+'"]');
    scrolling = true;
    $('body').animate({
        scrollTop: section.offset().top
    }, 300, function(){
        menu.closest('ul').find('a').removeClass("active");
        menu.addClass("active");
        window.location.hash = hash;
        if(log) {
            history.pushState(null, null, hash);
        }
        position = $(document).scrollTop();
        scrolling = false;
    });
}