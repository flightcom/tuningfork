<?php echo form_open('admin/ajouter_marque', array('id' =>'add-marque')); ?>

	<div class="input-group" style="width:200px;display:inline-block;">
		<input name="nom-marque" type="text" class="form" placeholder="Marque">
	</div>

	<button type="button" class="btn btn-danger" onclick="cancelAddMArque();">Annuler</button>
	<button type="submit" class="btn btn-primary">Valider</button>

</form>
