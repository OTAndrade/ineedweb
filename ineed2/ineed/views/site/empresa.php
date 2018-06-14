<?php
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\widgets\DetailView;


//$dir_imagen = Yii::$app->generales->url_logo($model->logo_empresa);

//$dir_imagen = 'http://www.ineedserv.com/ineed/web/img_empresas/sin_logo.png';

/* @var $this yii\web\View */
/* @var $model app\models\CatJugador */

/*$this->title = $model->nombre_empresa;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
*/
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registro de Usuarios de Laboratorios iNeed</title>
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
			    '@web/js/asociados.js'
			    //['depends' => [\yii\web\JqueryAsset::className()]]
			); 
		?>
        <!-- <script src="js/paises.js"></script> -->
    </head>
    <body>

		<div class="container">

		    <div class="row">
		        <div class="col-md-4">

		        	<div class="card" style="width: 35rem;">
						  <img class="img-rounded" src="<?= $empresa['Logo'] ?>" alt="User profile picture">
						  <div class="card-body">
						    <h5 class="card-title"><?= $empresa['Nombre'] ?></h5>
						    <p class="card-text"><?= $empresa['Sigla'] ?></p>
						  </div>
						  <ul class="list-group list-group-flush">
						  	<li class="list-group-item">Direccion: <?= $empresa['Direccion'] ?></li>
						  	<li class="list-group-item">Telefono: <?= $empresa['Telefono'] ?></li>
						  	<li class="list-group-item">Mail: <?= $empresa['Mail'] ?></li>
						  	<li class="list-group-item">www: <?= $empresa['Web'] ?></li>
						  	<li class="list-group-item">Facebook: <?= $empresa['Facebook'] ?></li>
						  	<li class="list-group-item">Twitter: <?= $empresa['Twitter'] ?></li>
						  </ul>
						  <div class="card-body">
						    <p><?= Html::a('Logo', ['site/upload', 'emp' => $emp],['class' => 'btn btn-warning']); ?></p>
						    <p><?= Html::a('Volver', ['site/empresas'],['class' => 'btn btn-info']); ?></p>
						  </div>
					</div>
		          
		        <!--  PANEL DE LA DERECHA CON TABS -->
		        </div>
		        <div class="col-md-8">
			          							<!-- Tab panes -->
						
				  	<div class="row">
			            <div class="col-md-12">
					    	<div class="divider-new">
					            <h2 class="h2-responsive"><?php echo 'Creacion de Credenciales'; ?></h2>
					        </div>
				        </div>
			        </div>
			        <div class="row">
			            <div class="col-md-9">
			                <table class="table ">
			                    <thead>
			                        <tr>
			                            <th colspan="4"> Usuarios</th>
			                        </tr>
			                        <tr>
			                            <th>Nombre</th>
			                            <th>Correo</th>
			                            <th>Estado</th>
			                            <th>Clave</th>
			                        </tr>
			                    </thead>
			                    <tbody id="tbody-usuarios-asociados">
			                    
			                    </tbody>
			                </table>
			            </div>
			            <div class="col-md-3">
					        <form id="form-asociados">
		                        <div class="form-group">
		                            <label for="cmbpais">Pais</label>
		                            <select id="pais" name="pais" class="form-control" required></select>
		                        </div>
		                        <div class="form-group">
		                            <label for="instancia">Celular</label>
		                            <input type="text" class="form-control" name="instancia" value="" id="instancia" placeholder="Num. celular SIN cod. pais" required >
		                        </div>
		                        <div class="form-group">
		                            <label for="nombre">Nombre Completo</label>
		                            <input type="text" class="form-control" placeholder="Nombre completo" name="nombre" value="" id="nombre" required>
		                        </div>
		                        <div class="form-group">
		                            <label for="prefijo">Correo</label>
		                            <input type="email" class="form-control" placeholder="Correo" name="correo" value="" id="correo" required>
		                            <input type="hidden" class="form-control" name="tipoUsuario" value="LABORATORIO" id="tipoUsuario">
		                            <input type="hidden" class="form-control" name="id_empresa" value="<?= $emp ?>" id="id_empresa">
		                            <input type="hidden" class="form-control" name="nombre_empresa" value="<?= $empresa['Nombre'] ?>" id="nombre_empresa">
		                        </div>
					            <div class="row">    
					          	      <input type="submit" class="form-control" name="boton-enviar-asociado" value="Crear" id="boton-enviar-asociado">
					            </div>
					        </form>

				  		</div>
			  		</div>

        		</div>
		    </div>
		</div>
    </body>
</html>


