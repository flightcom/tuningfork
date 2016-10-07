(function() {

    // @ngInject
    function ngGmap($http) {
        return {
            restrict: "A",
            scope: {
                markers: '='
            },
            link: function (scope, element, attrs) {
                angular.element(document).ready(function() {
                    var mapOptions = {
                        zoom: 12,
                        scrollwheel: false
                    };

                    map = new google.maps.Map(document.getElementById(element[0].id), mapOptions);

                    if(scope.markers) {
                        $http.get(markers).success(function(data){
                            angular.forEach(data, function(station){
                                var marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(station.location.lat,station.location.lng),
                                    map: map,
                                    title: station.name
                                });
                            });
                        });
                    }

                    // Try HTML5 geolocation
                    if(navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                            map.setCenter(pos);
                        }, function() {
                            scope.handleNoGeolocation(true);
                        });
                    } else {
                        // Browser doesn't support Geolocation
                        scope.handleNoGeolocation(false);
                    }
                });

                scope.handleNoGeolocation = function(errorFlag) {
                    if (errorFlag) {
                        var content = 'Error: The Geolocation service failed.';
                    } else {
                        var content = 'Error: Your browser doesn\'t support geolocation.';
                    }

                    var options = {
                        map: map,
                        position: new google.maps.LatLng(60, 105),
                        content: content
                    };

                    // var infowindow = new google.maps.InfoWindow(options);
                    map.setCenter(options.position);
                }
            }
        }
    }

    angular.module('app')
        .directive('ngGmap', ngGmap);
})();



