<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                    <div class="panel-body">
                        <img src="<?= \Yii::$app->params['url_imagenes']?>contacto.png" class="" alt="Contacto" width="100%">
                    </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Contacto</div>
                    <div class="panel-body">
                        <ul>
                            <li>Mail: info@ineedserv.com</li>
                            <li>Telefono: +591 70676031</li>
                            <li>Oficina: Av. 16 de Julio Edif. 16 de Julio piso 9 Of. 903</li>
                            <li>Ciudad/Pais: La Paz - Bolivia</li>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</div>
