<?php

namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
//use yii\helpers\Url;
use yii\helpers\Html;
 
class FirebaseApp extends Component
{
    
	function especialidades_mapa()
	{
		$salida='';
		$database = Yii::$app->firebase->getDatabase();
        $dataEspecialidades = $database->getReference('Especialidades')
        -> orderByChild('Especialidad')
        -> getSnapshot();
        $especialidades = $dataEspecialidades->getValue();
        foreach($especialidades as $data){
        	$cont=0;
        	$cont=$this->conteo_especialidad($data['Especialidad']);
        	$salida.= Html::a($data['Especialidad'].'('.$cont.')',['site/mapaespecialidad', 'espe' => $data['Especialidad']], ['class' => 'list-group-item']);
        }
        return $salida;         
	}

	function conteo_especialidad($esp)
	{
		$database = Yii::$app->firebase->getDatabase();
        $dataEspecialidades = $database->getReference('Ofertantes')
        ->orderByChild('Especialidad')
        -> equalTo($esp)
        -> getSnapshot();
        $especialidades = $dataEspecialidades->getValue();
        $sal=0;
        foreach($especialidades as $data){
        	$sal++;
        }
        return $sal;
	}

	// Para empresas Asociadas (LABORATORIOS y FARMACIAS)
	function usuarioAsociado($id)
	{
		$database = Yii::$app->firebase->getDatabase();
        $dataAsociados = $database->getReference('Asociados/'.$id)
        //->orderByChild('Especialidad')
        //-> equalTo($esp)
        -> getSnapshot();
        $asociado = $dataAsociados->getValue();
        return $asociado;
	}

	function loginUsuarioAsociado($cor,$cla)
	{
		$database = Yii::$app->firebase->getDatabase();
        $dataAsociados = $database->getReference('Asociados')
        ->orderByChild('correo')
        -> equalTo($cor)
        -> getSnapshot();
        
        $asociado = $dataAsociados->getValue();
        $key = key($asociado);
        //var_dump($key);
        //echo $asociado[$key]['contrasenia'];
        //var_dump($asociado);
        //exit();
        if($asociado[$key]['contrasenia']==$cla)
        	return $asociado;
        else
        	return null;
	}
	function keyUsuarioAsociado($cor)
	{
		$database = Yii::$app->firebase->getDatabase();
        $dataAsociados = $database->getReference('Asociados')
        ->orderByChild('correo')
        -> equalTo($cor)
        -> getSnapshot();
        $asociado = $dataAsociados->getValue();
        $key=key($asociado);
        //exit();
        return $key;
	}
	function empresa($id, $tip)
	{
		$database = Yii::$app->firebase->getDatabase();
        
		if($tip=='LABORATORIO')
	        $data = $database->getReference('Empresas/'.$id)
	        //->orderByChild('Especialidad')
	        //-> equalTo($esp)
	        -> getSnapshot();
		if($tip=='FARMACIA')
	        $data = $database->getReference('Farmacias/'.$id)
		        //->orderByChild('Especialidad')
		        //-> equalTo($esp)
		        -> getSnapshot();
        $empresa = $data->getValue();
        return $empresa;
	}


 
}