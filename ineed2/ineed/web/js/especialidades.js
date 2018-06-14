
window.onload = inicializar;
var formEspecialidades;
var refEspecialidades;
var tbodyEspecialidades;
var CREATE ="Añadir Especialidad";
var UPDATE ="Modificar Especialidad";
var modo = CREATE;
var refEspecialidadAEditar;


function inicializar(){
    formEspecialidades = document.getElementById("form-especialidad");
    
    formEspecialidades.addEventListener("submit", enviarEspecialidadesFirebase, false);
    
    tbodyEspecialidades = document.getElementById("tbody-especialidades");
    
    refEspecialidades= firebase.database().ref().child("Especialidades");

    mostrarEspecialidadesFirebase();
}


// GRABA EN FIREBASE POR CREACION y POR UPDATE
function enviarEspecialidadesFirebase(event){
    //alert("hola Gon");
    event.preventDefault();
    switch(modo){
           case CREATE:
            refEspecialidades.push({
               Especialidad: event.target.especialidad.value, 
            });
           break;
           
           case UPDATE:
            refEspecialidadAEditar.update({
               Especialidad: event.target.especialidad.value
            });
            modo = CREATE;
             document.getElementById("boton-enviar-especialidad").value = CREATE;
           break;
           }
    
    
    formEspecialidades.reset();
}
// CARGA LA TABLA PARA MOSTRAR LOS REGISTROS DE LAS ESPECIALIDADES (LISTADO)
function mostrarEspecialidadesFirebase(){
    refEspecialidades.on("value", function(snap){
        var datos = snap.val();
        var filasAMostrar = "";
        for(var key in datos){
            filasAMostrar += "<tr>"+
                "<td>"+ datos[key].Especialidad +"</td>"+
                '<td>' +
                '<button class="btn btn-default editar" data-especialidad="' + key + '">' +
                '<span class="glyphicon glyphicon-pencil"></span>' +
                '</button>' + 
                '</td>'+
                '<td>' +
                '<button class="btn btn-danger borrar" data-especialidad="' + key + '">' +
                '<span class="glyphicon glyphicon-trash"></span>' +
                '</button>' + 
                '</td>'+
                "<tr>";
        }
       tbodyEspecialidades.innerHTML = filasAMostrar; 
        if(filasAMostrar != ""){
            var elementosEditables = document.getElementsByClassName("editar");
            for(var i=0; i< elementosEditables.length; i++){
                elementosEditables[i].addEventListener("click", editarEspecialidadFirebase,false);
            }
            
            var elementosBorrables = document.getElementsByClassName("borrar");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosBorrables[i].addEventListener("click", borraEspecialidadFirebase,false);
            }
        }
    });
}

// OBTIENE LOS DATOS DE UNA ESPECIALIDAD PARA EDICION DE CAMPOS
function editarEspecialidadFirebase(){
    var keyEspecialidadAEditar = this.getAttribute("data-especialidad");
    refEspecialidadAEditar = refEspecialidades.child(keyEspecialidadAEditar);
    refEspecialidadAEditar.once("value", function(snap){
        var datos = snap.val();
       document.getElementById("especialidad").value = datos.Especialidad;  
    });
    document.getElementById("boton-enviar-especialidad").value = UPDATE;
    modo = UPDATE;
}

// ELIMINA UNA ESPECIALIDAD
function borraEspecialidadFirebase(){
    var keyEspecialidadABorrar = this.getAttribute("data-especialidad");
    var refEspecialidadABorrar = refEspecialidades.child(keyEspecialidadABorrar);
    refEspecialidadABorrar.remove();
}
