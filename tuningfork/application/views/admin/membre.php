<h3><?php echo $membre->membre_prenom . " " . $membre->membre_nom; ?></h3>

<br>

<ul id="membre-actions-list" class="nav nav-tabs" role="tablist">
    <li class="active"><a data-href="#infos">Infos</a></li>
    <li><a data-href="#emprunts">Emprunts</a></li>
</ul>

<section id="infos">

    <?php echo form_open('admin/membres/' . $membre->membre_id . '/edit', array('id' =>'edit-membre', 'class' => 'form-horizontal')); ?>

    	<h4><?php echo $title; ?></h4>

    	<br>

    	<div class="form-group">
            <label for="categorie" class="control-label col-xs-1">Nom</label>
            <div class="col-xs-11">
                <input type="text" class="form-control editable" id="nom" name="nom" value="<?php echo $membre->membre_nom; ?>" readonly />
            </div>
        </div>

        <div class="form-group">
            <label for="categorie" class="control-label col-xs-1">Prénom</label>
            <div class="col-xs-11">
                <input type="text" class="form-control editable" id="nom" name="nom" value="<?php echo $membre->membre_prenom; ?>" readonly />
            </div>
        </div>

    	<div class="form-group">
            <label for="date-entree" class="control-label col-xs-1"></label>
            <div class="col-xs-11">
    			<button onclick="document.location.href='/admin/membres/';return false;" class="btn btn-default no-edition">Retour</button>
    			<button onclick="editMembre();return false;" class="btn btn-warning no-edition">Modifier</button>
    			<button type="submit" class="btn btn-success edition hidden">Valider</button>
    			<button onclick="uneditMembre();return false;" class="btn btn-default edition hidden">Annuler</button>
    			<button onclick="document.location.href='/admin/membre/<?php echo $membre->membre_id; ?>/delete';return false;" class="btn btn-danger pull-right">Supprimer</button>
            </div>
        </div>

    </form>

</section>

<section id="emprunts">

    <h1>TEST</h1>

</section>


<script>

$(function(){

    $("section").hide();

    $('#membre-actions-list li').click(function(){
        $("section").hide();
        $("#" + $(this).data('href')).show();
    });

});

function editMembre(){

	$('#edit-membre .editable').removeAttr('readonly');
	$('button.editable').attr('data-toggle', 'dropdown').find('span:last-child').addClass('caret');
	$('.no-edition').addClass('hidden');
	$('.edition').removeClass('hidden');
}

function uneditMembre(){

	$('#edit-membre .editable').attr('readonly', '');
	$('button.editable').attr('data-toggle', '').find('span:last-child').removeClass('caret');
	$('.no-edition').removeClass('hidden');
	$('.edition').addClass('hidden');
}

</script>