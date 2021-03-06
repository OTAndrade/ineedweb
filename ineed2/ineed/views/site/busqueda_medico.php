<?php
//	\kossmoss\GoogleMaps\GoogleMapsAsset::register($this);
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Busqueda</title>
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
			    '@web/js/busqueda.js'
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
		            <h2 class="h2-responsive">Busqueda</h2>
		        </div>
	        </div>
        </div>
        <form id="form-busqueda">
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="criterio">Filtro</label>
                        <input type="text" class="form-control" name="filtro" value="" id="filtro" placeholder="Criterio para filtrar" required >
                        <input type="hidden" class="form-control" name="usuario" value="<?= $clave ?>" id="usuario" >
                    </div>
                </div>
                <div class="col-sm-1">
                	<input type="submit" class="btn-lg btn-warning" name="boton-busqueda" value="Filtrar" id="boton-busqueda">
            	</div>
            </div>
        </form>
    	<div class="row">
            <div class="col-sm-10">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="3"> Solicitudes</th>
                        </tr>
                        <tr>
                            <th>Medico</th>
                            <th>Fecha Solicitud</th>
                            <th>Paciente</th>
                            <th>Fecha Aceptacion</th>
                            <th>Fecha Confirmacion</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-bandeja">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </body>
</html>