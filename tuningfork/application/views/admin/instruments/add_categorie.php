<?php echo form_open('admin/instruments/ajouter_categorie', array('id' =>'add-categorie', 'class' => 'navbar-form', 'style' => 'width:400px;margin-top:0;margin-bottom:0;')); ?>

	<div class="form-group">
		<input name="nom-categorie" type="text" class="form-control" placeholder="Catégorie" ng-model="newcateg">
	</div>

	<button type="button" class="btn btn-danger" onclick="cancelAddCategorie();" style="margin-left:15px;">Annuler</button>
	<button type="button" class="btn btn-primary" ng-click="addCateg()">Valider</button>

</form>
