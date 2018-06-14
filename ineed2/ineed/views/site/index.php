<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
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
                                <h2 class="h2-responsive"><?php echo Html::encode(\Yii::$app->name); ?></h2>
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
                                            <h4>Medical Services</h4>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= \Yii::$app->params['url_imagenes']?>dolor.png" class="" alt="Second slide">
                                        <div class="carousel-caption">
                                            <h4>Do you Need a Doctor?</h4>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= \Yii::$app->params['url_imagenes']?>ineedM.png" class="" alt="Third slide">
                                        <div class="carousel-caption">
                                            <h4>Immediate location</h4>
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
                                    <img src="<?= \Yii::$app->params['url_imagenes']?>add.png" class="img-fluid" alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/.Card image-->

                                <!--Card content-->
                                <div class="card-block">
                                    <!--Title-->
                                    <h4 class="card-title">Subscribe</h4>
                                    <!--Text-->
                                    <p class="card-text">Become a Doctor in iNeed</p>
                                    <?= Html::a('Free', ['site/medico'], ['class' => 'btn btn-primary']) ?>
                                    
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
                                    <img src="<?= \Yii::$app->params['url_imagenes']?>mapa.png" class="img-fluid" alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>
                                <!--/.Card image-->

                                <!--Card content-->
                                <div class="card-block">
                                    <!--Title-->
                                    <h4 class="card-title">Doctors</h4>
                                    <!--Text-->
                                    <p class="card-text">Location of Doctors in iNeed</p>
                                    <?= Html::a('Map', ['site/mapa'], ['class' => 'btn btn-primary']) ?>
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
                                    <p class="card-text">Download App</p>
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
                        <h4>Specialties:</h4>
                        <br>
                        <div class="list-group">
                        <?php echo Yii::$app->firebaseapp->especialidades_mapa(); ?>

                        
                        </div>
                    </div>

                    <div class="widget-wrapper">
                        <h4>Access</h4>
                        <br>
                        <div class="card">
                            <div class="card-block">
                                <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
                                <i class="fa fa-envelope prefix"></i>
                                <?= $form
                                    ->field($model, 'username')
                                    ->label(false)
                                    ->textInput(['placeholder' => 'Mail', 'class' => 'form-control']) ?>
                                <i class="fa fa-key prefix"></i>
                                <?= $form
                                    ->field($model, 'password')
                                    ->label(false)
                                    ->passwordInput(['placeholder' => 'Password', 'class' => 'form-control']) ?>

                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <?php ActiveForm::end(); ?>




                                

                            </div>
                        </div>
                    </div>

                </div>
                <!--/.Sidebar-->



            </div>
        </div>
        <!--/.Main layout-->

    </main>