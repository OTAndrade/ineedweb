<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
use  yii\web\Session;
$session = Yii::$app->session;
$this->title = 'My Yii Application';
?>
<main>

        <!--Main layout-->
        <div class="container">
            <div class="row">

                <!--Main column-->
                <div class="col-md-12">

                    <!--First row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="divider-new">
                                <h2 class="h2-responsive">ASOCIADO: <?= $emp['Nombre'] ?></h2>
                            </div>
                            <!--Carousel Wrapper-->
                            <div id="carousel-example-2" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel">
                                <!--Indicators-->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-2" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-2" data-slide-to="2"></li>
                                </ol>
                                <!--/.Indicators-->

                                <!--Slides-->
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img src="<?= \Yii::$app->params['url_imagenes']?>ineed1.png" class="" alt="First slide">
                                        <div class="carousel-caption">
                                            <h4>Servicios Medicos</h4>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= \Yii::$app->params['url_imagenes']?>dolor.png" class="" alt="Second slide">
                                        <div class="carousel-caption">
                                            <h4>Necesitas un Medico?</h4>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= \Yii::$app->params['url_imagenes']?>ineedM.png" class="" alt="Third slide">
                                        <div class="carousel-caption">
                                            <h4>Ubicacion inmediata</h4>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <!--/.Slides-->

                                <!--Controls-->
                                <a class="left carousel-control" href="#carousel-example-2" role="button" data-slide="prev">
                                    <span class="icon-prev" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-2" role="button" data-slide="next">
                                    <span class="icon-next" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <!--/.Controls-->
                            </div>
                            <!--/.Carousel Wrapper-->
                        </div>
                    </div>
                    <!--/.First row-->
                    <br>
                    <hr class="extra-margins">

                    <!--Second row-->
                    <div class="row">
                        <!--First columnn-->
                        <div class="col-md-4">
                            <!--Card-->

                            <div class="card" style="width: 12rem;">
                              <img class="img-rounded" src="<?= $emp['Logo'] ?>" alt="User profile picture" height="120" width="120">
                              <div class="card-body">
                                <h5 class="card-title"><?= $emp['Nombre'] ?></h5>
                                <p class="card-text"><?= $emp['Sigla'] ?></p>
                              </div>
                            </div>
                            
                            <!--/.Card-->
                        </div>
                        <!--First columnn-->
                        <div class="col-md-6">
                            <div class="card" style="width: 12rem;">
                              <img src="<?= \Yii::$app->params['url_imagenes']?>publi.png" class="img-fluid" alt="">
                              <div class="card-body">
                                <h5 class="card-title">Campañas</h5>
                                <p class="card-text">Crear Campañas</p>
                                <?= Html::a('Ingresar', ['site/campanias','emp'=>$id_emp, 'tip'=>'FARMACIA'], ['class' => 'btn btn-primary']) ?>
                              </div>
                            </div>

                        </div>
                        
                    </div>
                </div>    

                </div>
                <!--/.Main column-->
            </div>
        </div>
        <!--/.Main layout-->

    </main>