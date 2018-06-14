<?php

namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 
class FormatoFecha extends Component
{
 public function get_x_months_to_the_future( $base_time = null, $months = 1 )
	{
	    if (is_null($base_time))
	        $base_time = time();
	    
	    $x_months_to_the_future    = strtotime( "+" . $months . " months", $base_time );
	    
	    $month_before              = (int) date( "m", $base_time ) + 12 * (int) date( "Y", $base_time );
	    $month_after               = (int) date( "m", $x_months_to_the_future ) + 12 * (int) date( "Y", $x_months_to_the_future );
	    
	    if ($month_after > $months + $month_before)
	        $x_months_to_the_future = strtotime( date("Ym01His", $x_months_to_the_future) . " -1 day" );
	    
	    return $x_months_to_the_future;
	} //get_x_months_to_the_future()

	public function getFechaLarga($dia)
	{
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		//echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

		$newDatetime = preg_replace('/_/','-',$dia);
		
		$time = date( "Y-m-d",$this->get_x_months_to_the_future(strtotime($newDatetime),0));
		//$time = date('m/d/y',strtotime($newDatetime));
		return $dias[date('w',strtotime($time))]." ".date('d',strtotime($time))." de ".$meses[date('n',strtotime($time))-1]. " del ".date('Y',strtotime($time)) ;
	}
	public function getFechaMesAnio($dia)
	{
		$meses = array("Enero","Feb.","Marzo","Abril","Mayo","Junio","Julio","Ago.","Sep.","Oct.","Nov.","Dic.");

		//echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

		$newDatetime = preg_replace('/_/','-',$dia);
		
		$time = date( "Y-m-d",$this->get_x_months_to_the_future(strtotime($newDatetime),0));
		//$time = date('m/d/y',strtotime($newDatetime));
		return $meses[date('n',strtotime($time))-1]. " ".date('Y',strtotime($time)) ;
	}
	public function getFechaLargaConHora($fechaConHora)
	{
		$date1 = strtotime($fechaConHora);
		$res=$this->getFechaLarga($fechaConHora).' a las '.date('H:i',$date1);
		return $res;
	}
	function fecha_en_rango($start_date, $end_date, $evaluame) {
	    $start_ts = strtotime($start_date);
	    $end_ts = strtotime($end_date);
	    $user_ts = strtotime($evaluame);
	    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	}

	function fecha_atras($datetime)
	{
		$date1 = strtotime($datetime);
		$date2 = time();
		$subTime = $date2 - $date1;
		$y = (int)($subTime/(60*60*24*365));
		$d = (int)($subTime/(60*60*24))%365;
		$h = (int)($subTime/(60*60))%24;
		$m = (int)($subTime/60)%60;

		if ($d>1 || $y>0)
		{
			$res=$this->getFechaLarga($datetime).' a las '.date('H:i',$date1);
		}elseif ($y==0 && $d==1)
		{
			$res='ayer a las '.date('H:i',$date1);
		}elseif ($h>0){
			$res='hace '.$h.' horas y '.$m.' minutos';
		}else{
			$res='hace '.$m.' minutos';
		}
		//$res .= '<br>año: '.$y.'<br>dia: '.$d.'<br>hora: '.$h.'<br>minutos: '.$m;
		return $res;

	}
	function fecha_para_nombe_archivo()
	{
		//$fecha = $date->format('Y_m_d H_i_s');
		$fecha = (new \DateTime())->format('Y_m_d__H_i_s');
		return $fecha;

	}

	function fecha_hora_lectura()
	{
		//$fecha = $date->format('Y_m_d H_i_s');
		$fecha = (new \DateTime())->format('d-m-Y H:i:s');
		return $fecha;

	}

	
 
}