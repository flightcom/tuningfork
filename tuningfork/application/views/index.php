<div id="banner"><?php echo $this->session->userdata('search'); ?></div>

<button onclick="location.href='/ajax/testpdf'">pdf</button>

<script type="text/javascript">
	
var search = $('#search').closest('.form-group');
var origOffsetY = search.offset().top;

$(function(){

    console.log(search.size());
    document.onscroll = scroll;

});

function testpdf() {

	$.ajax({
		url: '/ajax/testpdf',
		async: false,
		success: function(data) {
			$(document).append(data);
			// console.log(data);
		}
	});

}

</script>