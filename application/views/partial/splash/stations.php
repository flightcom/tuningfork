<section id="stations" data-id="stations">

	<h2>Stations musicales</h2>

	<div map-lazy-load="https://maps.google.com/maps/api/js"
		map-lazy-load-params="{{vm.googleMapsUrl}}">
		<ng-map center="47.21,-1.55" zoom="12" scrollwheel="false">
<!-- 				<marker ng-repeat="station in vm.stations"
				position="{{station.adresse.formatted}}"
				title="{{station.name}}"
				centered="true">
			</marker>
-->				<custom-marker ng-repeat="station in vm.stations track by $index"
				id="custom-marker-{{$index}}"
				position="{{station.adresse.formatted}}">
				<p>{{station.name}}</p>
			</custom-marker>
		</ng-map>
	</div>

</section>