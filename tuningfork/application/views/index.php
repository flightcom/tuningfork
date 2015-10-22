<section class="section-home" id="home">
	
	<h2>Section Home</h2>

</section>

<section class="section-home" id="infos">

	<h2>Section Infos</h2>

</section>

<section class="section-home" id="instruments">
	
	<h2>Section Instruments</h2>

</section>

<section class="section-home" id="contact">

	<h2>Section Contact</h2>

</section>

<script type="text/javascript">
	
var search = $('#search').closest('.form-group');
var origOffsetY = search.offset().top;

$(function(){

    console.log(search.size());
    document.onscroll = scroll;


});

function scroll() 
{
    if ($(window).scrollTop() >= origOffsetY) {
        search.addClass('navbar-fixed-top');
    } else {
        search.removeClass('navbar-fixed-top');
    }

}

</script>