var activePage;

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

});