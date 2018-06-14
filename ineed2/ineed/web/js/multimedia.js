
window.onload = inicializar;
var formTexto;
var refCampanias;
var id_cam;
var refCampaniaEditar;
var refCampanias;
var tbodyImagenes;
var refImagenesFiltradas;
var refImagenes;

function inicializar(){
    formTexto = document.getElementById("form-texto");
    id_cam = document.getElementById("id_cam").value;
    
    //formAsociados.addEventListener("submit", enviarAsociadosFirebase, false);
    formTexto.addEventListener("submit", actualizarTextoFirebase, false);
    tbodyImagenes = document.getElementById("tbody-imagenes");
    refImagenesFiltradas= firebase.database().ref().child("CampaniaImagen").orderByChild('id_campania').equalTo(id_cam); // Aca hay q filtrar de la empresa actual
    //refCampaniaFiltrada= firebase.database().ref().child("Campanias").orderByChild('id_campania').equalTo(id_cam); // Aca hay q filtrar de la empresa actual
    refCampanias= firebase.database().ref().child("Campanias");
    refImagenes= firebase.database().ref().child("CampaniaImagen");
    refCampaniaEditar = refCampanias.child(id_cam);
    refCampaniaEditar.once("value", function(snap){
        var datos = snap.val();
       document.getElementById("texto").value = datos.texto;  
    });
    mostrarImagenesFirebase();

}
// GRABA EN FIREBASE POR UPDATE
function actualizarTextoFirebase(event){
    event.preventDefault();
	refCampaniaEditar.update({
		texto: event.target.texto.value
	});
	alert('Se actualizo el texto correctamente');
}

function mostrarImagenesFirebase()
{
	refImagenesFiltradas.on("value", function(snap){
        var datos = snap.val();
        var filasAMostrar = "";
        for(var key in datos){
            filasAMostrar += "<tr>"+
                "<td><img class='img-rounded' src="+datos[key].imagen +" height='120' width='120'></td>"+
                "<td>"+ datos[key].fecha_upload+"</td>"+
                '<td>' +
                '<button class="btn btn-danger borrar" data-imagen="' + key + '">' +
                '<span class="glyphicon glyphicon-trash"></span>' +
                '</button>' + 
                '</td>'+
                "<tr>";
        }
       tbodyImagenes.innerHTML = filasAMostrar; 
        if(filasAMostrar != ""){
            var elementosBorrables = document.getElementsByClassName("borrar");
            for(var i=0; i< elementosBorrables.length; i++){
                elementosBorrables[i].addEventListener("click", borraImagenFirebase,false);
            }
        }
    });
}
function borraImagenFirebase(){
    var keyImagenBorrar = this.getAttribute("data-imagen");
    var refImagenBorrar = refImagenes.child(keyImagenBorrar);
    refImagenBorrar.remove();
}



