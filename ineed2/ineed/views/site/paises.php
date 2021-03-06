<html>
    <head>
        <meta charset="utf-8">
        <title>Registro de Paises iNeed</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <!-- Acceso a Firebase -->
        <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>
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
			    '@web/js/paises.js'
			    //['depends' => [\yii\web\JqueryAsset::className()]]
			); 
		?>
        <!-- <script src="js/paises.js"></script> -->
    </head>
    <body>
    <div class="container">
    	<div class="row">
            <div class="col-sm-7">
		    	<div class="divider-new">
		            <h2 class="h2-responsive">Gestion Paises</h2>
		        </div>
        	</div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="3"> Paises</th>
                        </tr>
                        <tr>
                            <th>Codigo Pais</th>
                            <th>Nombre Pais</th>
                            <th>Prefijo</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-paises">
                    
                    </tbody>
                </table>
            </div>
            <div class="col-sm-1">
                <!-- Espacio -->
            </div>
            <div class="col-sm-4">
                <form id="form-pais">
                    <div class="form-group">
                        <label for="codigo">Codigo Pais</label>
                        <input type="text" class="form-control" name="codigo" value="" id="codigo">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre Pais</label>
                        <input type="text" class="form-control" name="nombre" value="" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="prefijo">Prefijo</label>
                        <input type="text" class="form-control" name="prefijo" value="" id="prefijo">
                    </div>
                    
                    <input type="submit" class="form-control" name="boton-enviar-pais" value="Crear Pais" id="boton-enviar-pais">
                </form>
            </div>
        </div>    
    
    </div>
    </body>
</html>

