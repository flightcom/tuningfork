<label for="type" class="control-label col-xs-1">Type</label>
<div>
	<div class="btn-group dropdown" name="type">
		<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
			<span data-bind="label">Sélectionnez</span> <span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu">
			<?php foreach($types as $t){ ?>
			<li data-value="<?php echo $t->type_id; ?>"><a href="#"><?php echo $t->type_nom; ?></a></li>
			<?php } ?>
		</ul>
		<input type="hidden" name="type" value="0" />
	</div>
	<div id="add-type" style="display:inline-block;">
		<button onclick="addType(<?php echo $categorie; ?>);return false;"class="btn btn-default">Ajouter un type</button>
	</div>
</div>