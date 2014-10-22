<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr0LVacacrqDtM5AGRpumKAYJ1r8UE6yk"></script>
<script type="text/javascript">

// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see a blank space instead of the map, this
// is probably because you have denied permission for location sharing.

$(function(){

  $.ajax({
    url: 'getMembresLocation/ajax',
    method: 'get',
    dataType: 'json',
    success: function(data){
      angular.forEach(data.membres, function(membre){
        var location = membre.location.results[0].geometry.location;
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(location.lat,location.lng),
            map: map,
            title: membre.membre_prenom + ' ' + membre.membre_nom
        });
      });
    }
  });

});

var map;

function initialize() {
  var mapOptions = {
    zoom: 12
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      // var infowindow = new google.maps.InfoWindow({
      //   map: map,
      //   position: pos,
      //   // content: 'Location found using HTML5.'
      // });

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }
}

function handleNoGeolocation(errorFlag) {
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

google.maps.event.addDomListener(window, 'load', initialize);

</script>

<div id="map-canvas" ng-style="style()" resize></div>