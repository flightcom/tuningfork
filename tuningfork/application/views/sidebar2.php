<section id="social">

<!-- 	<h3 class="header">
		<span class="label label-default">Suivez-nous !</span>
	</h3>
 -->
	<button class="btn btn-facebook"><i class="fa fa-facebook"></i></button>
	<button class="btn btn-twitter"><i class="fa fa-twitter"></i></button>

	<div></div>

</section>

<section id="agenda">

	<h3 class="header">
		<!-- <span class="label label-default">Agenda</span> -->
		<span class=""></span>
		<span class="pull-right" style="cursor:pointer;" data-calendar-nav="next">&gt;</span> 
		<span class="pull-right" style="margin-right:5px;cursor:pointer;" data-calendar-nav="prev">&lt;</span>
	</h3>

	<div id="calendar"></div>

</section>

<section id="new-instru">

	<h3 class="header">
		<span class="">Derniers instruments récupérés</span>
	</h3>

	<div id="last-instrus"></div>

</section>

<script>

$(function(){

	// Derniers instruments récupérés
	$.ajax({
		url: '/ajax/getLastInstru',
		// type: 'post',
		async: false,
		success: function(data) {
			$('#last-instrus').html(data);
		}
	});

	// Calendrier
	var options = {
        language: 'fr-FR',
	    events_source: "/admin/agenda/get_events/",
		view: 'month',
		tmpl_path: '/public/html/tmplsmin/',
		tmpl_cache: false,
		day: 'now',
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');
		},
		onAfterViewLoad: function(view) {
			$('#agenda .header span').eq(0).text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

	var calendar = $('#calendar').calendar(options);

	$('.header span[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});

	$('#language').change(function(){
		calendar.setLanguage($(this).val());
		calendar.view();
	});

	$('#events-in-modal').change(function(){
		var val = $(this).is(':checked') ? $(this).val() : null;
		calendar.setOptions({modal: val});
	});
	$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
		//e.preventDefault();
		//e.stopPropagation();
	});
});

</script>