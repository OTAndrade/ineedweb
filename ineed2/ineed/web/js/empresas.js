
window.onload = inicializar;
var formEmpresas;
var refEmpresas;
var tbodyEmpresas;
var CREATE ="Añadir Empresa";
var UPDATE ="Modificar Empresa";
var modo = CREATE;
var refEmpresaAEditar;


function inicializar(){
    formEmpresas = document.getElementById("form-empresa");
    
    formEmpresas.addEventListener("submit", enviarEmpresasFirebase, false);
    
    tbodyEmpresas = document.getElementById("tbody-empresas");
    
    refEmpresas= firebase.database().ref().child("Empresas");

    mostrarEmpresasFirebase();
}


// GRABA EN FIREBASE POR CREACION y POR UPDATE
function enviarEmpresasFirebase(event){
    //alert("hola Gon");
    event.preventDefault();
    switch(modo){
           case CREATE:
            refEmpresas.push({
               Nombre: event.target.nombre.value, 
               Sigla: event.target.sigla.value, 
               Logo: event.target.logo.value,
               
               Direccion: event.target.direccion.value,
               Telefono: event.target.telefono.value,
               Web: event.target.web.value,
               Mail: event.target.mail.value,
               Mail: event.target.mail.value,
               Facebook: event.target.facebook.value,
               Twitter: event.target.twitter.value,


               Estado: event.target.estado.value 
            });
           break;
           
           case UPDATE:
            refEmpresaAEditar.update({
               Nombre: event.target.nombre.value, 
               Sigla: event.target.sigla.value, 
               Logo: event.target.logo.value,
               Direccion: event.target.direccion.value,
               Telefono: event.target.telefono.value,
               Web: event.target.web.value,
               Mail: event.target.mail.value,
               Mail: event.target.mail.value,
               Facebook: event.target.facebook.value,
               Twitter: event.target.twitter.value,
               Estado: event.target.estado.value 
            });
            modo = CREATE;
             document.getElementById("boton-enviar-empresa").value = CREATE;
           break;
           }
    
    
    formEmpresas.reset();
}
// CARGA LA TABLA PARA MOSTRAR LOS REGISTROS DE LOS Paises (LISTADO)
function mostrarEmpresasFirebase(){
    refEmpresas.on("value", function(snap){
        var datos = snap.val();
        var filasAMostrar = "";
        for(var key in datos){
            filasAMostrar += "<tr>"+
                "<td>"+ datos[key].Nombre +"</td>"+
                "<td>"+ datos[key].Sigla +"</td>"+
                "<td>"+ datos[key].Estado +"</td>"+
                '<td>' +
                '<button class="btn btn-default editar" data-empresa="' + key + '">' +
                '<span class="glyphicon glyphicon-pencil"></span>' +
                '</button>' + 
                '</td>'+
                '<td>' +
                '<button class="btn btn-danger borrar" data-empresa="' + key + '">' +
                '<span class="glyphicon glyphicon-trash"></span>' +
                '</button>' + 
                '</td>'+
                '<td>' +
                '<button class="btn btn-info ver" data-empresa="' + key + '">' +
                '<span class="glyphicon glyphicon-search"></span>' +
                '</button>' + 
                '</td>'+
                "<tr>";
        }
       tbodyEmpresas.innerHTML = filasAMostrar; 
        if(filasAMostrar != ""){
            var elementosEditables = document.getElementsByClassName("editar");
            for(var i=0; i< elementosEditables.length; i++){
                elementosEditables[i].addEventListener("click", editarEmpresaFirebase,false);
            }
            
            var elementosBorrables = document.getElementsByClassName("borrar");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosBorrables[i].addEventListener("click", borraEmpresaFirebase,false);
            }

            var elementosVisibles = document.getElementsByClassName("ver");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosVisibles[i].addEventListener("click", verEmpresaFirebase,false);
            }
        }
    });
}

// OBTIENE LOS DATOS DE UNA Pais PARA EDICION DE CAMPOS
function editarEmpresaFirebase(){
    var keyEmpresaAEditar = this.getAttribute("data-empresa");
    refEmpresaAEditar = refEmpresas.child(keyEmpresaAEditar);
    refEmpresaAEditar.once("value", function(snap){
        var datos = snap.val();
       document.getElementById("nombre").value = datos.Nombre;  
       document.getElementById("sigla").value = datos.Sigla;  
       document.getElementById("direccion").value = datos.Direccion;  
       document.getElementById("telefono").value = datos.Telefono;  
       document.getElementById("web").value = datos.Web;  
       document.getElementById("mail").value = datos.Mail;  
       document.getElementById("facebook").value = datos.Facebook;  
       document.getElementById("twitter").value = datos.Twitter;  
       document.getElementById("estado").value = datos.Estado;  
    });
    document.getElementById("boton-enviar-empresa").value = UPDATE;
    modo = UPDATE;
}

// ELIMINA UNA EMPRESA
function borraEmpresaFirebase(){
    var keyEmpresaABorrar = this.getAttribute("data-empresa");
    var refEmpresaABorrar = refEmpresas.child(keyEmpresaABorrar);
    refEmpresaABorrar.remove();
}

// VER y ADMINISTRAR LOS DATOS DE UNA EMPRESA FARMACEUTICA
function verEmpresaFirebase(){
    var keyEmpresaAVer = this.getAttribute("data-empresa");
    window.location.href = 'http://www.ineedserv.com/ineed/web/index.php?r=site/empresa&emp='+keyEmpresaAVer;
    //alert('Aca enviamos a otro lugar para mostrar la empresa:'+keyEmpresaAVer);
    //var refEmpresaAVer = refEmpresas.child(keyEmpresaABorrar);
    //refEmpresaABorrar.remove();
}
