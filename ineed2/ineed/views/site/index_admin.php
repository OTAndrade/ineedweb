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
                                <h2 class="h2-responsive">ADMINISTRADOR iNeed <?= $session->isActive?$session->get('user_id'):'error' ?></h2>
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
                        <div class="col-md-3">
                            <!--Card-->

                            <div class="card" style="width: 12rem;">
                              <img src="<?= \Yii::$app->params['url_imagenes']?>especialidades.png" class="img-fluid" alt="">
                              <div class="card-body">
                                <h5 class="card-title">Especialidades</h5>
                                <p class="card-text">Gestion</p>
                                <?= Html::a('Ingresar', ['site/especialidades'], ['class' => 'btn btn-primary']) ?>
                              </div>
                            </div>
                            
                            <!--/.Card-->
                        </div>
                        <!--First columnn-->
                        <div class="col-md-3">
                            <div class="card" style="width: 12rem;">
                              <img src="<?= \Yii::$app->params['url_imagenes']?>paises.png" class="img-fluid" alt="">
                              <div class="card-body">
                                <h5 class="card-title">Paises</h5>
                                <p class="card-text">Gestion Paises</p>
                                <?= Html::a('Ingresar', ['site/paises'], ['class' => 'btn btn-primary']) ?>
                              </div>
                            </div>

                        </div>
                        <div class="col-md-3">

                            <div class="card" style="width: 14rem;">
                              <img src="<?= \Yii::$app->params['url_imagenes']?>empresaFarmaceutica.png" class="img-fluid" alt="">
                              <div class="card-body">
                                <h5 class="card-title">Empresas</h5>
                                <p class="card-text">Laboratorios Farmaceuticos. Empresas de Medicamentos</p>
                                <?= Html::a('Ingresar', ['site/empresas'], ['class' => 'btn btn-primary']) ?>
                              </div>
                            </div>

                            
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="width: 14rem;">
                              <img src="<?= \Yii::$app->params['url_imagenes']?>farmacia.png" class="img-fluid" alt="">
                              <div class="card-body">
                                <h5 class="card-title">Farmacias</h5>
                                <p class="card-text">Venta de Medicamentos a pacientes. Registro</p>
                                <?= Html::a('Ingresar', ['site/farmacias'], ['class' => 'btn btn-primary']) ?>
                              </div>
                            </div>
                            <!--Card-->
                           
                        </div>
                    </div>
                    <div class="row">
                        <!--Second columnn-->
                        <div class="col-md-3">
                            <!--Card-->
                            <div class="card">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="<?= \Yii::$app->params['url_imagenes']?>mapa.png" class="img-fluid" alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/.Card image-->

                                <!--Card content-->
                                <div class="card-block">
                                    <!--Title-->
                                    <h4 class="card-title">Medicos</h4>
                                    <!--Text-->
                                    <p class="card-text">Ubicacion Medicos</p>
                                    <?= Html::a('Mapa', ['site/mapa'], ['class' => 'btn btn-primary']) ?>
                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->
                        </div>
                        <!--Second columnn-->

                        <!--Third columnn-->
                        
                        <div class="col-md-3">
                            <!--Card-->
                            <div class="card">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="<?= \Yii::$app->params['url_imagenes']?>download.png" class="img-fluid" alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/.Card image-->

                                <!--Card content-->
                                <div class="card-block">
                                    <!--Title-->
                                    <h4 class="card-title">iNeed</h4>
                                    <!--Text-->
                                    <p class="card-text">Descargue la Aplicacion</p>
                                    <?= Html::a('Descarga', ['site/download'], ['class' => 'btn btn-primary']) ?>
                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->
                        </div>
                        <div class="col-md-3">
                            <!--Card-->
                            <div class="card">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="<?= \Yii::$app->params['url_imagenes']?>youtube.png" class="img-fluid" alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/.Card image-->

                                <!--Card content-->
                                <div class="card-block">
                                    <!--Title-->
                                    <h4 class="card-title">Videos</h4>
                                    <!--Text-->
                                    <p class="card-text">Videoteca de publicidad subida al canal iNeed</p>
                                    <?= Html::a('Ingresar', ['site/youtube'], ['class' => 'btn btn-primary']) ?>
                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->
                        </div>
                        <div class="col-md-3">
                            <!--Card-->
                            <div class="card">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="<?= \Yii::$app->params['url_imagenes']?>oscar.png" class="img-fluid" alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/.Card image-->

                                <!--Card content-->
                                <div class="card-block">
                                    <!--Title-->
                                    <h4 class="card-title">Vaciar Firebase</h4>
                                    <!--Text-->
                                    <p class="card-text">para demo</p>
                                    <?= Html::a('Borrar', ['site/eliminaoscar'], ['class' => 'btn btn-primary']) ?>
                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->
                        </div>
                        <!--Third columnn-->
                    </div>
                    <!--/.Second row-->

                </div>    

                </div>
                <!--/.Main column-->
            </div>
        </div>
        <!--/.Main layout-->

    </main>