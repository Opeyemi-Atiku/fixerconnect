function loadMap(){
  if(showMap == 2)
  var mapOptions = {
    center: new google.maps.LatLng(latitude, longitude),
    zoom: 20,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(location.latitude, location.longitude),
    map: map
  });
}
google.maps.event.addDomListener(window, 'load', loadMap);
function getLocation(){
  if(navigator.geolocation){
    var x = navigator.geolocation.getCurrentPosition(showPosition);
  }else{
    x.innerHTML = "Goelocation postion not supported";
  }
}
