<?php 

   include("../../inc.mysql.php"); 

   // VARS
   $AlertKey = $_GET['key'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

   <?php include("../../inc.metatags.php"); ?>

   <?php include("../../inc.resources.php"); ?>

</head>

<body>

   <?php include("../../inc.navigation.php"); ?>

   <section id="dashboard">

      <div class="container">

         <div class="panel">

            <div class="panel-heading">
               <div class="row">
                  <div class="col-lg-4">

                     <h3 class="panel-title">Usuario</h3>

                     <div class="user-data">
                        <strong id="user-name">-</strong><br>
                        <span id="user-address">Mitre 247 - CP 1621.</span><br>
                        <span id="user-city">Marcos Paz, Buenos Aires.</span><br><br>
                        <span id="user-phone">5411 6299 0989</span><br>
                        <span id="user-email">usuariofemenino@gmail.com</span>
                     </div>

                  </div>
                  <div class="col-lg-4">

                     <h3 class="panel-title">Denuncia</h3>

                     <div class="user-data">
                        <strong id="case-code">-</strong><br>
                        <span id="case-type">-</span><br>
                        <span id="case-date">-</span><br><br>

                        <div class="label-device apple"> 
                           <i class="fa fa-apple" aria-hidden="true"></i> apple App
                        </div>

                     </div>

                  </div>
                  <div class="col-lg-4">
                     <h3 class="panel-title">&nbsp;</h3>

                     <div class="user-data">
                        <strong>Estado del Caso:</strong><br>
                        <span id="case-status">-</span><br><br>
                        <strong>Operador:</strong><br>
                        <span id="case-operador">Carolina Ríos</span>
                     </div>

                  </div>
               </div>
            </div>

            <div class="panel-body">

               <div id="map-canvas"></div>

            </div>

         </div>

      </div>

   </section>



   <link rel="stylesheet" type="text/css" href="../../js/DataTables/datatables.min.css"/>
   <script type="text/javascript" src="../../js/DataTables/datatables.min.js"></script>

   <script src="https://www.gstatic.com/firebasejs/3.2.1/firebase.js"></script>
   <script>
      var config = {
         apiKey: "AIzaSyDNK0RzdP_uulAJaYTau9QU_jmOEOJQy_8",
         authDomain: "clarociudadsegura.firebaseapp.com",
         databaseURL: "https://clarociudadsegura.firebaseio.com",
         storageBucket: "clarociudadsegura.appspot.com",
      }; firebase.initializeApp(config);
   </script>
    

    <!-- Google Maps -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDNK0RzdP_uulAJaYTau9QU_jmOEOJQy_8"></script> -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNK0RzdP_uulAJaYTau9QU_jmOEOJQy_8&callback=initMap"></script>
    <script>
 
         
    var alertaRef = firebase.database().ref('alerta/<?php echo $AlertKey ?>');
    var map;
    var MY_MAPTYPE_ID   = 'custom_style';

    // Google Maps
    function initMap() {

        var mapOptions = {
            zoom: 17,
            center: new google.maps.LatLng(0,0),
            scrollwheel: false,
            
            mapTypeControl: false,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                position: google.maps.ControlPosition.TOP_RIGHT,
                mapTypeIds: [ MY_MAPTYPE_ID, google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID, google.maps.MapTypeId.TERRAIN]
            },
            mapTypeId: MY_MAPTYPE_ID,
            
            panControl: true,
            panControlOptions: {
                position: google.maps.ControlPosition.TOP_LEFT
            },
            
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.TOP_LEFT
            },

            streetViewControl: true,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.RIGHT_TOP
            }
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
          
        var featureOpts = [
                          {
                            "stylers": [
                              { "saturation": -100 }
                            ]
                          },{
                            "stylers": [
                              { "lightness": 34 }
                            ]
                          },{
                            "featureType": "poi",
                            "elementType": "labels",
                            "stylers": [
                              { "visibility": "off" }
                            ]
                          },{
                          }
                        ];
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        
        var styledMapOptions = { name: 'PERSONALIZADO' };
        var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
        map.mapTypes.set(MY_MAPTYPE_ID, customMapType);





         alertaRef.once("value").then(function(snap) {
         //.on("child_added", function(snap) {

            var dataArray = $.makeArray( snap.val() );
            dataArray[0]['key'] = snap.key;
            
            console.log('Array: '+dataArray);
            
            var latLng = new google.maps.LatLng(snap.val().latitud, snap.val().longitud);

            var markerImage = new google.maps.MarkerImage('../../img/app/ic-marker.png',
                new google.maps.Size(26, 41),
                new google.maps.Point(0, 0),
                new google.maps.Point(13, 37));

            var myLatLng = new google.maps.LatLng(snap.val().latitud,snap.val().longitud);
            var Incident = new google.maps.Marker({
                position: latLng,
                map: map,
                icon: markerImage
            });

            map.setCenter(latLng);

            console.log('setCenter: '+snap.val().latitud+' - '+snap.val().longitud);

            $("#user-name").html(snap.val().nombre+' '+snap.val().apellido);
            $("#case-code").html('Caso: '+snap.key);
            $("#case-type").html('Alerta: '+snap.val().type);
            $("#case-date").html('Fecha: '+snap.val().date+' '+snap.val().time+'hs');
            $("#case-status").html(snap.val().status);

         });

      }

   </script>


</body>
</html>