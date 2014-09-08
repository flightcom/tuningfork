<div class="btn-group">
	<button class="btn btn-warning" data-calendar-view="year">Year</button>
	<button class="btn btn-warning" data-calendar-view="month">Month</button>
	<button class="btn btn-warning" data-calendar-view="week">Week</button>
	<button class="btn btn-warning" data-calendar-view="day">Day</button>
</div>

<div class="btn-group">
	<button class="btn btn-primary" data-calendar-nav="prev">&lt;&lt; Prev</button>
	<button class="btn" data-calendar-nav="today">Today</button>
	<button class="btn btn-primary" data-calendar-nav="next">Next &gt;&gt;</button>
</div>

<br><br>

<div id="calendar"></div>

<script>

$(function(){

	var options = {
        language: 'fr-FR',
	    events_source: "/admin/agenda/get_events/",
	    // events_source: "events.json.php",
		view: 'month',
		tmpl_path: '/public/html/tmpls/',
		tmpl_cache: false,
		day: '2013-03-12',
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');

			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html('<a href="' + val.url + '">' + val.title + '</a>')
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$('.page-header h3').text(this.getTitle());
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

	// var calendar = $("#calendar").calendar({
 //        tmpl_path: "/public/html/tmpls/",
 //        language: 'fr-FR',
	//     events_source: "/admin/agenda/get_events/"
	// }); 

	// var calendar = $('#calendar').calendar({language: 'fr-FR'});
	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
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