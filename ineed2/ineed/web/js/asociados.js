
window.onload = inicializar;
var formAsociados;
var refAsociados;
var refAsociadosFiltrados;
var refPaises;
var tbodyAsociados;
var CREATE ="Crear ";
var UPDATE ="Modificar";
var modo = CREATE;
var refAsociadoAEditar;

function inicializar(){
    formAsociados = document.getElementById("form-asociados");
    comboPaises = document.getElementById("pais");
    
    //formAsociados.addEventListener("submit", enviarAsociadosFirebase, false);
    formAsociados.addEventListener("submit", enviarAsociadosFirebase, false);
    
    //tbodyMedicos = document.getElementById("tbody-medicos");
    tbodyAsociados = document.getElementById("tbody-usuarios-asociados");
    var id_emp=document.getElementById("id_empresa").value;
    refAsociadosFiltrados= firebase.database().ref().child("Asociados").orderByChild('id_empresa').equalTo(id_emp); // Aca hay q filtrar de la empresa actual
    refAsociados= firebase.database().ref().child("Asociados"); // Aca hay q filtrar de la empresa actual
    refPaises= firebase.database().ref().child("Paises");
    mostrarPaisesFirebase();

    mostrarAsociadosFirebase();
}

// CARGA LA TABLA PARA MOSTRAR LOS REGISTROS DE LOS Paises (LISTADO)
function mostrarAsociadosFirebase(){
    refAsociadosFiltrados.on("value", function(snap){
        var datos = snap.val();
        var filasAMostrar = "";
        for(var key in datos){
            filasAMostrar += "<tr>"+
                "<td>"+ datos[key].nombre +"</td>"+
                "<td>"+ datos[key].correo +"</td>"+
                "<td>"+ datos[key].estado +"</td>"+
                "<td>"+ datos[key].contrasenia +"</td>"+
                '<td>' +
                '<button class="btn btn-default editar" data-asociado="' + key + '">' +
                '<span class="glyphicon glyphicon-pencil"></span>' +
                '</button>' + 
                '</td>'+
                '<td>' +
                '<button class="btn btn-danger borrar" data-asociado="' + key + '">' +
                '<span class="glyphicon glyphicon-trash"></span>' +
                '</button>' + 
                '</td>'+
                '<td>' +
                '<button class="btn btn-info mail" data-asociado="' + key + '">' +
                '<span class="glyphicon glyphicon-envelope"></span>' +
                '</button>' + 
                '</td>'+
                "<tr>";
        }
       tbodyAsociados.innerHTML = filasAMostrar; 
        if(filasAMostrar != ""){
            var elementosEditables = document.getElementsByClassName("editar");
            for(var i=0; i< elementosEditables.length; i++){
                elementosEditables[i].addEventListener("click", editarAsociadoFirebase,false);
            }
            
            var elementosBorrables = document.getElementsByClassName("borrar");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosBorrables[i].addEventListener("click", borraAsociadoFirebase,false);
            }

            var elementosVisibles = document.getElementsByClassName("mail");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosVisibles[i].addEventListener("click", mailAsociadoFirebase,false);
            }
        }
    });
}

// GRABA EN FIREBASE POR CREACION y POR UPDATE
function enviarAsociadosFirebase(event){
    // A soliciud de Oscar primero generamos el auth
    //var email = event.target.correo.value;

    //console.log(email);
    event.preventDefault();
    var Clave = cadenaAleatoria(6,'1234567890');                // GENERA LA CLAVE  de 4 caracteres (solo numeros)
    var Estado = 'AC';
    switch(modo){
           case CREATE:
		      	{
			      	refAsociados.push({
			         pais: event.target.pais.value, 
			         instancia: event.target.instancia.value, 
			         nombre: event.target.nombre.value, 
			         correo: event.target.correo.value, 
			         tipoUsuario: event.target.tipoUsuario.value,
			         id_empresa: event.target.id_empresa.value,
			         nombre_empresa: event.target.nombre_empresa.value,
			         estado: Estado,
			         //fbUid: user.uid, 
			         contrasenia: Clave
			      	});
			      	console.log('Ingreso a la creacion');
			     }

      		break;
      		case UPDATE:
      			{
	      			refAsociadoAEditar.update({
	      				pais: event.target.pais.value, 
			         	instancia: event.target.instancia.value, 
			         	nombre: event.target.nombre.value, 
	      			});
	      			modo = CREATE;
	             	document.getElementById("boton-enviar-asociado").value = CREATE;
	             	console.log('Ingreso a UPDATE');
	            }
      		break;
      	}
      // Reseteo el formulario
      console.log('antes del reset');
      formAsociados.reset();
      console.log('despues del reset');
      //window.location.href = 'http://www.ineedserv.com/ineed/web/index.php?r=site/empresa&emp='+event.target.id_empresa.value;

}

function cadenaAleatoria(longitud, caracteres) {     
  longitud = longitud || 16;     
  caracteres = caracteres || "0123456789abcdefghijklmnopqrstuvwxyz";     
  var cadena = "";     
  var max = caracteres.length-1;     
  for (var i = 0; i<longitud; i++) {         
    cadena += caracteres[ Math.floor(Math.random() * (max+1)) ];
  }     
  return cadena; 
}

// CARAGMOS EL COMBO DE PAISES DESDE FIREBASE
function mostrarPaisesFirebase(){
  refPaises.on("value", function(snap){
        var datos = snap.val();
        var filasAMostrar = "";
        for(var key in datos){
            filasAMostrar += 
                '<option value="'+datos[key].Prefijo+'">'+ datos[key].Nombre +"</option>";
        }
       comboPaises.innerHTML = filasAMostrar; 
        
    });
}

// OBTIENE LOS DATOS DE UNA Pais PARA EDICION DE CAMPOS
function editarAsociadoFirebase(){
    var keyAsociadoAEditar = this.getAttribute("data-asociado");
    refAsociadoAEditar = refAsociados.child(keyAsociadoAEditar);
    refAsociadoAEditar.once("value", function(snap){
        var datos = snap.val();
       document.getElementById("nombre").value = datos.nombre;  
       document.getElementById("correo").value = datos.correo;  
       document.getElementById("instancia").value = datos.instancia;  
    });
    document.getElementById("boton-enviar-asociado").value = UPDATE;
    modo = UPDATE;
}

// ELIMINA UNA EMPRESA
function borraAsociadoFirebase(){
    var keyAsociadoABorrar = this.getAttribute("data-asociado");
    var refAsociadoABorrar = refAsociados.child(keyAsociadoABorrar);
    refAsociadoABorrar.remove();
}

// VER y ADMINISTRAR LOS DATOS DE UNA EMPRESA FARMACEUTICA
function mailAsociadoFirebase(){
    var keyAsociadoAVer = this.getAttribute("data-asociado");
    window.location.href = 'http://www.ineedserv.com/ineed/web/index.php?r=site/enviamailasociado&id_aso='+keyAsociadoAVer;
    //alert('Aca enviamos a otro lugar para mostrar la empresa:'+keyEmpresaAVer);
    //var refEmpresaAVer = refEmpresas.child(keyEmpresaABorrar);
    //refEmpresaABorrar.remove();
}

