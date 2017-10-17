(function () {

    let mapStations = {
        templateUrl: 'public/dist/html/components/map-stations.html',
        controller: MapStationsController,
        bindings: {
            stations: '='
        }
    }

    // @ngInject
    function MapStationsController (GOOGLE_MAPS_API, NgMap) {
        let map;
        this.googleMapsUrl = GOOGLE_MAPS_API.url + '?key=' + GOOGLE_MAPS_API.key;

        NgMap.getMap().then(function(response) {
            map = response;
        });

        this.showStationDetails = (e, station) => {
            this.station = station;
            map.showInfoWindow('info-window-station', 'marker-station-' + station.id);
        };

    }

    angular.module('app')
        .component('mapStations', mapStations);

})();
