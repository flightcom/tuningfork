<section id="stations" data-id="stations">

	<div class="container">
		<h3 class="text-center">Les Stations musicales</h3>

		<p>Ce sont des lieux où nous avons laissé quelques-uns de nos instruments. Vous pouvez en emprunter un et jouer en toute liberté dans l'établissement.</p>
	</div>

	<div class="map-wrapper"
		map-lazy-load="https://maps.google.com/maps/api/js"
		map-lazy-load-params="{{vm.googleMapsUrl}}">
		<ng-map
			default-style="false"
			center="47.213,-1.56"
			zoom="13"
			zoom-to-include-markers="false"
			scrollwheel="false">
			<marker ng-repeat="station in vm.stations"
				id="marker-station-{{station.id}}"
				position="{{station.adresse.formatted}}"
				title="{{station.name}}"
				centered="true"
				on-click="vm.showStationDetails(station)"></marker>
      		<info-window
      			id="info-window-station"
      			max-width="250">
				<div ng-non-bindable ng-cloak>
					<h5 id="firstHeading" class="firstHeading">{{vm.station.name}}</h5>
					<div id="bodyContent">
						<p>{{vm.station.adresse.voie}}, {{vm.station.adresse.ville.nomReel}}</p>
					</div>
        		</div>
      		</info-window>
 		</ng-map>
	</div>

</section>