<?php
//	\kossmoss\GoogleMaps\GoogleMapsAsset::register($this);
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Registro de Medico iNeed</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <!-- Acceso a Firebase -->
        <!--  <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script> -->
        <script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-database.js"></script>
        <script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-messaging.js"></script>


        <script>
          // Initialize Firebase
          var config = {
            apiKey: "AIzaSyByYNWc75bJPnj0JYzOoM2sgBcCr3tjVHE",
            authDomain: "medical-7d55f.firebaseapp.com",
            databaseURL: "https://medical-7d55f.firebaseio.com",
            projectId: "medical-7d55f",
            storageBucket: "medical-7d55f.appspot.com",
            messagingSenderId: "737485362105"
          };
          firebase.initializeApp(config);
        </script>
        
        <!-- AGREGAMOS LA LIBRERIA QUE CONTIENE LA LOGICA -->

        <?php $this->registerJsFile(
			    '@web/js/medico.js'
			    //['depends' => [\yii\web\JqueryAsset::className()]]
			); 
		?>
        <!-- <script src="js/paises.js"></script> -->
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
		    	<div class="divider-new">
		            <h2 class="h2-responsive"><?php echo 'Subscribe'; ?></h2>
		        </div>
	        </div>
        </div>
        <form id="form-medico">
            <div class="row">
                <div class="col-sm-5">
                        <div class="form-group">
                            <label for="cmbpais">Country</label>
                            <select id="pais" name="pais" class="form-control" required></select>
                        </div>
                        <div class="form-group">
                            <label for="instancia">Cell phone</label>
                            <input type="text" class="form-control" name="instancia" value="" id="instancia" placeholder="Number (no Country code)" required >
                        </div>
                        <div class="form-group">
                            <label for="prefijo">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="nombre" value="" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="prefijo">Mail</label>
                            <input type="email" class="form-control" placeholder="Correo Electronico" name="correo" value="" id="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="prefijo">Specialty</label>
                            <select id="servicio" name="servicio" class="form-control" required>
                                
                            </select>
                        </div>
                        
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                            <label for="prefijo">Address</label>
                            <input type="text" class="form-control" name="direccion" value="" id="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="prefijo">Service Data</label>
                            
                            <textarea class="form-control" rows="3" placeholder="Describe Service" name="dato_servicio" id="dato_servicio" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="numero_registro">Medical Register</label>
                            <input type="text" class="form-control" name="numero_registro" value="" id="numero_registro" placeholder="Register Code" required>
                        </div>
                        <div class="form-group">
                            <label for="experiencia">Experience</label>
                            <input type="number" class="form-control" name="experiencia" value="" id="experiencia" placeholder="Years of experience" min="1" max="50" step="1" pattern="\d+" required>
                        </div>
                        <div class="form-group">
                            <label for="costo">Cost</label>
                            <input type="text" class="form-control" name="costo" value="" id="costo" placeholder="Cost" required>
                        </div>  
                </div>    
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="prefijo">Latitude</label>
                        <input type="text" class="form-control" name="latitud" value="" id="latitud" placeholder="Click Map"  required>
                    </div>
                    <div class="form-group">
                        <label for="prefijo">Longitude</label>
                        <input type="text" class="form-control" name="longitud" value="" id="longitud" placeholder="Click Map"  required>  <!-- agregar propiedad readonly para cuando funcione el mapa -->
                    </div>
                </div>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoQTBQiZvRzL-8M_8UTCy45cOd0gdRwjU"></script>
                <div class="col-sm-5">
                    <div id="map" style="width: 100%; height: 250px;"></div>
                        <?php
                            
                            /* PARA OBTENER LAS COORDENADAS DESDE EL NAVEGADOR HTML5 ...PERO REQUIERE PERMISOS */
                            $this->registerJs('
                                    if(!navigator.geolocation){
                                        alert("Su navegador no soporta Geolocalizacion");
                                    }
                                    navigator.geolocation.getCurrentPosition(success, error);
                                    function success(position){
                                        var latitude  = position.coords.latitude;   
                                        var longitude = position.coords.longitude;  
                                        //var accuracy  = position.coords.accuracy;
                                        document.getElementById("latitud").value  = latitude;
                                        document.getElementById("longitud").value  = longitude;
                                        //document.getElementById("acc").value  = accuracy;
                                    }
                                    function error(err){
                                        alert("ERROR Permisos de Geolocalizacion: (" + err.code + "): " + err.message);
                                    }
                                ');
                            

                            //$latitud='-17.48062';
                            $latitud='48.22216622815179';
                            $longitud='16.48463341249999';
                            //$longitud='-66.24756';
                            $marcadores='';
                            
                            /*$titulo = 'Ud. Esta aca';
                            $texto = 'Este es el contenido';
                            $marcadores .='var marker = new google.maps.Marker({
                                  map: map,
                                  position: {lat: '.$latitud.', lng: '.$longitud.'},
                                  title: "'.$titulo.'"
                                });
                                attachSecretMessage(marker, "'.$texto.'");';
                            */
                            $this->registerJs('
                                var map;
                                var markers = [];
                                initMap();

                                function initMap() {
                                    
                                    
                                    map = new google.maps.Map(document.getElementById("map"), {
                                        center: {lat: '.$latitud.', lng: '.$longitud.'},
                                        scrollwheel: false,
                                        zoom: 2,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                    });

                                    

                                    map.addListener("click", function(e) {
                                        deleteMarkers();
                                        placeMarker(e.latLng, map);
                                        document.getElementById("latitud").value = e.latLng.lat().toFixed(5);
                                        document.getElementById("longitud").value = e.latLng.lng().toFixed(5);

                                    });

                                    function placeMarker(position, map) {
                                        
                                        var marker = new google.maps.Marker({
                                            position: position,
                                            map: map
                                        });
                                        map.panTo(position);
                                        markers.push(marker);
                                    }

                                    function setMapOnAll(map) {
                                        for (var i = 0; i < markers.length; i++) {
                                          markers[i].setMap(map);
                                        }
                                      }



                                    function clearMarkers() {
                                        setMapOnAll(null);
                                    }

                                    

                                    function deleteMarkers() {
                                        clearMarkers();
                                        markers = [];
                                    }

                                }

                                
                            ');
                        ?>
                    
                </div>
            </div>

            <div class="row">    
                <input type="submit" class="btn-lg btn-warning" name="boton-enviar-ofertante" value="Create" id="boton-enviar-ofertante">
            </div>
        </form>
    
    </div>
    </body>
</html>