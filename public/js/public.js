var activePage;
var position = 0;
var scrolling = false;

$(function(){

    if(location.hash) { showSection(location.hash); }

    // $(document).on("scroll", onScroll);

    $('nav li a[href^="#"]').click(function(e){
        if(window.location.pathname != '/') window.location.href = '/';
        // prevent default anchor click behavior
        e.preventDefault();

        var hash = this.hash;
        showSection(hash, true);
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
