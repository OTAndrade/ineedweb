<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Contenido Campaña iNeed</title>
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
			    '@web/js/multimedia.js'
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
						  <img class="img-rounded" src="<?= $emp['Logo'] ?>" alt="User profile picture" height="120" width="120">
						  <div class="card-body">
						    <h5 class="card-title"><?= $emp['Nombre'] ?></h5>
						    <p class="card-text"><?= $emp['Sigla'] ?></p>
						  </div>
						  <ul class="list-group list-group-flush">
						  	<li class="list-group-item">Direccion: <?= $emp['Direccion'] ?></li>
						  	<li class="list-group-item">Telefono: <?= $emp['Telefono'] ?></li>
						  	<li class="list-group-item">Mail: <?= $emp['Mail'] ?></li>
						  	<li class="list-group-item">www: <?= $emp['Web'] ?></li>
						  	<li class="list-group-item">Facebook: <?= $emp['Facebook'] ?></li>
						  	<li class="list-group-item">Twitter: <?= $emp['Twitter'] ?></li>
						  </ul>
						  <div class="card-body">
						    <p><?= Html::a('Volver', ['site/campanias', 'emp' => $id_emp,'tip'=>$tip],['class' => 'btn btn-info']); ?></p>
						  </div>
					</div>
		          
		        <!--  PANEL DE LA DERECHA CON TABS -->
		        </div>
		        <div class="col-md-9">
						
				  	<div class="row">
			            <div class="col-md-12">
					    	<div class="divider-new">
					            <h2 class="h2-responsive"><?= $cam['nombre_campania'] ?></h2>
					        </div>
					        <ul class="list-group list-group-flush">
					        	<li class="list-group-item">Fecha Inicio: <?= $cam['fecha_inicio'] ?> - Fecha Fin: <?= $cam['fecha_fin'] ?></li>
					        </ul>
				        </div>
			        </div>
			        <div class="row">
			            <form id="form-texto">
				            <div class="col-md-10">
					        		<div>
			                            <label for="text">Texto de la Campaña</label>
			                            
			                            
			                            <textarea class="form-control" rows="5" id="texto"></textarea>
			                            
			                            <input type="hidden" class="form-control" name="id_cam" value="<?= $id_cam ?>" id="id_cam">

			                        </div>
							</div>
				            <div class="col-md-2">
				            	<button type="submit" class="btn btn-primary" name="boton-actualizar-texto" value="Actualizar" id="boton-actualizar-texto">Actualizar</button>
								
							</div>
			        	</form>
					</div>
			        <div class="row">
			            <div class="col-md-6">
			        		<div class="row">
				                <?php $form = ActiveForm::begin([
								     "method" => "post",
								     "enableClientValidation" => true,
								     "options" => ["enctype" => "multipart/form-data"],
								     ]);
								?>

								<?= $form->field($model, "file[]")->fileInput(['multiple' => true]) ?>

								<?= Html::submitButton("Subir Imagen", ["class" => "btn btn-sm btn-primary"]) ?>

								<?php $form->end() ?>
			            	</div>
			            	<div class="row">
			            		<table class="table ">
				                    <thead>
				                        <tr>
				                            <th colspan="5"> Imagenes</th>
				                        </tr>
				                        <tr>
				                            <th>Imagen</th>
				                            <th>Fecha Upload</th>
				                        </tr>
				                    </thead>
				                    <tbody id="tbody-imagenes">
				                    
				                    </tbody>
				                </table>
			            	</div>
			            </div>
			            <div class="col-md-6">
			                Aca los videos
			            </div>
			            
			  		</div>

        		</div>
		    </div>
		</div>

		

    </body>
</html>


