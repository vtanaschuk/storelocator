// define([
//     'jquery',
//
// ], function ($) {
//     $.widget('mage.review', {
//         options: {
//             mapZoom: '.mapZoom',
//             ltt: 'data-latitude',
//             lnt: 'data-longitude',
//             searchTextField: 'searchTextField',
//             country: 'country',
//             state: 'state',
//             city: 'city',
//             address: 'address',
//             post: 'post',
//             map: 'map',
//             mapTitle: '<?php echo json_encode($storeArr); ?>',
//             locations: 'locations'
//         },
//         _create: function () {
//             this._super();
//             function initMap() {
//
//                 const mapZoom = document.querySelectorAll(this.options.mapZoom);
//                 for(let i = 0; i < mapZoom.length; i++) {
//
//                     mapZoom[i].addEventListener( 'click', function( e ) {
//                         e.preventDefault();
//
//                         let ltt = + mapZoom[i].getAttribute(this.options.ltt);
//                         let lnt = + mapZoom[i].getAttribute(this.options.lnt);
//
//                         map.setCenter({
//                             lat: ltt,
//                             lng: lnt,
//                         });
//
//                         map.setZoom(15);
//
//                     });
//
//                 }
//
//
//                 var input = document.getElementById(this.options.searchTextField);
//                 var autocomplete = new google.maps.places.Autocomplete(input);
//                 autocomplete.addListener('place_changed', function() {
//                     var place = autocomplete.getPlace();
//
//                     place.address_components.forEach(function(item, i) {
//                         if(item.types[0] =='country'){
//                             document.getElementById(this.options.country).value = item.long_name;
//                         }
//                         if(item.types[0] =='administrative_area_level_1'){
//                             document.getElementById(this.options.state).value = item.long_name;
//                         }
//                         if(item.types[0] =='locality'){
//                             document.getElementById(this.options.city).value = item.long_name;
//                         }
//                         if(item.types[0] =='route'){
//                             document.getElementById(this.options.address).value = item.long_name;
//                         }
//                         if(item.types[0] =='postal_code'){
//                             document.getElementById(this.options.post).value = item.long_name;
//                         }
//                     });
//                 });
//
//                 const map = new google.maps.Map(document.getElementById(this.options.map), {
//                     zoom: 3,
//                     center: { lat: 48, lng: 25 },
//                 });
//
//                 const infoWindow = new google.maps.InfoWindow({
//                     content: "",
//                     disableAutoPan: true,
//                 });
//
//                 // Create an array of alphabetical characters used to label the markers.
//                 const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//                 const mapTitle = this.mapTitle.mapTitle;
//
//                 // Add some markers to the map.1
//
//                 const markers = locations.map((position, i) => {
//                     const label = labels[i % labels.length];
//
//                     const marker = new google.maps.Marker({
//                         position,
//                         map,
//                         title: `${mapTitle[i + 1][1]}`,
//                         label: `${mapTitle[i + 1][0]}`,
//                         optimized: false,
//                     });
//
//                     // markers can only be keyboard focusable when they have click listeners
//                     // open info window when marker is clicked
//                     marker.addListener("click", () => {
//                         infoWindow.close();
//                         infoWindow.setContent(marker.getTitle());
//                         infoWindow.open(marker.getMap(), marker);
//                     });
//                     return marker;
//                 });
//
//                 // Add a marker clusterer to manage the markers.
//                 const markerCluster = new markerClusterer.MarkerClusterer({ map, markers });
//
//             }
//             const locations = this.options.locations;
//             window.initMap = initMap;
//         }
//
//
//     });
//
//     return $.mage.review;
// });
//
