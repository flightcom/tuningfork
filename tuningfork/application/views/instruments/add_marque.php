<?php echo form_open('admin/ajouter_marque', array('id' =>'add-marque', 'class' => 'navbar-form', 'style' => 'width:400px;margin-top:0;margin-bottom:0;')); ?>

	<div class="form-group">
		<input name="nom-marque" type="text" class="form-control" placeholder="Marque">
	</div>

	<button type="button" class="btn btn-danger" onclick="cancelAddMArque();" style="margin-left:15px;">Annuler</button>
	<button type="submit" class="btn btn-primary">Valider</button>

</form>
