<link href="<?php echo (CSS.'summernote.css'); ?>" rel="stylesheet" type="text/css"></script>
<link href="<?php echo (CSS.'summernote-bs3.css'); ?>" rel="stylesheet" type="text/css"></script>
<link href="<?php echo (CSS.'codemirror/codemirror.css'); ?>" rel="stylesheet" type="text/css"></script>
<link href="<?php echo (CSS.'codemirror/monokai.css'); ?>" rel="stylesheet" type="text/css"></script>

<div class="pdr20 pdl20" ng-controller="AdminEditArticleCtrl" ng-init="article=<?php echo hscje($article); ?>">

	<p>{{article | json}}</p>
	<article class="article">

		<input style="display:none;" type="checkbox" name="article_published" ng-true-value="1" ng-false-value="0" ng-model="article.article_published">
		<input style="display:none;" type="text" name="article_titre" ng-model="article.article_titre">

		<div class="form-group">
			<div class="col-xs-10">
			    <div ng-hide="isEditingTitle">
			    	<h3 ng-click="isEditingTitle=true">{{article.article_titre}}</h3>
			    </div>
			    <div ng-show="isEditingTitle">
	 				<input class="h3 form-control" type="text" ng-escape="isEditingTitle=false;" ng-init="article_titre_temp=article.article_titre" ng-model="article_titre_temp" ng-enter="article.article_titre=article_titre_temp;isEditingTitle=false;">
			    </div>
			</div>
			<div class="col-xs-2">
				<div class="btn-group">
					<button type="button" class="btn btn-default" ng-class="{active: article.article_published == 1}" onclick="$('[name=article_published]').click();">{{article.article_published == 1 ? 'Publié' : 'Publier'}}</button>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-xs-12">
				<p class="infos">Par {{article.membre_prenom + ' ' + article.membre_nom}} le {{article.article_date_creation}} (dernière mise à jour le {{article.article_date_last_update}})</p>
			</div>
		</div>


		<div class="form-group">

	        <div class="col-xs-12">
				<button class="btn btn-primary mgb10" ng-click="isEditingContent=!isEditingContent">{{isEditingContent ? 'Valider' : 'Éditer'}}</button>
	        	<div ng-hide="isEditingContent" ng-bind-html="article.article_contenu"></div>
	        	<div ng-show="isEditingContent">
					<textarea id="editor" name="editor" class="form-control">{{article.article_contenu}}</textarea>
					<textarea id="texte" name="texte" class="hidden" ng-model="article.article_contenu"></textarea>
	        	</div>
		    </div>
	    </div>

	</article>
</div>

<script src="<?php echo (JS.'codemirror/codemirror.js'); ?>"></script>
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