<?php echo form_open('admin/agenda/add', array('id' =>'add-agenda', 'class' => 'form-horizontal')); ?>

	<div class="form-group">
        <label for="nom" class="control-label col-sm-1 hidden-xs">Nom de l'événement</label>
        <div class="col-sm-11 col-xs-12">
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
        </div>
    </div>

	<div class="form-group">

        <label for="day-start" class="control-label col-sm-1 hidden-xs">Jour de début d'événement</label>
        <div class="col-sm-2 col-xs-3">
            <input type="date" class="form-control" id="day-start" name="day-start" placeholder="Jour début" required>
        </div>

        <label for="hour-start" class="control-label col-sm-1 hidden-xs">Heure début</label>
        <div class="col-sm-2 col-xs-3">
            <input type="time" class="form-control" id="hour-start" name="hour-start" placeholder="Heure début" required>
        </div>

        <label for="day-end" class="control-label col-sm-1 hidden-xs">Jour de fin d'événement</label>
        <div class="col-sm-2 col-xs-3">
            <input type="date" class="form-control" id="day-end" name="day-end" placeholder="Jour fin" required>
        </div>

        <label for="hour-end" class="control-label col-sm-1 hidden-xs">Heure fin</label>
        <div class="col-sm-2 col-xs-3">
            <input type="time" class="form-control" id="hour-end" name="hour-end" placeholder="Heure fin" required>
        </div>

    </div>

	<div class="form-group">
        <label for="lieu" class="control-label col-sm-1 hidden-xs">Lieu</label>
        <div class="col-xs-12 col-sm-11">
            <input type="text" class="form-control" id="lieu" name="lieu" rows="20" placeholder="Lieu" required>
        </div>
    </div>

	<div class="form-group">
        <label for="description" class="control-label col-sm-1 hidden-xs">Description</label>
        <div class="col-xs-12 col-sm-11">
            <textarea type="text" class="form-control" id="description" name="description" rows="10" placeholder="Description" required></textarea>
        </div>
    </div>

	<div class="form-group">
        <label for="url" class="control-label col-sm-1 hidden-xs">URL</label>
        <div class="col-xs-12 col-sm-11">
            <input type="url" class="form-control" id="url" name="url" placeholder="URL">
        </div>
    </div>

    <button class="btn btn-success" type="submit" id="submit"><span class="glyphicon glyphicon-ok"> Valider</span></button>

</form>

<script>

$(function(){


});

</script>