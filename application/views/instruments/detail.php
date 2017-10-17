<?php if (!empty($error)) : ?>

<p class="error"><?php echo $error; ?></p>

<?php else : ?>

<ol class="breadcrumb">
    <li><a href="/instruments">Tous</a></li>
    <li><a href="/instruments/<?php echo $instrument->categ_public_id . '/';?>"><?php echo $instrument->categ_nom; ?></a></li>
    <li><a href="/instruments/<?php echo $instrument->categ_public_id . '/' . $instrument->type_public_id . '/';?>"><?php echo $instrument->type_nom; ?></a></li>
    <li class="active"><a href="/instruments/<?php echo $instrument->instru_id ;?>"><?php echo $instrument->instru_modele; ?></a></li>
</ol>

<img src="<?php echo $instrument->instru_img; ?>">

<?php echo $instrument->instru_modele; ?>

<button onclick="document.location.href='/instruments/<?php echo $instrument->instru_id; ?>/request'" type="button" class="btn btn-primary">Envoyer une demande d'emprunt</button>

<?php endif; ?>