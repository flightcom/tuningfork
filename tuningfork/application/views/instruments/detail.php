<?php if (!empty($error)) : ?>

<p class="error"><?php echo $error; ?></p>

<?php else : ?>

<img src="<?php echo $instrument->instru_img; ?>">

<?php echo $instrument->instru_modele; ?>

<button onclick="document.location.href='/instruments/<?php echo $instrument->instru_id; ?>/request'" type="button" class="btn btn-primary">Envoyer une demande d'emprunt</button>

<?php endif; ?>