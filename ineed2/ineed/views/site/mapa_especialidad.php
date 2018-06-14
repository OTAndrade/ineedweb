<?php
//use miloschuman\highcharts\Highcharts;
use yii\helpers\Html; 
//\kossmoss\GoogleMaps\GoogleMapsAsset::register($this);
//use dosamigos\google\maps\Map;


use dosamigos\google\maps\LatLng;
//use dosamigos\google\maps\services\DirectionsWayPoint;
//use dosamigos\google\maps\services\TravelMode;
//use dosamigos\google\maps\overlays\PolylineOptions;
//use dosamigos\google\maps\services\DirectionsRenderer;
//use dosamigos\google\maps\services\DirectionsService;
//use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
//use dosamigos\google\maps\overlays\Polygon;
//use dosamigos\google\maps\layers\BicyclingLayer;

?>


<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoQTBQiZvRzL-8M_8UTCy45cOd0gdRwjU"></script>
<?php $this->registerJsFile(
      '@web/js/mapaEspecialidad.js'
      ); 
?>

<div class="container">
	<div class="row">
	    <div class="col-sm-12">
	    	<div class="divider-new">
	            <h2 class="h2-responsive"><?php echo $espe ; ?></h2>
	        </div>
	    </div>
	</div>
	<!-- MAPA y PANEL DERECHA GON -->
	<!-- Main row -->
	<div class="row">
	  <!-- Left col -->
	  <div class="col-md-12">
	    <!-- INICIO MAPA -->
	    <div class="cat-club-index">
	        <div class="col-md-12">
	            <div id="map" style="width: 100%; height: 550px;"></div>    
	        </div>
	    </div>
	    <!-- FIN MAPA -->
	  </div>
	</div>
	<div>
		<input type="hidden" class="form-control" name="espe" value="<?= $espe ?>" id="espe" >
	</div>

	
</div>

