<?php

namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 
class Generales extends Component
{
    function url_fotografia_jugador($fotografia)
    {
        $url_fichero=\yii\helpers\Url::base(true).$fotografia;

         if ($this->url_exists($url_fichero)) 
         {
            $nombre_fichero=\yii\helpers\Url::to('@web'.$fotografia);
         }else{
            $nombre_fichero=\yii\helpers\Url::to('@web/fotografias/').'sin_foto.png';
         }
         return $nombre_fichero;
    }
    
    function url_fotografia($fotografia)
    {
        $url_fichero=\yii\helpers\Url::base(true).$fotografia;

         if ($this->url_exists($url_fichero)) 
         {
            $nombre_fichero=\yii\helpers\Url::to('@web'.$fotografia);
         }else{
            $nombre_fichero=\yii\helpers\Url::to('@web/fotografias/').'sin_foto.png';
         }
         return $nombre_fichero;
    }

    function url_logo($fotografia)
    {
        $url_fichero=\yii\helpers\Url::base(true).$fotografia;

         if ($this->url_exists($url_fichero)) 
         {
            $nombre_fichero=\yii\helpers\Url::to('@web'.$fotografia);
         }else{
            $nombre_fichero=\yii\helpers\Url::to('@web/logos/').'sin_logo.png';
         }
         return $nombre_fichero;
    }

    function url_imagen_campania($fotografia)
    {
        $url_fichero=\yii\helpers\Url::base(true).$fotografia;

         if ($this->url_exists($url_fichero)) 
         {
            $nombre_fichero=\yii\helpers\Url::to('@web'.$fotografia);
         }else{
            $nombre_fichero=\yii\helpers\Url::to('@web/logos/').'sin_logo.png';
         }
         return $nombre_fichero;
    }
    

    function url_exists( $url = NULL ) 
    {
        $handle = @fopen($url, "r");
        if ($handle == false)
            return false;
        fclose($handle);
        return true;
    }
    function getIdSolo($id)
    {
        //Ejm del $id es 1953_JUGADOR
        $porciones = explode("_", $id);
        if (count($porciones)==2)
            return $porciones[0];
        else
            return 0;
    }
    

	function getPromedio($coleccion,$campo)
	{
		 $vec = array();
        foreach ($coleccion as $v) {
            $vec[]=$v->$campo;
        }
        if (count($vec)>0)
        	return array_sum($vec)/count($vec); 
        else
        	return 0;
	}
 
}