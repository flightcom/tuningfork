<div class="center banner-title">

	<h1>Apprenez la musique sans vous ruiner !</h1>

</div>

<?php echo form_open('search', array('id' =>'search-form', 'class' => 'form-horizontal', 'autocomplete' => 'off')); ?>

	<div class="form-group">

        <div class="col-xs-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
			<input type="text" class="form-control" id="search" name="search" placeholder="Rechercher un instrument..." >
        </div>

	</div>


<?php echo form_close(); ?>

<filter id="filter">

    <feFlood flood-color="black" flood-opacity=".6" />
    <feComposite in2="SourceAlpha" operator="out" />
    <feGaussianBlur stdDeviation="2"/>
    <feOffset dx="0" dy="10" />
    <feComposite in2="SourceAlpha" operator="in" />
    <feMerge>
        <feMergeNode in="SourceGraphic" />
        <feMergeNode />
    </feMerge>

</filter>

<script type="text/javascript">
	
var search = $('#search').closest('.form-group');
var origOffsetY = search.offset().top;

$(function(){

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