        console.warn = () => {};
        function initMap() {
            var latitud = 19.264339;
            var longitud = -99.623033; 
            coords = {
                lng: longitud,
                lat: latitud
            }

            var autocomplete;
            var to = 'location';
            autocomplete = new google.maps.places.Autocomplete((document.getElementById(to)), {
                types: ['geocode'],
            });

            $("#location_search").click(function() {
                var latitud = $("#latitud").val();
                var longitud = $("#longitud").val();
                coords = {
                    lng: longitud,
                    lat: latitud,
                }
                showMap(coords);
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function() {	
                var near_place = autocomplete.getPlace();
                jQuery("#latitud").val(near_place.geometry.location.lat());
                jQuery("#longitud").val(near_place.geometry.location.lng());
            });
            showMap(coords);
        }
        // Mapa con marcador draggable y animación al soltar
        function showMap(coords) {
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 19,
                scrollwheel: true,
                scaleControl: true,
                mapTypeControl: true,
                maypTypeId: 'satellite',
                center: new google.maps.LatLng(coords.lat, coords.lng),
            });
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(coords.lat, coords.lng),
            });
            marker.addListener('dragend', function(event) {
                document.getElementById("latitud").value = this.getPosition().lat();
                document.getElementById("longitud").value = this.getPosition().lng();
            });
        }