
window.onload = inicializar;
var formPaises;
var refPaises;
var tbodyPaises;
var CREATE ="Añadir Pais";
var UPDATE ="Modificar Pais";
var modo = CREATE;
var refPaisAEditar;


function inicializar(){
    formPaises = document.getElementById("form-pais");
    
    formPaises.addEventListener("submit", enviarPaisesFirebase, false);
    
    tbodyPaises = document.getElementById("tbody-paises");
    
    refPaises= firebase.database().ref().child("Paises");

    mostrarPaisesFirebase();
}


// GRABA EN FIREBASE POR CREACION y POR UPDATE
function enviarPaisesFirebase(event){
    //alert("hola Gon");
    event.preventDefault();
    switch(modo){
           case CREATE:
            refPaises.push({
               Codigo: event.target.codigo.value, 
               Nombre: event.target.nombre.value, 
               Prefijo: event.target.prefijo.value 
            });
           break;
           
           case UPDATE:
            refPaisAEditar.update({
               Codigo: event.target.codigo.value, 
               Nombre: event.target.nombre.value, 
               Prefijo: event.target.prefijo.value 
            });
            modo = CREATE;
             document.getElementById("boton-enviar-pais").value = CREATE;
           break;
           }
    
    
    formPaises.reset();
}
// CARGA LA TABLA PARA MOSTRAR LOS REGISTROS DE LOS Paises (LISTADO)
function mostrarPaisesFirebase(){
    refPaises.on("value", function(snap){
        var datos = snap.val();
        var filasAMostrar = "";
        for(var key in datos){
            filasAMostrar += "<tr>"+
                "<td>"+ datos[key].Codigo +"</td>"+
                "<td>"+ datos[key].Nombre +"</td>"+
                "<td>"+ datos[key].Prefijo +"</td>"+
                '<td>' +
                '<button class="btn btn-default editar" data-pais="' + key + '">' +
                '<span class="glyphicon glyphicon-pencil"></span>' +
                '</button>' + 
                '</td>'+
                '<td>' +
                '<button class="btn btn-danger borrar" data-pais="' + key + '">' +
                '<span class="glyphicon glyphicon-trash"></span>' +
                '</button>' + 
                '</td>'+
                "<tr>";
        }
       tbodyPaises.innerHTML = filasAMostrar; 
        if(filasAMostrar != ""){
            var elementosEditables = document.getElementsByClassName("editar");
            for(var i=0; i< elementosEditables.length; i++){
                elementosEditables[i].addEventListener("click", editarPaisFirebase,false);
            }
            
            var elementosBorrables = document.getElementsByClassName("borrar");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosBorrables[i].addEventListener("click", borraPaisFirebase,false);
            }
        }
    });
}

// OBTIENE LOS DATOS DE UNA Pais PARA EDICION DE CAMPOS
function editarPaisFirebase(){
    var keyPaisAEditar = this.getAttribute("data-pais");
    refPaisAEditar = refPaises.child(keyPaisAEditar);
    refPaisAEditar.once("value", function(snap){
        var datos = snap.val();
       document.getElementById("codigo").value = datos.Codigo;  
       document.getElementById("nombre").value = datos.Nombre;  
       document.getElementById("prefijo").value = datos.Prefijo;  
    });
    document.getElementById("boton-enviar-pais").value = UPDATE;
    modo = UPDATE;
}

// ELIMINA UNA Pais
function borraPaisFirebase(){
    var keyPaisABorrar = this.getAttribute("data-pais");
    var refPaisABorrar = refPaises.child(keyPaisABorrar);
    refPaisABorrar.remove();
}
