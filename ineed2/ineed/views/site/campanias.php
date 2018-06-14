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
        <title>Registro de Campañas iNeed</title>
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
			    '@web/js/campanias.js'
			    //['depends' => [\yii\web\JqueryAsset::className()]]
			); 
		?>
        <!-- <script src="js/paises.js"></script> -->
    </head>
    <body>

		<div class="container">

		    <div class="row">
		        <div class="col-md-3">

		        	<div class="card" style="width: 25rem;">
						  <img class="img-rounded" src="<?= $empresa['Logo'] ?>" alt="User profile picture" height="120" width="120">
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
						    <p><?= $tip=='LABORATORIO'?Html::a('Logo', ['site/uploadperfil', 'emp' => $emp],['class' => 'btn btn-warning']):Html::a('Logo', ['site/uploadfarmaciaperfil', 'far' => $emp],['class' => 'btn btn-warning']); ?></p>
						  </div>
					</div>
		          
		        <!--  PANEL DE LA DERECHA CON TABS -->
		        </div>
		        <div class="col-md-9">
			          							<!-- Tab panes -->
						
				  	<div class="row">
			            <div class="col-md-12">
					    	<div class="divider-new">
					            <h2 class="h2-responsive"><?php echo 'Creacion de Campañas'; ?></h2>
					        </div>
				        </div>
			        </div>
			        <div class="row">
			            <div class="col-md-10">
			                <table class="table ">
			                    <thead>
			                        <tr>
			                            <th colspan="5"> Campañas</th>
			                        </tr>
			                        <tr>
			                            <th>Codigo</th>
			                            <th>Nombre</th>
			                            <th>Fecha Inicio</th>
			                            <th>Fecha Fin</th>
			                            <th>Estado</th>
			                        </tr>
			                    </thead>
			                    <tbody id="tbody-campanias">
			                    
			                    </tbody>
			                </table>
			            </div>
			            <div class="col-md-2">
					        <form id="form-campanias">
		                        <div class="form-group">
		                            <label for="codigo">Codigo</label>
		                            <input type="text" class="form-control" name="codigo" value="" id="codigo" placeholder="Codigo Unico" required readonly>
		                        </div>
		                        <div class="form-group">
		                            <label for="nombre_campania">Nombre Campaña</label>
		                            <input type="text" class="form-control" placeholder="Nombre campaña" name="nombre_campania" value="" id="nombre_campania" required>
		                        </div>
		                        

		                        <div class="form-group">
					                <div class='input-group date' id='datetimepicker1'>
					                    <input type='date' class="form-control" placeholder="Fecha Inicio" name="fecha_inicio" value="" id="fecha_inicio" required />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
		                        <div class="form-group">
		                            <div class='input-group date' id='datetimepicker2'>
					                    <input type='date' class="form-control" placeholder="Fecha Fin" name="fecha_fin" value="" id="fecha_fin" required />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
		                        </div>
		                        <div class="form-group">
		                            <input type="hidden" class="form-control" name="id_empresa" value="<?= $emp ?>" id="id_empresa">
		                            <input type="hidden" class="form-control" name="nombre_empresa" value="<?= $empresa['Nombre'] ?>" id="nombre_empresa">
		                            <input type="hidden" class="form-control" name="sigla" value="<?= $empresa['Sigla'] ?>" id="sigla">
		                            <input type="hidden" class="form-control" name="tipo_empresa" value="<?= $tip ?>" id="tipo_empresa">
		                            <input type="hidden" class="form-control" name="texto" value="N/D" id="texto">
		                        </div>
					            <div class="row">    
					          	      <input type="submit" class="form-control" name="boton-enviar-campania" value="Crear" id="boton-enviar-campania">
					            </div>
					        </form>

				  		</div>
			  		</div>

        		</div>
		    </div>
		</div>

		

    </body>
</html>


