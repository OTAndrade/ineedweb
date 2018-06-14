<?php
//	\kossmoss\GoogleMaps\GoogleMapsAsset::register($this);
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Actualizar datos</title>
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
			    '@web/js/edita_medico.js'
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
		            <h2 class="h2-responsive">Actualizar Datos</h2>
		        </div>
	        </div>
        </div>
        <form id="form-medico">
            <div class="row">
                <div class="col-sm-5">
                        <div class="form-group">
                            <label for="cmbpais">Pais</label>
                            <input type="text" class="form-control" name="pais" value="<?= $medico[$clave]['Pais']?>" id="pais" placeholder="Codigo de pais" readonly >
                        </div>
                        <div class="form-group">
                            <label for="instancia">Celular</label>
                            <input type="text" class="form-control" name="instancia" value="<?= $medico[$clave]['Instancia']?>" id="instancia" placeholder="Numero de celular SIN codigo de pais" required >
                        </div>
                        <div class="form-group">
                            <label for="prefijo">Nombre Completo</label>
                            <input type="text" class="form-control" placeholder="Nombre(s) y apellido(s)" name="nombre" value="<?= $medico[$clave]['Nombre']?>" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="prefijo">Correo</label>
                            <input type="email" class="form-control" placeholder="Correo Electronico" name="correo" value="<?= $medico[$clave]['Correo']?>" id="correo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="prefijo">Especialidad</label>
                            <input type="text" class="form-control" name="especialidad" value="<?= $medico[$clave]['Especialidad']?>" id="especialidad" placeholder="Especialidad" readonly >
                        </div>
                        
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                            <label for="prefijo">Direccion</label>
                            <input type="text" class="form-control" name="direccion" value="<?= $medico[$clave]['Direccion']?>" id="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="prefijo">Dato Servicio</label>
                            
                            <textarea class="form-control" rows="3" placeholder="Describa el Servicio"  name="dato_servicio" id="dato_servicio" required><?= $medico[$clave]['DatoServicio']?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="numero_registro">Registro Medico</label>
                            <input type="text" class="form-control" name="numero_registro" value="<?= $medico[$clave]['NumeroRegistro']?>" id="numero_registro" placeholder="Numero de Registro Medico o S/N" required>
                        </div>
                        <div class="form-group">
                            <label for="experiencia">Años Experiencia</label>
                            <input type="number" class="form-control" name="experiencia" value="<?= $medico[$clave]['Experiencia']?>" id="experiencia" placeholder="Años de experiencia como Medico" min="1" max="50" step="1" pattern="\d+" required>
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo Consulta</label>
                            <input type="text" class="form-control" name="costo" value="<?= $medico[$clave]['Costo']?>" id="costo" placeholder="Costo de la Consulta" required>
                        </div>  
                </div>    
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="prefijo">Latitud</label>
                        <input type="text" class="form-control" name="latitud" value="<?= $medico[$clave]['Latitud']?>" id="latitud" placeholder="Seleccione del Mapa"  readonly>
                    </div>
                    <div class="form-group">
                        <label for="prefijo">Longitud</label>
                        <input type="text" class="form-control" name="longitud" value="<?= $medico[$clave]['Longitud']?>" id="longitud" placeholder="Seleccione del Mapa"  readonly>  <!-- agregar propiedad readonly para cuando funcione el mapa -->
                        <input type="hidden" class="form-control" name="usuario" value="<?= $clave ?>" id="usuario" >
                    </div>
                    <div class="form-group">
                        <label for="prefijo">Clave</label>
                        <input type="text" class="form-control" name="clave" value="<?= $medico[$clave]['Clave']?>" id="clave" placeholder="Clave de Acceso"  required>  
                    </div>
                </div>
            </div>

            <div class="row">    
                <input type="submit" class="btn-lg btn-warning" name="boton-enviar-ofertante" value="Actualizar" id="boton-enviar-ofertante">
            </div>
        </form>
    
    </div>
    </body>
</html>