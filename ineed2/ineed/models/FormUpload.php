<?php
 
namespace app\models;
use Yii;
use yii\base\Model;


 
class FormUpload extends model{
  
    public $file;
     
    public function rules()
    {
        return [
            ['file', 'file', 
           'skipOnEmpty' => false,
           'uploadRequired' => 'No has seleccionado ningún archivo', //Error
           'maxSize' => 1024*200, //1 kbyte
           'tooBig' => 'El tamaño máximo permitido es 200 KB', //Error
           'minSize' => 10, //10 Bytes
           'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
           'extensions' => 'jpg, png, gif, jpeg',
           'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
           'maxFiles' => 2,
           'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
           ],
        ]; 
    } 
 
 public function attributeLabels()
 {
  return [
   'file' => 'Seleccionar archivos:',
  ];
 }
}
