define([
    'jquery',
    'underscore',
    'Magento_Ui/js/modal/alert',
    'IdeaInYou_StoreLocator/js/store/storeLocatorMap'
], function ($, _, alert, map) {
    $.widget('IdeaInYou.storeLocatorForm', {
        options: {
            formSelector: '',
            submitUrl: '',
            messageSelector: '',
            locations: '',
            mapTitle: '',

        },

        _create: function () {
            this._super();
            this._bindSubmit();
            window.initMap = initMap;


        },

        _bindSubmit: function () {
            $(this.options.formSelector).parent().on('submit', this.formClick.bind(this))

        },

        formClick: function (e) {
            let self = this;
            e.preventDefault();
            $.ajax({

                url: this.options.submitUrl,
                type: 'GET',
                datatype: 'json',
                data: {
                    storeName : $("#storeName").val(),
                    description : $("#description").val(),
                    country : $("#country").val(),
                    state : $("#state").val(),
                    city : $("#city").val(),
                    address : $("#address").val(),
                    post : $("#post").val(),
                    lat : $("#lat").val(),
                    lng : $("#lng").val(),
                    locations : this.options.locations,
                    mapTitle: this.options.mapTitle
                },



            }).done(
                function (data) {
                    console.log(data.data.mapTitle);
                    if (data.success) {


                        const map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 9,
                            center: { lat: +data.data.lat, lng: +data.data.lng },
                        });

                        const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        const mapTitle = data.data.mapTitle ;

                        let locationOld = data.data.locations;
                        let locations = [];

                        for (let i = 0; i<locationOld.length; i++){

                            locations[i]= {
                                lat: +locationOld[i]['lat'],
                                lng: +locationOld[i]['lng']
                            }
                        }

                        locations[locations.length] = {
                            lat: +data.data.lat,
                            lng: +data.data.lng
                        };
                        let markers = locations.map((position, i) => {
                            let label = labels[i % labels.length];
                            position[lat] = +position[lat];
                            position[lng] = +position[lng];



                            let marker = new google.maps.Marker({
                                position,
                                map,
                                // title: mapTitle[i + 1][1] || 0,
                                // label: mapTitle[i + 1][0] || 0,
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

                        // Add a marker clusterer to manage the markers.
                        const markerCluster = new markerClusterer.MarkerClusterer({ map, markers });


                        $(document).on('click','.mapZoom',function(e){
                            e.preventDefault();
                            let ltt = this.getAttribute('data-latitude');
                            let lnt = this.getAttribute('data-longitude');

                            map.setCenter(new google.maps.LatLng(ltt, lnt));

                            map.setZoom(9);
                        })


                        $(self.options.formSelector).hide();
                        $(self.options.messageSelector).show();

                        let row = document.createElement("tr");

                        const attr1 = document.createAttribute("data-latitude");
                        attr1.value = data.data.lat;
                        const attr2 = document.createAttribute("data-longitude");
                        attr2.value = data.data.lng;

                        row.classList.add('mapZoom');

                        row.setAttributeNode(attr1);
                        row.setAttributeNode(attr2);

                        row.innerHTML =
                            '<td>'+data.data.storeName+'</td>' +
                            '<td>'+data.data.description+'</td>' +
                            '<td>'+data.data.country+'</td>' +
                            '<td>'+data.data.state+'</td>' +
                            '<td>'+data.data.city+'</td>' +
                            '<td>'+data.data.address+'</td>' +
                            '<td>'+data.data.post+'</td>'+
                            '<td>'+data.data.lat+'</td>'+
                            '<td>'+data.data.lng+'</td>';

                        document.querySelectorAll("#mapTable tbody")[0].appendChild(row);

                        setTimeout(function () {
                            $(self.options.messageSelector).hide();
                        }, 3000)

                    } else {
                        alert({
                            title: $.mage.__('Something wrong'),
                            content: $.mage.__(data.error_message + '\nPlease, try again!')
                        });
                    }
                }).error(function (qXHR, textStatus, errorThrown) {
                alert({
                    title: $.mage.__('Something wrong'),
                    content: $.mage.__('Please, try again!')
                });
            });
        }
    });

    return $.IdeaInYou.storeLocatorForm;
});
