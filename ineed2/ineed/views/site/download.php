<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
//use yii\captcha\Captcha;

$this->title = 'Download';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                    <div class="panel-body">
                        <img src="<?= \Yii::$app->params['url_imagenes']?>download.png" class="" alt="Descarga" width="100%">
                    </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul>
                            <li><?= Html::a("Download",\Yii::$app->params['url_app']."iNeedServ.apk",
      array('class'=>'btn btn-success grid-button')
   )?></li>
                            
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</div>
