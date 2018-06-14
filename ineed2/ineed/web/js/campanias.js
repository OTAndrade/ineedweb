
window.onload = inicializar;
var formCampanias;
var refCampanias;
var refCampaniasFiltrados;
var tbodyCampanias;
var CREATE ="Crear ";
var UPDATE ="Modificar";
var modo = CREATE;
var refCampaniaEditar;
var refCodigo;
var sigla;
var id_emp;
var tipo_empresa;
var texto;

function inicializar(){
    formCampanias = document.getElementById("form-campanias");
    refCodigo = document.getElementById("codigo");
    
    //formAsociados.addEventListener("submit", enviarAsociadosFirebase, false);
    formCampanias.addEventListener("submit", enviarCampaniasFirebase, false);
    
    //tbodyMedicos = document.getElementById("tbody-medicos");
    tbodyCampanias = document.getElementById("tbody-campanias");
    id_emp=document.getElementById("id_empresa").value;
    tipo_empresa=document.getElementById("tipo_empresa").value;
    sigla=document.getElementById("sigla").value;
    texto=document.getElementById("texto").value;
    refCampaniasFiltrados= firebase.database().ref().child("Campanias").orderByChild('id_empresa').equalTo(id_emp); // Aca hay q filtrar de la empresa actual
    refCampanias= firebase.database().ref().child("Campanias"); // Aca hay q filtrar de la empresa actual
    mostrarCampaniasFirebase();
}


// CARGA LA TABLA PARA MOSTRAR LOS REGISTROS DE LOS Paises (LISTADO)
function mostrarCampaniasFirebase(){
    refCampaniasFiltrados.on("value", function(snap){
        var datos = snap.val();
        var filasAMostrar = "";
        for(var key in datos){
            filasAMostrar += "<tr>"+
                "<td width='15%'>"+ datos[key].codigo +"</td>"+
                "<td width='15%'>"+ datos[key].nombre_campania+"</td>"+
                "<td width='15%'>"+ datos[key].fecha_inicio+"</td>"+
                "<td width='15%'>"+ datos[key].fecha_fin+"</td>"+
                "<td width='10%'>"+ datos[key].estado +"</td>"+
                '<td width="10%">' +
                '<button class="btn btn-xs btn-default editar" data-campania="' + key + '">' +
                '<span class="glyphicon glyphicon-pencil"></span>' +
                '</button>' + 
                '</td>'+
                '<td width="10%">' +
                '<button class="btn btn-xs btn-danger borrar" data-campania="' + key + '">' +
                '<span class="glyphicon glyphicon-trash"></span>' +
                '</button>' + 
                '</td>'+
                '<td width="10%">' +
                '<button class="btn btn-xs btn-success multimedia" data-campania="' + key + '">' +
                '<span class="glyphicon glyphicon-picture"></span>' +
                '</button>' + 
                '</td>'+
                "<tr>";
        }
       tbodyCampanias.innerHTML = filasAMostrar; 
        if(filasAMostrar != ""){
            var elementosEditables = document.getElementsByClassName("editar");
            for(var i=0; i< elementosEditables.length; i++){
                elementosEditables[i].addEventListener("click", editarCampaniaFirebase,false);
            }
            
            var elementosBorrables = document.getElementsByClassName("borrar");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosBorrables[i].addEventListener("click", borraCampaniaFirebase,false);
            }

            var elementosMultimedia = document.getElementsByClassName("multimedia");
            for(var i=0; i< elementosMultimedia.length; i++){
                elementosMultimedia[i].addEventListener("click", redirigirParaContenido,false);
            }
        }
    });
}

// GRABA EN FIREBASE POR CREACION y POR UPDATE
function enviarCampaniasFirebase(event){
    // A soliciud de Oscar primero generamos el auth
    //var email = event.target.correo.value;

    //console.log(email);
    var CodigoCamp;
    // Obtenemos la sigla de la Empresa para generar el codigo de Campaña Apropiado
    // La forma del codigo sera: SIGLA-CONTADOR ej.- INTI-1
    //refEmpresa= firebase.database().ref().child("Empresas").orderByChild('id_empresa').equalTo(event.target.id_empresa.value);
	//CodigoCamp = refEmpresa.child("Sigla");
	


	//console.log(refEmpresa);
    
    //console.log('ANTES DE LA ECATOMBE');
    event.preventDefault();

    CodigoCamp = sigla+'-'+codigoCampania(4,'1234567890');                // GENERA LA CLAVE  de 4 caracteres (solo numeros)
    var Estado = 'AC';
    switch(modo){
           case CREATE:
		      	{
			      	refCampanias.push({
			         id_empresa: event.target.id_empresa.value,
			         nombre_empresa: event.target.nombre_empresa.value,
			         codigo: CodigoCamp, //event.target.codigo.value,
			         nombre_campania: event.target.nombre_campania.value,
			         fecha_inicio: event.target.fecha_inicio.value,
			         fecha_fin: event.target.fecha_fin.value,
			         texto: texto,
			         estado: Estado
			      	});
			      	//console.log('Ingreso a la creacion');
			     }

      		break;
      		case UPDATE:
      			{
	      			refCampaniaEditar.update({
		      			nombre_campania: event.target.nombre_campania.value,
				        fecha_inicio: event.target.fecha_inicio.value,
				        fecha_fin: event.target.fecha_fin.value
	      			});
	      			modo = CREATE;
	             	document.getElementById("boton-enviar-campania").value = CREATE;
	             	//console.log('Ingreso a UPDATE');
	            }
      		break;
      	}
      // Reseteo el formulario
      //console.log('antes del reset');
      formCampanias.reset();
      //console.log('despues del reset');
      //window.location.href = 'http://www.ineedserv.com/ineed/web/index.php?r=site/empresa&emp='+event.target.id_empresa.value;

}

function codigoCampania(longitud, caracteres) {     
  longitud = longitud || 16;     
  caracteres = caracteres || "0123456789abcdefghijklmnopqrstuvwxyz";     
  var cadena = "";     
  var max = caracteres.length-1;     
  for (var i = 0; i<longitud; i++) {         
    cadena += caracteres[ Math.floor(Math.random() * (max+1)) ];
  }     
  return cadena; 
}

// OBTIENE LOS DATOS DE UNA Pais PARA EDICION DE CAMPOS
function editarCampaniaFirebase(){
    var keyCampaniaEditar = this.getAttribute("data-campania");
    refCampaniaEditar = refCampanias.child(keyCampaniaEditar);
    refCampaniaEditar.once("value", function(snap){
        var datos = snap.val();
       document.getElementById("codigo").value = datos.codigo;  
       document.getElementById("nombre_campania").value = datos.nombre_campania;  
       document.getElementById("fecha_inicio").value = datos.fecha_inicio;  
       document.getElementById("fecha_fin").value = datos.fecha_fin;  
    });
    document.getElementById("boton-enviar-campania").value = UPDATE;
    modo = UPDATE;
}

// ELIMINA UNA EMPRESA
function borraCampaniaFirebase(){
    var keyCampaniaBorrar = this.getAttribute("data-campania");
    var refCampaniaBorrar = refCampanias.child(keyCampaniaBorrar);
    refCampaniaBorrar.remove();
}

function redirigirParaContenido(){
    var keyCampaniaAVer = this.getAttribute("data-campania");
    window.location.href = 'http://www.ineedserv.com/ineed/web/index.php?r=site/contenido_campania&id_cam='+keyCampaniaAVer+'&id_emp='+id_emp+'&tip='+tipo_empresa;
    //alert('Aca enviamos a otro lugar para mostrar la empresa:'+keyEmpresaAVer);
    //var refEmpresaAVer = refEmpresas.child(keyEmpresaABorrar);
    //refEmpresaABorrar.remove();
}


