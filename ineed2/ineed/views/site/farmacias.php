<html>
    <head>
        <meta charset="utf-8">
        <title>Registro de Farmacias iNeed</title>
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
			    '@web/js/farmacias.js'
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
		            <h2 class="h2-responsive">Gestion Farmacias</h2>
		        </div>
        	</div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="3"> Farmacias</th>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <th>Sigla</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-farmacias">
                    
                    </tbody>
                </table>
            </div>
            <div class="col-sm-1">
                <!-- Espacio -->
            </div>
            <div class="col-sm-4">
                <form id="form-farmacia">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="sigla">Sigla</label>
                        <input type="text" class="form-control" name="sigla" value="" id="sigla">
                    </div>
                    <div class="form-group">
                        <label for="mail">Mail</label>
                        <input type="text" class="form-control" name="mail" value="" id="mail">
                    </div>
                    <div class="form-group">
                        <label for="web">www</label>
                        <input type="text" class="form-control" name="web" value="" id="web">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" class="form-control" name="facebook" value="" id="facebook">
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" class="form-control" name="twitter" value="" id="twitter">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" name="direccion" value="" id="direccion">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" name="telefono" value="" id="telefono">
                    </div>
                    <div class="form-group">
                        <label for="prefijo">Estado</label>
                        <input type="text" class="form-control" name="estado" value="" id="estado">
                        <input type="hidden" class="form-control" name="logo" value="<?= \Yii::$app->params['url_img_emp']?>sin_logo.png" id="logo">
                    </div>
                    
                    <input type="submit" class="form-control" name="boton-enviar-farmacia" value="Crear Farmacia" id="boton-enviar-farmacia">
                </form>
            </div>
        </div>    
    
    </div>
    </body>
</html>

