<h3><?php echo $title; ?></h3>

<br>

<?php echo form_open('admin/news/add', array('id' =>'add-news', 'class' => 'form-horizontal')); ?>

	<div class="form-group">
        <label for="titre" class="control-label col-sm-1 hidden-xs">Titre</label>
        <div class="col-sm-11 col-xs-12">
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" required>
        </div>
    </div>

	<div class="form-group">
        <label for="texte" class="control-label col-sm-1 hidden-xs">Texte</label>
        <div class="col-xs-12 col-sm-11">
        	<?php echo $toolbox; ?>
            <textarea type="text" class="col-xs-12 hidden" id="texte" name="texte" rows="20"></textarea>
            <div class="col-xs-12" style="padding:5px;clear:both;min-height:200px;border:1px solid #ccc;" contenteditable="true"></div>
        </div>
    </div>

    <button class="btn btn-primary" onclick="return false;" id="preview"><span class="glyphicon glyphicon-eye-open"> Aperçu</span></button>
    <button class="btn btn-success" type="submit" id="preview"><span class="glyphicon glyphicon-ok"> Valider</span></button>

</form>

<script>

var win;

$(function(){

	$('#preview').on('click', function(event){

		var content = $('textarea').next('div').html();
		$('textarea').val(content);

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

	$('div[contenteditable]').keydown(function(e) {
	    // trap the return key being pressed
	    if (e.keyCode === 13) {
	      // insert 2 br tags (if only one br tag is inserted the cursor won't go to the next line)
	      document.execCommand('insertHTML', false, '<br><br>');
	      // prevent the default behaviour of return key pressed
	      return false;
	    }
	  });

});

</script>