<?php echo form_open('admin/ajouter_categorie', array('id' =>'add-categorie')); ?>

	<div class="input-group" style="width:200px;display:inline-block;">
		<input name="nom-categorie" type="text" class="form" placeholder="Catégorie">
	</div>

	<button type="button" class="btn btn-danger" onclick="cancelAddCategorie();">Annuler</button>
	<button type="submit" class="btn btn-primary">Valider</button>

</form>
