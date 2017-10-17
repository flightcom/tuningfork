<html>
	<head>

	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	    <title>Fiche de prêt</title>

		<link href="<?php echo (CSS.'bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo (CSS.'bootstrap-social-buttons.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
		<link href="<?php echo (CSS.'style.css'); ?>" rel="stylesheet" type="text/css" />
		<script src="<?php echo (JS.'jquery-1.11.0.min.js'); ?>"></script> 

	</head>

	<body>

		<div class="col-xs-10 col-xs-offset-1" id="contrat">
			
			<header>

				<h1 class="center">FICHE DE PRÊT</h1>
				<span class="pull-right bordered">N° <?php echo $pret->$emp_id; ?></span>	

			</header>

			<section id="infos-prets" class="col-xs-12">
				
				<p>
					<span class="bordered col-xs-6">Adhérent n° <?php echo $membre->id; ?></span>
					<span class="bordered col-xs-6 pull-right">Date de retour : <?php echo $pret->emp_date_fin_prevue; ?></span>
				</p>

			</section>

			<section id="infos-instrument" class="col-xs-12">
				



			</section>

			<section id="infos-cgu" class="col-xs-12">
				
				<p>Je soussigné(e), <?php echo $membre->membre_genre; ?> <?php echo $membre->membre_prenom . ' ' . $membre->membre_nom; ?> m'engage sur l'honneur que les informations données sont exactes et que je rapporterai l'instrument en l'état et avant la date d'échéance (<?php echo $pret->emp_date_fin_prevue; ?>).<br>Dans le cas contraire, l'association Tuning Fork est autorisée à encaisser la caution.</p>

				<span class="col-xs-offset-7">Date et signature</span>

			</section>


		</div>

	</body>

	<script src="<?php echo (JS.'bootstrap.min.js'); ?>"></script>
	<script src="<?php echo (JS.'bootstrap-typeahead.min.js'); ?>"></script> 
	<script src="<?php echo (JS.'handlebars.js'); ?>"></script> 
	<script src="<?php echo (JS.'calendar.min.js'); ?>"></script> 
	<script src="<?php echo (JS.'public.js'); ?>"></script> 

</html>
