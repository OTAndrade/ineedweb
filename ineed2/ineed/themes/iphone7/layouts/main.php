<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;

use  yii\web\Session;
$session = Yii::$app->session;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo Html::encode(\Yii::$app->name); ?> </title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/mdb.min.css" rel="stylesheet">

    <!-- Template styles -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/style.css" rel="stylesheet">

    <style>
            body {
        background-color: white;
      }

      .primary-color-dark {
        background-color: #000 !important;
      }

.btn.btn-primary {
  background-color: #000;
}
    
.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
  background-color: #000;
  border-color: #000;
}
    </style>

</head>

<body>

<?php $this->beginBody() ?>

    <header>

        <!--Navbar-->
        <nav class="navbar navbar-dark primary-color-dark">

            <!-- Collapse button-->
            <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx">
                <i class="fa fa-bars"></i>
            </button>

            <div class="container">

                <!--Collapse content-->
                <div class="collapse navbar-toggleable-xs" id="collapseEx">
                    <!--Navbar Brand-->
                    <a class="navbar-brand" href="#" target="_blank"><?php echo Html::encode(\Yii::$app->name); ?></a>
                    <!--Links-->
                    <?php
      				        
                            if($session->get('tipo')=='1'||$session->get('tipo')=='2'||$session->get('tipo')=='admin'||$session->get('tipo')=='invitado') // 1: Solicitante 2:Ofertante admin:administrador 

                            echo Menu::widget([
      				          'options' => [
      				            "id"  => "nav",
      				            "class" => "nav navbar-nav"
      				          ],
    				            'items' => [
                                  ['label' => 'Home', 'url' => ['site/index'], "options" => [ "class" => "nav-item"]],
    				              ['label' => 'About', 'url' => ['site/about'], "options" => [ "class" => "nav-item"]],
                                  ['label' => 'Contact', 'url' => ['site/contact'], "options" => [ "class" => "nav-item"]],
    				              ['label' => 'Associates', 'url' => ['site/asociados'], "options" => [ "class" => "nav-item"]],
                                  //['label' => 'Salir', 'url' => ['site/salir'], "options" => [ "class" => "nav-item"], 'visible' => $session->get('tipo')=='1'||$//session->get('tipo')=='2'],
                                  ['label' => 'Exit', 'url' => ['site/salir'], "options" => [ "class" => "nav-item"]],
    				            ],
      				        ]);

                            else        // Si es FARMACIA O LABORATORIO
                                echo Menu::widget([
                              'options' => [
                                "id"  => "nav",
                                "class" => "nav navbar-nav"
                              ],
                                'items' => [
                                  ['label' => 'Acerca de', 'url' => ['site/about'], "options" => [ "class" => "nav-item"]],
                                  ['label' => 'Contacto', 'url' => ['site/contact'], "options" => [ "class" => "nav-item"]],
                                  ['label' => 'Asociados', 'url' => ['site/asociados'], "options" => [ "class" => "nav-item"]],
                                  ['label' => 'Salir Asociado', 'url' => ['site/salir'], "options" => [ "class" => "nav-item"], 'visible' => $session->get('tipo')=='LABORATORIO'||$session->get('tipo')=='FARMACIA'],
                                ],
                            ]);
	  		            ?>

                    <!--Search form-->
                    <form class="form-inline">
                        <input class="form-control" type="text" placeholder="Buscar">
                    </form>
                </div>
                <!--/.Collapse content-->

            </div>

        </nav>
        <!--/.Navbar-->

    </header>

    <div class="row">
      <div class="col-md-12">
         <?php echo $content; ?>
      </div>
    </div>

    <!--Footer-->
    <footer class="page-footer center-on-small-only primary-color-dark">

        <!--Footer Links-->
        <div class="container-fluid">
            <div class="row">

                <!--First column-->
                <div class="col-md-3 col-md-offset-1">
                    <h5 class="title">iNeed</h5>
                    <p>Request what you Need</p>

                    <p>Find an Specialist</p>
                </div>
                <!--/.First column-->

                <hr class="hidden-md-up">

                <!--Second column-->
                <div class="col-md-2 col-md-offset-1">
                    <h5 class="title">iNeed Health</h5>
                    <ul>
                        <p>Medical Doctors</p>
                    </ul>
                </div>
                <!--/.Second column-->

                <hr class="hidden-md-up">

                <!--Third column-->
                <div class="col-md-2">
                    <h5 class="title">iNeed Lawyers</h5>
                    <ul>
                        <p>Lawyers bufet</p>
                    </ul>
                </div>
                <!--/.Third column-->

                <hr class="hidden-md-up">

                <!--Fourth column-->
                <div class="col-md-2">
                    <h5 class="title">iNeed Cars</h5>
                    <ul>
                        <p>Automotive mechanics</p>
                    </ul>
                </div>
                <!--/.Fourth column-->

            </div>
        </div>
        <!--/.Footer Links-->

        <hr>

        <!--Call to action-->
        <div class="call-to-action">
            <h4><?php echo Html::encode(\Yii::$app->name); ?></h4>
        </div>
        <!--/.Call to action-->

        <!--Copyright-->
        <div class="footer-copyright">
            <div class="container-fluid">
               Copyright &copy; 2018 - made with <span style="color:red;">&#9829;</span> by <a href="http://www.ineedserv.com">iNeed</a>

            </div>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/js/mdb.min.js"></script>

    <script>
      // ugly MDB fix http://i.imgur.com/WFl7fkh.jpg
      $(function(){
        $("#nav li a").addClass("nav-link");
      });
    </script>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
