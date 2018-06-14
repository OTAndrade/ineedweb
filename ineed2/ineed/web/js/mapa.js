window.onload = inicializar;
var refMedicos;
var ofertantes='';
//var v_mapa; 


// Funcion q se ejecuta al cargar el script
function inicializar(){
    refMedicos= firebase.database().ref().child("Ofertantes");
    //v_mapa = document.getElementById("map");
    cargaMarcadores();
}

// Funcion q carga los marcadores para cada medico encontrado en Firebase y luego crea los puntos en el mapa
function cargaMarcadores(){
	refMedicos.on("value", function(snap){
        var datos = snap.val();
        var i=0;
        for(var key in datos){
        	var espe=datos[key].Especialidad;
        	var inicial=espe.charAt(0);
            ofertantes += ' var marker_'+i+' = new google.maps.Marker({'+
				' map: map,'+ //map + ', '+
				' label: "'+inicial+'",'+ //map + ', '+
                ' position: {lat:'+ datos[key].Latitud+', lng: '+ datos[key].Longitud+'},'+
                ' title: "'+ datos[key].Especialidad+'"'+
              	'});';
            var msg = '<b>'+datos[key].Especialidad+'</b><br>'+'<b>'+datos[key].Nombre+'</b><br>'+datos[key].DatoServicio+'<br>'+datos[key].Direccion;
            ofertantes+= ' var infowindow_'+i+' = new google.maps.InfoWindow('+
      				'{ content: "'+msg+'",'+
        			'	size: new google.maps.Size(50,50)'+
      				'});'+
      				
  					' google.maps.event.addListener(marker_'+i+', "click", function() {'+
    				' infowindow_'+i+'.open(map,marker_'+i+');'+
  					'});';
  			i++;	
        }
        //console.log(ofertantes);
        //armaMapa(ofertantes);

        map = new google.maps.Map(document.getElementById("map"), {
        //center: {lat: -18.555624709588447, lng: -64.94739550000003},	// Estas coordenadas deberian ser calculadas para centrar el mapa en el lugar apropiado
        center: {lat: 0, lng: 0},	// Ubicamos el centro del mapa en coordenadas 0,0
        scrollwheel: false,
        zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    eval(ofertantes);
    });
}
               