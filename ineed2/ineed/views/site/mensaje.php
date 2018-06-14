<?php
use yii\helpers\Html;

?>

<main>

        <!--Main layout-->
        <div class="container">
            <div class="row">

                <!--Main column-->
                <div class="col-md-8">

                    <!--First row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="divider-new">
                                <h2 class="h2-responsive">Su cuenta de iNeed ha sido creada con exito!!</h2>
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
                                        <img src="http://ineed2.dev/ineed/web/images/ineed1.png" class="" alt="First slide">
                                        <div class="carousel-caption">
                                            <h4>Servicios Medicos</h4>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="http://ineed2.dev/ineed/web/images/ineed2.png" class="" alt="Second slide">
                                        <div class="carousel-caption">
                                            <h4>Dentistas</h4>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="http://ineed2.dev/ineed/web/images/ineedM.png" class="" alt="Third slide">
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
                            <div class="card">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="http://ineed2.dev/ineed/web/images/add.png" class="img-fluid" alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/.Card image-->

                                <!--Card content-->
                                <div class="card-block">
                                    <!--Title-->
                                    <h4 class="card-title">Suscribirse</h4>
                                    <!--Text-->
                                    <p class="card-text">Conviertase en Medico en iNeed</p>
                                    <?= Html::a('Gratis', ['site/medico'], ['class' => 'btn btn-primary']) ?>
                                    
                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->
                        </div>
                        <!--First columnn-->

                        <!--Second columnn-->
                        <div class="col-md-4">
                            <!--Card-->
                            <div class="card">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="http://ineed2.dev/ineed/web/images/mapa.png" class="img-fluid" alt="">
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
                                    <p class="card-text">Ubicacion de los Medicos en iNeed</p>
                                    <?= Html::a('Mapa', ['site/mapa'], ['class' => 'btn btn-primary']) ?>
                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->
                        </div>
                        <!--Second columnn-->

                        <!--Third columnn-->
                        <div class="col-md-4">
                            <!--Card-->
                            <div class="card">

                                <!--Card image-->
                                <div class="view overlay hm-white-slight">
                                    <img src="http://ineed2.dev/ineed/web/images/download.png" class="img-fluid" alt="">
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
                                    <?= Html::a('Android', ['site/download'], ['class' => 'btn btn-primary']) ?>
                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->
                        </div>
                        <!--Third columnn-->
                    </div>
                    <!--/.Second row-->

                    

                </div>
                <!--/.Main column-->

                <?php
                    $database = Yii::$app->firebase->getDatabase();
                    $dataEspecialidades = $database->getReference('Especialidades')
                    -> orderByChild('Especialidad')
                    -> getSnapshot();

                    
                    $especialidades = $dataEspecialidades->getValue();
                ?>
                <!--Sidebar-->
                <div class="col-md-4">

                    <div class="widget-wrapper">
                        <h4>Especialidades:</h4>
                        <br>
                        <div class="list-group">
                        <?php $i=0; foreach($especialidades as $data): ?>

                            <a href="#" class="list-group-item <?= $i==0? 'active':''?>"><?= $data['Especialidad']?></a>
                        <?php $i++; endforeach; ?>
                        </div>
                    </div>

                    <div class="widget-wrapper">
                        <h4>Acceso a su Consultorio:</h4>
                        <br>
                        <div class="card">
                            <div class="card-block">
                                <p>Acceso solo para Medicos</p>
                                <div class="md-form">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="text" id="form1" class="form-control">
                                    <label for="form1">Correo</label>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-key prefix"></i>
                                    <input type="text" id="form2" class="form-control">
                                    <label for="form2">Clave</label>
                                </div>
                                <button class="btn btn-primary">Ingresar</button>

                            </div>
                        </div>
                    </div>

                </div>
                <!--/.Sidebar-->



            </div>
        </div>
        <!--/.Main layout-->

    </main>