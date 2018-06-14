<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use  yii\web\Session;

use app\models\FormUpload;
use yii\web\UploadedFile;



class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$session = Yii::$app->session;
        $session = Yii::$app->session;

        $model = new LoginForm();
        
        if(!$session->isActive)
        {
            $session = Yii::$app->session;
            $session->set('user_id', '0');
            $session->set('tipo', 'invitado');
            return $this->render('index',['model'=> $model,]);
        }else{

            if ($model->load(Yii::$app->request->post())) {
                $session->open();
                if($model->username=='admin'&&$model->password=='tr1c4mp30n')
                {    
                    // Trabajamos con variables de sesion para controlar acceso a paginas
                    $session->set('user_id', '1');
                    $session->set('tipo', 'admin');
                    return $this->render('index_admin',
                    [
                        'model'=> $model,
                    ]);
                }else{
                    // Consultamos a Firebase y lanzamos a un index de medico
                    $database = Yii::$app->firebase->getDatabase();
                    $dataUsuario = $database->getReference('Usuarios')
                    ->orderByChild('correo')
                    -> equalTo($model->username)
                    ->getSnapshot();
                    $usuario = $dataUsuario->getValue();  // Con esto obtenemos los valores del Snapshot en un arreglo
                    foreach($usuario as $vkey => $val) {
                        $clave = $vkey;
                    }
                    if(isset($clave)&&$usuario[$clave]['contrasenia']==$model->password)
                    {
                        $session->set('user_id', $clave);
                        $session->set('tipo', 'medico');
                        $session->set('usuario', $usuario);
                        return $this->render('index_medico',
                        [
                            'model'=> $model,
                            'usuario'=>$usuario,
                            'clave'=>$clave
                        ]);
                    }else{
                        $session->close();
                        return $this->render('index',['model'=> $model,]);        
                    }
                }

            }else
                {
                    if($session->get('tipo')=='admin')
                        return $this->render('index_admin',['model'=> $model,]);
                    if($session->get('tipo')=='medico')
                        return $this->render('index_medico',['model'=> $model,'usuario'=>$session->get('usuario'),'clave'=>$session->get('user_id')]);
                    if($session->get('tipo')=='invitado'||$session->get('tipo')==NULL)
                        return $this->render('index',['model'=> $model,]);        
                }
        }
        
    }
    public function actionAsociados()
    {
        //$session = Yii::$app->session;
        $session = Yii::$app->session;

        $model = new LoginForm();
        
        if(!$session->isActive)
        {
            $session = Yii::$app->session;
            $session->set('user_id', '0');
            $session->set('tipo', 'invitado');
            return $this->render('index_asociado',['model'=> $model,]);
        }else{

            if ($model->load(Yii::$app->request->post())) {
                $session->open();
                // Consultamos a Firebase y lanzamos a un index de medico

                $aso = Yii::$app->firebaseapp->loginUsuarioAsociado($model->username,$model->password);
                $id_aso = Yii::$app->firebaseapp->keyUsuarioAsociado($model->username);
                $empresa = Yii::$app->firebaseapp->empresa($aso[$id_aso]['id_empresa'],$aso[$id_aso]['tipoUsuario']);
                


                if(isset($aso)&&isset($id_aso))
                {
                    $emp = Yii::$app->firebaseapp->usuarioAsociado($aso[$id_aso]['id_empresa']);

                    $session->set('user_id', $id_aso);
                    $session->set('tipo', $aso[$id_aso]['tipoUsuario']);
                    $session->set('usuario', $aso[$id_aso]['correo']);
                    
                    if($aso[$id_aso]['tipoUsuario']=='LABORATORIO')
                        return $this->render('index_laboratorio',
                        [
                            'emp'=> $empresa,
                            'id_emp'=> $aso[$id_aso]['id_empresa'],
                        ]
                        );
                    if($aso[$id_aso]['tipoUsuario']=='FARMACIA')
                        return $this->render('index_farmacia',
                        [
                            'emp'=> $empresa,
                            'id_emp'=> $aso[$id_aso]['id_empresa'],
                        ]
                    );
                }else{
                    $session->close();
                    return $this->render('index_asociado',['model'=> $model,]);        
                }
                

            }else
                {
                    return $this->render('index_asociado',['model'=> $model,]);
                }
        }
        
    }

    // Cerramos Sesion
    public function actionSalir()
    {
        $model = new LoginForm();
        $session = Yii::$app->session;
        $session->set('user_id', '0');
        $session->set('tipo', 'invitado');
        //if($session->isActive){
            $session->close();
            $session->destroy();
            return $this->goHome();
        //}else
        //    return $this->render('index',['model'=> $model,]);
    }



    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    // ACCIONES PRINCIPALES DE LA PANTALLA INICIAL

    public function actionMedico()
    {
        //$session = Yii::$app->session;
        //if($session->isActive&&$session->get('tipo')=='medico')
            return $this->render('medico', []);
        //else
        //    return $this->goHome();
    }

    public function actionMapa()
    {
        return $this->render('mapa', []);
    }

    public function actionMapaespecialidad($espe)
    {
        return $this->render('mapa_especialidad', ['espe'=>$espe]);
    }

    public function actionDownload()
    {
        return $this->render('download', []);
    }

    public function actionMensaje($mail,$clave)
    {
        $content = "<p>Dear User </p>";
            $content .= "<p>Your Password is : <b>" . $clave . "</b></p>";
            $content .= "<p>Access to the App (ANDROID) with this credentials</p>";
            $content .= "<p><b>iNeed.... Request what you need - " . date("Y") . "</b></p>";

            Yii::$app->mail->compose()
                 ->setFrom('qsl.sistemas@gmail.com')
                 ->setTo($mail)
                 ->setSubject('iNeed  Credentials')
                 //->setTextBody($content)
                 ->setHtmlBody($content) 
                 ->send();
        return $this->render('mensaje');
    }

    public function actionEspecialidades()
    {
        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='admin')
            return $this->render('especialidades', []);
        else
            return $this->goHome();
    }

    public function actionPaises()
    {
        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='admin')
            return $this->render('paises', []);
        else
            return $this->goHome();
    }
    // LABORATORIOS FARMACEUTICOS Empresas que producen Medicamentos
    public function actionEmpresas()
    {
        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='admin')
            return $this->render('empresas', []);
        else
            return $this->goHome();
    }

    public function actionEmpresa($emp)
    {
        

        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='admin'){
            $database = Yii::$app->firebase->getDatabase();
            $dataEmpresa = $database->getReference('Empresas/'.$emp)
            ->getSnapshot();
            $empresa = $dataEmpresa->getValue();  // Con esto obtenemos los valores del Snapshot en un arreglo
            //print ('Entro por Accion Empresa con sesion de admin');
            return $this->render('empresa', ['emp'=>$emp,'empresa'=>$empresa, 'emp'=>$emp]);
        }else{
            //print ('Entro por Accion Empresa devolviendo a HOME');
            return $this->goHome();
        }
    }

    public function actionCampanias($emp, $tip)
    {
        // OJO: Esto no esta bien!!! Hay que discriminar si se trata de Empresa(Laboratorio) o Farmacia
            $database = Yii::$app->firebase->getDatabase();
            if($tip=='LABORATORIO')
                $dataEmpresa = $database->getReference('Empresas/'.$emp)
                ->getSnapshot();
            if($tip=='FARMACIA')
                $dataEmpresa = $database->getReference('Farmacias/'.$emp)
                ->getSnapshot();
            $empresa = $dataEmpresa->getValue();  // Con esto obtenemos los valores del Snapshot en un arreglo
            return $this->render('campanias', ['emp'=>$emp,'empresa'=>$empresa, 'emp'=>$emp, 'tip'=>$tip]);
    }

    public function actionContenido_campania($id_cam, $id_emp,$tip)
    {
        
        //$database = Yii::$app->firebase->getDatabase();
        //$dataImagenes = $database->getReference('CampaniaImagen')->getSnapshot();
        //$campImg = $dataImagenes->getValue();


        $database = Yii::$app->firebase->getDatabase();
            if($tip=='LABORATORIO')
                $dataEmpresa = $database->getReference('Empresas/'.$id_emp)
                ->getSnapshot();
            if($tip=='FARMACIA')
                $dataEmpresa = $database->getReference('Farmacias/'.$id_emp)
                ->getSnapshot();
            $empresa = $dataEmpresa->getValue();  // Con esto obtenemos los valores del Snapshot en un arreglo
            $dataCampania = $database->getReference('Campanias/'.$id_cam)->getSnapshot();
            $campania = $dataCampania->getValue();

        // Aca ponemos la subida de Imagenes
        
        $model = new FormUpload;
      
        if ($model->load(Yii::$app->request->post()))
          {
            // subir multiples archivos
            $model->file = UploadedFile::getInstances($model, 'file');

            if ($model->file && $model->validate()) {
             foreach ($model->file as $file) {
                $nombre_archivo = 'campanias/' .$id_cam.'_'.Yii::$app->formatofecha->fecha_para_nombe_archivo(). '.' . $file->extension;
              $file->saveAs($nombre_archivo);
              Yii::$app->getSession()->setFlash(
                                'success','Enhorabuena, subida realizada con éxito'
                            );

              $nuevo_archivo = \Yii::$app->params['url_web'].$nombre_archivo;
              
              //Aca actualizo el valor en firebase
              //$empUp = $database->getReference('Empresas/'.$emp.'/Logo')->set($nuevo_archivo);
              $fecha_hora=Yii::$app->formatofecha->fecha_hora_lectura();
              $postData = [
                'fecha_upload'=> $fecha_hora,
                'id_campania'=> $id_cam,
                'id_empresa'=>  $id_emp,
                'imagen'=> $nuevo_archivo,
                'nombre_campania'=> $campania['nombre_campania'],//$nom_cam,
                'nombre_empresa'=> $empresa['Nombre'],//$nom_emp,
                ];
              $postRef = $database->getReference('CampaniaImagen')->push($postData);


              //return $this->redirect(['empresa', 'emp' => $emp]);
             }
            }
          }
        return $this->render('contenido_campania', 
            [
                'model'=>$model,
                'id_cam'=>$id_cam,
                'id_emp'=>$id_emp, 
                'emp'=>$empresa, 
                'cam'=>$campania,
                'tip'=>$tip
            ]);    
    }


    // LABORATORIOS FARMACEUTICOS Empresas que producen Medicamentos
    public function actionFarmacias()
    {
        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='admin')
            return $this->render('farmacias', []);
        else
            return $this->goHome();
    }

    public function actionFarmacia($far)
    {
        

        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='admin'){
            $database = Yii::$app->firebase->getDatabase();
            $dataFarmacia = $database->getReference('Farmacias/'.$far)
            ->getSnapshot();
            $farmacia = $dataFarmacia->getValue();  // Con esto obtenemos los valores del Snapshot en un arreglo
            return $this->render('farmacia', ['far'=>$far,'farmacia'=>$farmacia, 'far'=>$far]);
        }else
            return $this->goHome();
    }

    public function actionYoutube()
    {
        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='admin')
            return $this->render('youtube', []);
        else
            return $this->goHome();
    }
    public function actionEliminaoscar()
    {
        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='admin')
        {
            // Eliminamos las colecciones Bandeja y Solicitudes para la demo en Switzerland de Abril/2018
            $database = Yii::$app->firebase->getDatabase();
            $dataBandeja = $database->getReference('Bandeja')->remove();
            $dataSolicitudes = $database->getReference('Solicitudes')->remove();
            return $this->goHome();
        }   
        else
            return $this->goHome();
    }

    public function actionEditarmedico($id)
    {
        $database = Yii::$app->firebase->getDatabase();
        $dataMedico = $database->getReference('Ofertantes')
        ->orderByChild('Correo')
        -> equalTo($id)
        ->getSnapshot();
        $medico = $dataMedico->getValue();
        foreach($medico as $vkey => $val) {
            $clave = $vkey;
        }
        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='medico')
            return $this->render('editar_medico', [
                'medico'=>$medico,
                'clave'=>$clave,
            ]);
        else
            return $this->goHome();
    }

    public function actionBusqueda($id)
    {
        $database = Yii::$app->firebase->getDatabase();
        $dataMedico = $database->getReference('Ofertantes')
        ->orderByChild('Correo')
        -> equalTo($id)
        ->getSnapshot();
        $medico = $dataMedico->getValue();
        foreach($medico as $vkey => $val) {
            $clave = $vkey;
        }
        $session = Yii::$app->session;
        if($session->isActive&&$session->get('tipo')=='medico')
            return $this->render('busqueda_medico', [
                'medico'=>$medico,
                'clave'=>$clave,
            ]);
        else
            return $this->goHome();
    }


    // Para subida de LOGO de la Empresa Farmaceutica desde el perfil ADMIN
    public function actionUpload($emp)
    {
        $database = Yii::$app->firebase->getDatabase();
        $dataEmpresa = $database->getReference('Empresas/'.$emp)->getSnapshot();
        $empresa = $dataEmpresa->getValue();

      $model = new FormUpload;
      
      if ($model->load(Yii::$app->request->post()))
      {
        // subir multiples archivos
        $model->file = UploadedFile::getInstances($model, 'file');

        if ($model->file && $model->validate()) {
         foreach ($model->file as $file) {
            $nombre_archivo = 'img_empresas/' .$emp.'_'.Yii::$app->formatofecha->fecha_para_nombe_archivo(). '.' . $file->extension;
          $file->saveAs($nombre_archivo);
          Yii::$app->getSession()->setFlash(
                            'success','Enhorabuena, subida realizada con éxito'
                        );

          $nuevo_archivo = \Yii::$app->params['url_web'].$nombre_archivo;
          
          //Aca actualizo el valor en firebase
          $empUp = $database->getReference('Empresas/'.$emp.'/Logo')->set($nuevo_archivo);


          return $this->redirect(['empresa', 'emp' => $emp]);
         }
        }
      }
      return $this->render("upload", ["model" => $model, "empresa" => $empresa]);
    }

    // Para subida de LOGO de la Empresa Farmaceutica desde el perfil LABORATORIO
    public function actionUploadperfil($emp)
    {
        $database = Yii::$app->firebase->getDatabase();
        $dataEmpresa = $database->getReference('Empresas/'.$emp)->getSnapshot();
        $empresa = $dataEmpresa->getValue();

      $model = new FormUpload;
      
      if ($model->load(Yii::$app->request->post()))
      {
        // subir multiples archivos
        $model->file = UploadedFile::getInstances($model, 'file');

        if ($model->file && $model->validate()) {
         foreach ($model->file as $file) {
            $nombre_archivo = 'img_empresas/' .$emp.'_'.Yii::$app->formatofecha->fecha_para_nombe_archivo(). '.' . $file->extension;
          $file->saveAs($nombre_archivo);
          Yii::$app->getSession()->setFlash(
                            'success','Enhorabuena, subida realizada con éxito'
                        );

          $nuevo_archivo = \Yii::$app->params['url_web'].$nombre_archivo;
          
          //Aca actualizo el valor en firebase
          $empUp = $database->getReference('Empresas/'.$emp.'/Logo')->set($nuevo_archivo);


          return $this->redirect(['campanias', 'emp' => $emp,'tip'=>'LABORATORIO']);
         }
        }
      }
      return $this->render("upload", ["model" => $model, "empresa" => $empresa]);
    }


    // Para subida de LOGO de la Farmacia desde el perfil ADMIN
    public function actionUploadfarmacia($far)
    {
        $database = Yii::$app->firebase->getDatabase();
        $dataFarmacia = $database->getReference('Farmacias/'.$far)->getSnapshot();
        $farmacia = $dataFarmacia->getValue();

      $model = new FormUpload;
      
      if ($model->load(Yii::$app->request->post()))
      {
        // subir multiples archivos
        $model->file = UploadedFile::getInstances($model, 'file');

        if ($model->file && $model->validate()) {
         foreach ($model->file as $file) {
            $nombre_archivo = 'img_empresas/' .$far.'_'.Yii::$app->formatofecha->fecha_para_nombe_archivo(). '.' . $file->extension;
          $file->saveAs($nombre_archivo);
          Yii::$app->getSession()->setFlash(
                            'success','Enhorabuena, subida realizada con éxito'
                        );

          $nuevo_archivo = \Yii::$app->params['url_web'].$nombre_archivo;
          
          //Aca actualizo el valor en firebase
          $farUp = $database->getReference('Farmacias/'.$far.'/Logo')->set($nuevo_archivo);


          return $this->redirect(['farmacia', 'far' => $far]);
         }
        }
      }
      return $this->render("upload_farmacia", ["model" => $model, "farmacia" => $farmacia]);
    }

    // Para subida de LOGO de la Farmacia desde el perfil FARMACIA
    public function actionUploadfarmaciaperfil($far)
    {
        $database = Yii::$app->firebase->getDatabase();
        $dataFarmacia = $database->getReference('Farmacias/'.$far)->getSnapshot();
        $farmacia = $dataFarmacia->getValue();

      $model = new FormUpload;
      
      if ($model->load(Yii::$app->request->post()))
      {
        // subir multiples archivos
        $model->file = UploadedFile::getInstances($model, 'file');

        if ($model->file && $model->validate()) {
         foreach ($model->file as $file) {
            $nombre_archivo = 'img_empresas/' .$far.'_'.Yii::$app->formatofecha->fecha_para_nombe_archivo(). '.' . $file->extension;
          $file->saveAs($nombre_archivo);
          Yii::$app->getSession()->setFlash(
                            'success','Enhorabuena, subida realizada con éxito'
                        );

          $nuevo_archivo = \Yii::$app->params['url_web'].$nombre_archivo;
          
          //Aca actualizo el valor en firebase
          $farUp = $database->getReference('Farmacias/'.$far.'/Logo')->set($nuevo_archivo);


          return $this->redirect(['campanias', 'emp' => $far,'tip'=>'FARMACIA']);
         }
        }
      }
      return $this->render("upload_farmacia", ["model" => $model, "farmacia" => $farmacia]);
    }

    /// CREDENCIALES PARA EMPRESAS ASOCIADAS
    // LABORATORIOS
    public function actionEnviamailasociado($id_aso)
    {
        
        $aso = Yii::$app->firebaseapp->usuarioAsociado($id_aso);
        $clave = $aso['contrasenia'];
        $nom_emp = $aso['nombre_empresa'];
        $emp=$aso['id_empresa'];
        $mail=$aso['correo'];

        $content = "<p>Estimado Sr(a)</p>";
            $content .= "<p>Su clave de acceso para iNeed como asociado es : <b>" . $clave . "</b></p>";
            $content .= "<p>Su perfil se encuentra asociado a la Empresa: <b>".$nom_emp."</b></p>";
            $content .= "<p>Podra acceder a iNeed para administrar sus campañas publicitarias a traves de la direccion: http://www.ineedserv.com <b>Enlace Asociados</b></p>";
            $content .= "<p><b>iNeed.... lo que tu necesitas - " . date("Y") . "</b></p>";

            Yii::$app->mail->compose()
                 ->setFrom('qsl.sistemas@gmail.com')
                 ->setTo($mail)
                 ->setSubject('Credencial Asociado Activado para iNeed')
                 //->setTextBody($content)
                 ->setHtmlBody($content) 
                 ->send();
        return $this->redirect(['empresa', 'emp' => $emp]);
    }




}
