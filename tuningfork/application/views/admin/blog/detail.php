<link href="<?php echo (CSS.'summernote.css'); ?>" rel="stylesheet" type="text/css"></script>
<link href="<?php echo (CSS.'summernote-bs3.css'); ?>" rel="stylesheet" type="text/css"></script>
<link href="<?php echo (CSS.'codemirror/codemirror.css'); ?>" rel="stylesheet" type="text/css"></script>
<link href="<?php echo (CSS.'codemirror/monokai.css'); ?>" rel="stylesheet" type="text/css"></script>

<div class="pdr20 pdl20" ng-controller="AdminEditArticleCtrl" ng-init="article=<?php echo hscje($article); ?>">

	<p>{{article | json}}</p>

	<div class="form-group">
		<div class="col-xs-10">
		    <div ng-hide="editorEnabled">
		    	<h3>{{article.article_titre}}</h3><a href="#" ng-click="editorEnabled=!editorEnabled">Editer</a>
		    </div>
		    <div ng-show="editorEnabled">
				<input class="h3 form-control" type="text" ng-model="article.article_titre">
				<a href="#" ng-click="editorEnabled=!editorEnabled; updateArticle('article_titre', article.article_titre)">Valider</a>
		    </div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-xs-2">
			<div class="btn-group">
				<button type="button" class="btn btn-default" ng-class="{active: article.article_published}" ng-click="updateArticle('article_published', !article.article_published)">{{article.article_published ? 'Publié' : 'Publier'}}</button>
			</div>
		</div>
	</div>

<!-- 	<div class="form-group">
		<textarea id="editor" name="editor" class="form-control"><?php echo $article->article_contenu; ?></textarea>
		<textarea id="texte" name="texte" class="hidden" ng-model="article.article_contenu"></textarea>
	</div>
 -->
</div>

<script src="<?php echo (JS.'codemirror/codemirror.js'); ?>"></script>
<!-- <script src="<?php echo (JS.'codemirror/xml.js'); ?>"></script> -->
<script src="<?php echo (JS.'summernote.min.js'); ?>"></script>
<script>

var win;

$(function(){

	$('#editor').summernote({
		height: 300,
		codemirror: {
			theme: 'monokai',
			lineNumbers: true
		},
		oninit: function(){
			$(this).code($('#texte').html());
		},
		onChange: function(content) {
			$('#texte').html(content);
		}
	});

	$('#preview').on('click', function(event){

		var content = $('#editor').code();

		$.ajax({
			url: '/admin/ajax/preview',
			type: 'post',
			data: $('#add-article').serialize(),
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