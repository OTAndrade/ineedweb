<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Subir logo de la Empresa';
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//$nombre_fichero = Yii::$app->generales->url_logo($modelEmpresa->logo_empresa);
$nombre_fichero = $empresa['Logo'];
?>



<div class="container">
	<div class="row">
		<div class="col-md-4">

			<div class="card" style="width: 18rem;">
			  <img class="img-circle" src="<?= $nombre_fichero ?>" alt="fotografía"  height="120" width="120">
			  <div class="card-body">
			    <h5 class="card-title"><?= $empresa['Nombre'] ?></h5>
			    <p class="card-text"><?= $empresa['Sigla'] ?></p>
			    <div class="box-footer no-padding">
			      	<?php $form = ActiveForm::begin([
					     "method" => "post",
					     "enableClientValidation" => true,
					     "options" => ["enctype" => "multipart/form-data"],
					     ]);
					?>

					<?= $form->field($model, "file[]")->fileInput(['multiple' => true]) ?>

					<?= Html::submitButton("Subir logo", ["class" => "btn btn-primary btn-block"]) ?>

					<?php $form->end() ?>
		    	</div>
			  </div>
			</div>

		</div> 
		<div class="col-md-6">
			<h3>Subir Logo</h3>
			<h3>Tamaño recomendado de la imagen es de 128x128 pixeles</h3>
		</div>  
	</div>  
</div>