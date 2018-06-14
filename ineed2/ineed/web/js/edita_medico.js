
window.onload = inicializar;
var formMedicos;
var refMedicos;
var refUsuarios;
var idUsuario;

function inicializar(){
    formMedicos = document.getElementById("form-medico");
    idUsuario = document.getElementById("usuario").value;
    formMedicos.addEventListener("submit", actualizaMedicoFirebase, false);
    
    //tbodyMedicos = document.getElementById("tbody-medicos");
    
    refMedicos= firebase.database().ref().child("Ofertantes");
    refUsuarios= firebase.database().ref().child("Usuarios");
    //alert(idUsuario);
}


// GRABA EN FIREBASE POR CREACION y POR UPDATE
function actualizaMedicoFirebase(event){
	event.preventDefault();
	refMedicoAEditar = refMedicos.child(idUsuario);
	refUsuarioAEditar = refUsuarios.child(idUsuario);
	// Actualizamos datos en COLECCION Ofertantes
	refMedicoAEditar.update({
	   Instancia: event.target.instancia.value, 
	   Nombre: event.target.nombre.value, 
	   Direccion: event.target.direccion.value, 
	   DatoServicio: event.target.dato_servicio.value, 
	   RegistroMedico: event.target.numero_registro.value, 
	   Experiencia: event.target.experiencia.value, 
	   Costo: event.target.costo.value, 
	   Clave: event.target.clave.value 
	});
	// Actualizamos datos en COLECCION Usuarios
	refUsuarioAEditar.update({
	   nombre: event.target.nombre.value, 
	   contrasenia: event.target.clave.value 
	});

    alert('Se actualizaron los datos Correctamente');    
}

