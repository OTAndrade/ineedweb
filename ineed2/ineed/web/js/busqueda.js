
window.onload = inicializar;
var formFiltro;
var refBandeja;
var tbodyBandeja;
var idMedico;

function inicializar(){
    formFiltro = document.getElementById("form-busqueda");
    
    formFiltro.addEventListener("submit", filtrarBandejaFirebase, false);
    
    tbodyBandeja = document.getElementById("tbody-bandeja");
    
    idMedico = document.getElementById("usuario").value;
    
    refBandeja= firebase.database().ref().child("Bandeja");

    mostrarBandejaFirebase();
}


// FILTRA datos anidados en firebase
function filtrarBandejaFirebase(event){
    //alert("hola Gon");
    event.preventDefault();
    //event.target.codigo.value,
    var filasAMostrar = "";

    var query = firebase.database().ref("Bandeja").orderByKey();
	query.once("value")
	  .then(function(snapshot) {
	    snapshot.forEach(function(childSnapshot) {
	      childSnapshot.forEach(function(nieto) {
	      	nieto.forEach(function(bisnieto) {
				var key = bisnieto.key;
				var childData = bisnieto.val();
				var v_estado = childData.estado;
				var v_paciente = childData.nombrePcte;
				var v_idMedico = childData.idDr;
				var filtro = event.target.filtro.value;
				if(idMedico==v_idMedico&&(v_estado.toUpperCase()==filtro.toUpperCase()||v_paciente.toUpperCase()==filtro.toUpperCase()))
				{
					//console.log(childData.nombreDr);
					//console.log(key);
					//console.log(childData);
					filasAMostrar += "<tr>"+
		                "<td>"+ childData.nombreDr +"</td>"+
		                "<td>"+ dateFormat(childData.fechaSolicitud, "dddd, mmmm dS, yyyy, h:MM:ss TT") +"</td>"+
		                "<td>"+ childData.nombrePcte +"</td>"+
		                "<td>"+ dateFormat(childData.fechaAceptacion, "dddd, mmmm dS, yyyy, h:MM:ss TT") +"</td>"+
		                "<td>"+ dateFormat(childData.fechaConfirmacion, "dddd, mmmm dS, yyyy, h:MM:ss TT") +"</td>"+
		                "<td>"+ childData.estado +"</td>"+
	                "<tr>";
            	}
			});
	      });
	  }

	  );
	    tbodyBandeja.innerHTML = filasAMostrar; 
	});
    
    
    //formFiltro.reset();
}
// CARGA LA TABLA PARA MOSTRAR LOS REGISTROS DE solicitudes
function mostrarBandejaFirebase(){
    var filasAMostrar = "";

    var query = firebase.database().ref("Bandeja").orderByKey();
	query.once("value")
	  .then(function(snapshot) {
	    snapshot.forEach(function(childSnapshot) {
	      childSnapshot.forEach(function(nieto) {
	      	nieto.forEach(function(bisnieto) {
				var key = bisnieto.key;
				var childData = bisnieto.val();
				var v_estado = childData.estado;
				var v_paciente = childData.nombrePcte;
				var v_idMedico = childData.idDr;
				//var filtro = event.target.filtro.value;
				if(idMedico==v_idMedico)
				{
					filasAMostrar += "<tr>"+
		                "<td>"+ childData.nombreDr +"</td>"+
		                "<td>"+ dateFormat(childData.fechaSolicitud, "dddd, mmmm dS, yyyy, h:MM:ss TT") +"</td>"+
		                "<td>"+ childData.nombrePcte +"</td>"+
		                "<td>"+ dateFormat(childData.fechaAceptacion, "dddd, mmmm dS, yyyy, h:MM:ss TT") +"</td>"+
		                "<td>"+ dateFormat(childData.fechaConfirmacion, "dddd, mmmm dS, yyyy, h:MM:ss TT") +"</td>"+
		                "<td>"+ childData.estado +"</td>"+
	                "<tr>";
            	}
			});
	      });
	  }

	  );
	    tbodyBandeja.innerHTML = filasAMostrar; 
	});

    
}


