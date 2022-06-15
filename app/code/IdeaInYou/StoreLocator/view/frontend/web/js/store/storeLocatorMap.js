define([
    'jquery',

], function ($) {
    $.widget('IdeaInYou.storeLocatorMap', {
        options: {
            mapMessage: '',
            mapTitle: '',
            locations: '',
        },
        default:{

        },

        _create: function () {
            let mapZoom = document.querySelectorAll('.mapZoom');

            let locations = this.options.locations;

            this._initMap(locations,mapZoom);
            window.initMap = initMap;

            this._autoAddress();
            google.maps.event.addDomListener(document.getElementById('auto-address'), 'keypress', this._autoAddress);

        },



        _initMap: function (locations) {

            $(document).on('click','.mapZoom',function(e){
                e.preventDefault();
                let ltt = this.getAttribute('data-latitude');
                let lnt = this.getAttribute('data-longitude');

                map.setCenter(new google.maps.LatLng(ltt, lnt));

                map.setZoom(9);
            })



            let input = document.getElementById('searchTextField');
            let autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                let place = autocomplete.getPlace();

                place.address_components.forEach(function click(item, i) {
                    if(item.types[0] =='country'){
                        document.getElementById('country').value = item.long_name;
                    }
                    if(item.types[0] =='administrative_area_level_1'){
                        document.getElementById('state').value = item.long_name;
                    }
                    if(item.types[0] =='locality'){
                        document.getElementById('city').value = item.long_name;
                    }
                    if(item.types[0] =='route'){
                        document.getElementById('address').value = item.long_name;
                    }
                    if(item.types[0] =='postal_code'){
                        document.getElementById('post').value = item.long_name;
                    }
                    document.getElementById('lat').value = place.geometry.location.lat();
                    document.getElementById('lng').value = place.geometry.location.lng();
                });
            });

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 3,
                center: { lat: 48, lng: 25 },
            });

            const infoWindow = new google.maps.InfoWindow({
                content: "",
                disableAutoPan: true,
            });

            // Create an array of alphabetical characters used to label the markers.
            const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const mapTitle = this.options.mapTitle ;

            // Add some markers to the map.1


            let markers = locations.map((position, i) => {
                let label = labels[i % labels.length];

                let marker = new google.maps.Marker({
                    position,
                    map,
                    title: `${mapTitle[i + 1][1]}`,
                    label: `${mapTitle[i + 1][0]}`,
                    optimized: false,
                });



                // markers can only be keyboard focusable when they have click listeners
                // open info window when marker is clicked
                marker.addListener("click", () => {
                    infoWindow.close();
                    infoWindow.setContent(marker.getTitle());
                    infoWindow.open(marker.getMap(), marker);
                });
                return marker;
            });
            let markerForm = localStorage.getItem('markerForm');
            markers.push(markerForm);
            // Add a marker clusterer to manage the markers.
            const markerCluster = new markerClusterer.MarkerClusterer({ map, markers });
        },

        _autoAddress: function () {
            var input = document.getElementById('auto-address');
            var autocomplete = new google.maps.places.Autocomplete(input);
        }


    });

    return $.IdeaInYou.storeLocatorMap;
});

