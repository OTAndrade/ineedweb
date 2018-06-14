
window.onload = inicializar;
var formFarmacias;
var refFarmacias;
var tbodyFarmacias;
var CREATE ="Añadir Farmacia";
var UPDATE ="Modificar Farmacia";
var modo = CREATE;
var refFarmaciaAEditar;


function inicializar(){
    formFarmacias = document.getElementById("form-farmacia");
    
    formFarmacias.addEventListener("submit", enviarFarmaciasFirebase, false);
    
    tbodyFarmacias = document.getElementById("tbody-farmacias");
    
    refFarmacias= firebase.database().ref().child("Farmacias");

    mostrarFarmaciasFirebase();
}


// GRABA EN FIREBASE POR CREACION y POR UPDATE
function enviarFarmaciasFirebase(event){
    //alert("hola Gon");
    event.preventDefault();
    switch(modo){
           case CREATE:
            refFarmacias.push({
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
            refFarmaciaAEditar.update({
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
             document.getElementById("boton-enviar-farmacia").value = CREATE;
           break;
           }
    
    
    formFarmacias.reset();
}
// CARGA LA TABLA PARA MOSTRAR LOS REGISTROS DE LOS Paises (LISTADO)
function mostrarFarmaciasFirebase(){
    refFarmacias.on("value", function(snap){
        var datos = snap.val();
        var filasAMostrar = "";
        for(var key in datos){
            filasAMostrar += "<tr>"+
                "<td>"+ datos[key].Nombre +"</td>"+
                "<td>"+ datos[key].Sigla +"</td>"+
                "<td>"+ datos[key].Estado +"</td>"+
                '<td>' +
                '<button class="btn btn-default editar" data-farmacia="' + key + '">' +
                '<span class="glyphicon glyphicon-pencil"></span>' +
                '</button>' + 
                '</td>'+
                '<td>' +
                '<button class="btn btn-danger borrar" data-farmacia="' + key + '">' +
                '<span class="glyphicon glyphicon-trash"></span>' +
                '</button>' + 
                '</td>'+
                '<td>' +
                '<button class="btn btn-info ver" data-farmacia="' + key + '">' +
                '<span class="glyphicon glyphicon-search"></span>' +
                '</button>' + 
                '</td>'+
                "<tr>";
        }
       tbodyFarmacias.innerHTML = filasAMostrar; 
        if(filasAMostrar != ""){
            var elementosEditables = document.getElementsByClassName("editar");
            for(var i=0; i< elementosEditables.length; i++){
                elementosEditables[i].addEventListener("click", editarFarmaciaFirebase,false);
            }
            
            var elementosBorrables = document.getElementsByClassName("borrar");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosBorrables[i].addEventListener("click", borraFarmaciaFirebase,false);
            }

            var elementosVisibles = document.getElementsByClassName("ver");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosVisibles[i].addEventListener("click", verFarmaciaFirebase,false);
            }
        }
    });
}

// OBTIENE LOS DATOS DE UNA Pais PARA EDICION DE CAMPOS
function editarFarmaciaFirebase(){
    var keyFarmaciaAEditar = this.getAttribute("data-farmacia");
    refFarmaciaAEditar = refFarmacias.child(keyFarmaciaAEditar);
    refFarmaciaAEditar.once("value", function(snap){
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
    document.getElementById("boton-enviar-farmacia").value = UPDATE;
    modo = UPDATE;
}

// ELIMINA UNA EMPRESA
function borraFarmaciaFirebase(){
    var keyFarmaciaABorrar = this.getAttribute("data-farmacia");
    var refFarmaciaABorrar = refFarmacias.child(keyFarmaciaABorrar);
    refFarmaciaABorrar.remove();
}

// VER y ADMINISTRAR LOS DATOS DE UNA EMPRESA FARMACEUTICA
function verFarmaciaFirebase(){
    var keyFarmaciaAVer = this.getAttribute("data-farmacia");
    window.location.href = 'http://www.ineedserv.com/ineed/web/index.php?r=site/farmacia&far='+keyFarmaciaAVer;
    //alert('Aca enviamos a otro lugar para mostrar la empresa:'+keyEmpresaAVer);
    //var refEmpresaAVer = refEmpresas.child(keyEmpresaABorrar);
    //refEmpresaABorrar.remove();
}
