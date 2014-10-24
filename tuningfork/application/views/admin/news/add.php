<link href="<?php echo (CSS.'summernote.css'); ?>" rel="stylesheet" type="text/css"></script>
<link href="<?php echo (CSS.'summernote-bs3.css'); ?>" rel="stylesheet" type="text/css"></script>

<?php echo validation_errors(); ?>

<div class="pd20">

	<h3 class="col-md-offset-1"><?php echo $title; ?></h3>

	<br>

	<?php echo form_open('admin/news/add', array('id' =>'add-news', 'class' => 'form-horizontal')); ?>

		<div class="form-group">
	        <label for="titre" class="control-label col-md-1 hidden-sm">Titre</label>
	        <div class="col-md-11 col-xs-12">
	            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" required>
	        </div>
	    </div>

		<div class="form-group">
	        <label for="texte" class="control-label col-md-1 hidden-sm">Texte</label>
	        <div class="col-xs-12 col-md-11">
				<textarea id="editor" name="editor" class="form-control" placeholder="Texte..."></textarea>
				<textarea id="texte" name="texte" class="hidden"></textarea>
		    </div>
	    </div>

		<div class="form-group">
	        <label for="titre" class="control-label col-md-1 hidden-sm">Tags</label>
	        <div class="col-md-11 col-xs-12">
	            <input type="text" class="form-control" id="tag" name="tag" placeholder="Tags" ng-enter="addTag();">
	        </div>
	    </div>

		<div class="form-group mgb20">
	        <div id="tags-list" class="col-md-offset-1 col-md-11 col-xs-12"></div>
		</div>

	    <button class="col-md-offset-1 btn btn-primary" onclick="return false;" id="preview"><span class="glyphicon glyphicon-eye-open"> Aperçu</span></button>
	    <button class="btn btn-success" type="submit" id="preview"><span class="glyphicon glyphicon-ok"> Valider</span></button>

	</form>

</div>

<script>

var win;

$(function(){

	$('#editor').summernote({
		height: 300,
		onChange: function(content) {
			$('#texte').html(content);
		}
	});

	$('#preview').on('click', function(event){

		var content = $('#editor').code();

		$.ajax({
			url: '/admin/ajax/preview',
			type: 'post',
			data: $('#add-news').serialize(),
			async: false,
			success: function(data) {
				if ( typeof(win) != 'undefined') {
					win.close();
				}
				win = window.open('', 'Preview');
				win.document.write(data);
				win.focus();
				event.stopPropagation();
			}
		});
		event.stopPropagation();

	});

});

function addTag() {

	var nbTags = $('input[type=button]').size();
	var newtag = '<input type="button" onclick="$(this).remove();" name="tag['+nbTags+']" class="tag form-input btn btn-primary mgr5" value="' + $('#tag').val() + '" />';
	$('#tags-list').append(newtag);
	$('#tag').val('');
	return false;

}

</script>