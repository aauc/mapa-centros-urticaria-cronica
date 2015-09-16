$(function () {
    initAutocomplete();
    $('#map-container').storeLocator({
        'dataType': 'json',
        'dataLocation': 'data/locations.json',
        'defaultLoc': true,
        'storeLimit': 150,
        'pagination': true,
        'locationsPerPage': 150,
        'fullMapStart': true,
        'autoGeocode': true,
        'lengthUnit': 'km',
        'callbackNotify': function(msg) { $('#map-msg').text(msg); },
        'callbackSuccess': function() { $('#map-msg').hide(); },
        'addressErrorAlert': 'Localizando tu dirección...',
        'autoGeocodeErrorAlert': 'No se ha podido detectar tu ubicación. Habilita la auto detección o introduce la dirección en el cuadro superior',
        'distanceErrorAlert': 'No se puede encontrar ningún centro a menos de ',
        'kilometerLang': 'kilómetro',
        'kilometersLang': 'kilómetros',
        
        'mapSettings': {
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        }
    });
    console.log("aqui estem")
});

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
        $('#loading-map').hide();
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