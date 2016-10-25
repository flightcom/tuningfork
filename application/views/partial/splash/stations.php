<section id="stations" data-id="stations">

	<h3 class="text-center">Nos Stations musicales :</h3>

	<div map-lazy-load="https://maps.google.com/maps/api/js"
		map-lazy-load-params="{{vm.googleMapsUrl}}">
		<ng-map
			zoom-to-include-markers='true'
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