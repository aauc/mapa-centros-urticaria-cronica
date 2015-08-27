<!DOCTYPE html>
<html>
<head>
    <title>Listado hospitales especializados en UC</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="assets/css/bootstrap-example.min.css"/>
</head>

<body>

<div class="bh-sl-container container-fluid">
    <div class="jumbotron">
        <div class="container">
            <h1>Listado hospitales especializados en UC</h1>
            
            <p>Lorem ipsum</p>
            
            <div class="bh-sl-form-container">
                <form id="bh-sl-user-location" class="form-inline" method="post"
                      action="#" role="form">
                    <div class="form-input form-group">
                        <input class="form-control" type="text"
                               id="bh-sl-address" name="bh-sl-address"
                               onFocus="geolocate()"
                               size="35"
                               placeholder="Introduce dirección o código postal"/>
                    </div>
                    
                    <button id="bh-sl-submit" class="btn btn-primary"
                            type="submit">Enviar
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div id="map-container" class="bh-sl-map-container">
        <div class="row">
            <div id="map-results-container" class="container">
                <div id="bh-sl-map" class="bh-sl-map col-md-9"></div>
                <div class="bh-sl-loc-list col-md-3">
                    <ul class="list list-unstyled"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script
    src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="assets/js/libs/handlebars.min.js"></script>
<script src="//maps.google.com/maps/api/js?sensor=false"></script>
<script src="assets/js/plugins/storeLocator/jquery.storelocator.js"></script>
<script>
    function callbackNotifyAddress(notifyText) {
        console.log(notifyText);
    }
    ;
    
    $(function () {
        $('#map-container').storeLocator({
            'dataType': 'json',
            'dataLocation': 'data/locations.json',
            'defaultLoc': true,
            'autoGeocode': true,
            'lengthUnit': 'km',
            'callbackNotify': 'callbackNotifyAddress',
            'addressErrorAlert': 'Localizando tu dirección',
            'autoGeocodeErrorAlert': 'No se ha podido detectar tu ubicación',
            'distanceErrorAlert': 'No se puede encontrar ningún centro a menos de ',
            'kilometerLang': 'kilómetro',
            'kilometersLang': 'kilómetros',
            
            'mapSettings': {
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDoubleClickZoom: true,
                scrollwheel: false,
                navigationControl: false,
                draggable: false
            }
        });
    });
</script>


<script>
    function initAutocomplete() {

        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('bh-sl-address')),
            {types: ['geocode']});
        
        autocomplete.addListener('place_changed', submitForm);
    }
    
    function submitForm() {
        $('#bh-sl-user-location').submit();
    }

    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
    // [END region_geolocation]

</script>
<script
    src="//maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initAutocomplete"
    async defer></script>
</body>
</html>