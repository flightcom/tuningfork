<div class="col-xs-12 col-xs-offset-0" id="contrat">
	
	<header>

		<h1 class="center">FICHE DE PRÊT</h1>

	</header>

	<section id="infos-prets" class="col-xs-12">
		
		<table class="table-bordered col-xs-12">

			<tr>

				<td class="col-xs-3"><b>Prêt N°</b> : <?php echo $pret->emp_id; ?></td>
				<td class="col-xs-3"><b>Date d'emprunt :</b> <?php echo date('d/m/Y', strtotime($pret->emp_date_debut)); ?></td>
				<td class="col-xs-3"><b>Date de retour :</b> <?php echo date('d/m/Y', strtotime($pret->emp_date_fin_prevue)); ?></td>
				<td class="col-xs-3"><b>Caution versée (50€)</b> : <?php echo $pret->emp_caution_versee ? 'OUI' : 'NON'; ?></td>

			</tr>

		</table>

		<table class="table-bordered col-xs-12">

			<thead>
				<tr>
					<th class="col-xs-12 center" colspan="2"><h4><b>ADHÉRENT</b></h4></th>
				</tr>
			</thead>

			<tr>
				<td class="col-xs-6"><b>Adhérent N°</b></td>
				<td class="col-xs-6"><?php echo $pret->emp_membre_id; ?></td>
			</tr>

			<tr>
				<td class="col-xs-6"><b>Nom</b></td>
				<td class="col-xs-6"><?php echo $pret->membre_nom . ' ' . $pret->membre_prenom; ?></td>
			</tr>

			<tr>
				<td class="col-xs-6"><b>Adresse</b></td>
				<td class="col-xs-6"><?php echo $pret->adr_voie . ' ' . $pret->ville_code_postal . ' ' . $pret->ville_nom; ?></td>
			</tr>


		</table>

	</section>

	<section id="infos-instrument" class="col-xs-12">
		
		<table class="table-bordered col-xs-12">
			
			<thead>
				<tr>
					<th class="col-xs-12 center" colspan="2"><h4><b>INSTRUMENT</b></h4></th>
				</tr>
			</thead>

			<tbody>

				<tr>
					<td class="col-xs-6"><b>CATÉGORIE</b></td>
					<td><?php echo $pret->categ_nom; ?></td>
				</tr>

				<tr>
					<td><b>TYPE</b></td>
					<td><?php echo $pret->type_nom; ?></td>
				</tr>

				<tr>
					<td><b>MARQUE</b></td>
					<td><?php echo $pret->marque_nom; ?></td>
				</tr>

				<tr>
					<td><b>NUMERO DE SERIE</b></td>
					<td><?php echo $pret->instru_numero_serie; ?></td>
				</tr>

				<tr>
					<td><b>ACCESSOIRES</b></td>
					<td><?php echo $pret->instru_accessoires; ?></td>
				</tr>

				<tr>
					<td><b>ÉTAT INITIAL</b></td>
					<td><?php echo $pret->emp_etat_initial; ?></td>
				</tr>

				<tr>
					<td><b>ÉTAT AU RETOUR</b></td>
					<td></td>
				</tr>
				
			</tbody>

		</table>


	</section>

	<section id="infos-cgu" class="col-xs-12">
		
		<p>Je soussigné(e), <?php echo $pret->membre_genre; ?> <?php echo $pret->membre_prenom . ' ' . $pret->membre_nom; ?>, m'engage sur l'honneur que les informations données sont exactes et que je rapporterai l'instrument en l'état et avant la date d'échéance (<b><?php echo date('d/m/Y', strtotime($pret->emp_date_fin_prevue)); ?></b>).<br>Dans le cas contraire, l'association Tuning Fork est autorisée à encaisser la caution.</p>

		<span class="col-xs-offset-7">Date et signature</span>

	</section>


</div>
