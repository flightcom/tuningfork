<?php echo form_open('admin/ajouter_categorie', array('id' =>'add-categorie', 'class' => 'navbar-form', 'style' => 'width:400px;margin-top:0;margin-bottom:0;')); ?>

	<div class="form-group">
		<input name="nom-categorie" type="text" class="form-control" placeholder="Catégorie">
	</div>

	<button type="button" class="btn btn-danger" onclick="cancelAddCategorie();" style="margin-left:15px;">Annuler</button>
	<button type="submit" class="btn btn-primary">Valider</button>

</form>
