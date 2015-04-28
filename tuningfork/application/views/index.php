<div id="banner">
	
	<div class="center banner-title">

		<h1>Apprenez la musique sans vous ruiner !</h1>

	</div>

	<div class="slide">
		
	</div>

</div>

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