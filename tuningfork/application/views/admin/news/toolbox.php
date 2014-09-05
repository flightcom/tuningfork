<div id="writer-toolbox" class="col-xs-12">

	<ul class="navbar-nav nav">

		<li><a href="#"><span class="glyphicon glyphicon-text-height"></span></a></li>
		<li><a href="#" data-tag="bold"><span class="glyphicon glyphicon-bold"></span></a></li>
		<li><a href="#" data-tag="italic"><span class="glyphicon glyphicon-italic"></span></a></li>
		<li><a href="#"><span class="glyphicon glyphicon-align-left"></span></a></li>
		<li><a href="#"><span class="glyphicon glyphicon-align-center"></span></a></li>
		<li><a href="#"><span class="glyphicon glyphicon-align-right"></span></a></li>
		<li><a href="#"><span class="glyphicon glyphicon-align-justify"></span></a></li>
		<li><a href="#"><span class="glyphicon glyphicon-link"></span></a></li>
		<li><a href="#"><span class="glyphicon glyphicon-picture"></span></a></li>

	</ul>

</div>


<script>

$(function(){

	$('[data-tag]').click(function(event){

		var tag = $(this).data('tag');
		var text = getSelectedText();
		var newtext = '';

		switch(tag) {

			case 'bold': toggle('bold'); break;
			case 'italic': toggle('italic'); break;
			default: break;
		}

		event.preventDefault();

	});

});

function toggle(param) {
    document.execCommand(param, false, null);
}

 function getSelectedText(){

	var t = '';
	if(window.getSelection){
		t = window.getSelection();
	}else if(document.getSelection){
		t = document.getSelection();
	}else if(document.selection){
		t = document.selection.createRange().text;
	}
	console.log(t);
	return t;
}

function replaceSelectedText(replacementText) {
    var sel, range;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();
            range.insertNode(document.createTextNode(replacementText));
        }
    } else if (document.selection && document.selection.createRange) {
        range = document.selection.createRange();
        range.text = replacementText;
    }
}



</script>