<?php echo form_open('admin/ajouter_type', array('id' =>'add-type', 'class' => 'navbar-form', 'style' => 'width:400px;margin-top:0;margin-bottom:0;')); ?>

	<div class="form-group">
		<input name="nom-type" type="text" class="form-control" placeholder="Type">
	</div>

	<button type="button" class="btn btn-danger" onclick="cancelAddType();" style="margin-left:15px;">Annuler</button>
	<button type="submit" class="btn btn-primary">Valider</button>

</form>
