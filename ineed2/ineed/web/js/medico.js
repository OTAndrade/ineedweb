
window.onload = inicializar;
var formMedicos;
var refMedicos;
var refEspecialidades;
var refPaises;
var comboEspecialidades;
var usuarioFirebase;

function inicializar(){
    formMedicos = document.getElementById("form-medico");
    comboEspecialidades = document.getElementById("servicio");
    comboPaises = document.getElementById("pais");
    
    formMedicos.addEventListener("submit", enviarMedicosFirebase, false);
    
    //tbodyMedicos = document.getElementById("tbody-medicos");
    
    refMedicos= firebase.database().ref().child("Ofertantes");
    refEspecialidades= firebase.database().ref().child("Especialidades");
    refPaises= firebase.database().ref().child("Paises");
    mostrarEspecialidadesFirebase();
    mostrarPaisesFirebase();

    //mostrarMedicosFirebase();
}


// GRABA EN FIREBASE POR CREACION y POR UPDATE
function enviarMedicosFirebase(event){
    // A soliciud de Oscar primero generamos el auth
    var email = event.target.correo.value;

    //console.log(email);

    var Clave = cadenaAleatoria(6,'1234567890');                // GENERA LA CLAVE  de 4 caracteres (solo numeros)
    

    firebase.auth().createUserWithEmailAndPassword(email, Clave).then(function(user) {
      //usuarioFirebase= firebase.auth().currentUser;
      //console.log('Entra por createUserWithEmailAndPassword. Aca deberia crear usuario y ofertante');
      //console.log(user);
      //console.log('Los datos en vent son: '+event);
      // Empiezo con la creacion del usuario
      var Estado = 'AC';
      var idofer = '';
      var tip='2';
      event.preventDefault();
      firebase.database().ref("Usuarios/"+user.uid).set({
         pais: event.target.pais.value, 
         instancia: event.target.instancia.value, 
         nombre: event.target.nombre.value, 
         correo: event.target.correo.value, 
         tipoUsuario: tip,
         estado: Estado,
         idOfertante: idofer,
         fbUid: user.uid,
         contrasenia: Clave
      });
      // Ahora creo el Ofertante (Medico en este caso)
      firebase.database().ref("Ofertantes/"+user.uid).set({
         Pais: event.target.pais.value, 
         Instancia: event.target.instancia.value, 
         Nombre: event.target.nombre.value, 
         Correo: event.target.correo.value, 
         Especialidad: event.target.servicio.value, 
         Latitud: event.target.latitud.value, 
         Longitud: event.target.longitud.value, 
         Direccion: event.target.direccion.value, 
         DatoServicio: event.target.dato_servicio.value,
         NumeroRegistro: event.target.numero_registro.value,
         Experiencia: event.target.experiencia.value, 
         Costo: event.target.costo.value,
         Estado: Estado,
         Usuario: user.uid,
         Clave: Clave
      });
      // Reseteo el formulario
      formMedicos.reset();
      // Reenvio para que se envie el correo electronico recien creado
      window.location.href = 'http://www.ineedserv.com/ineed/web/index.php?r=site/mensaje&mail='+email+'&clave='+Clave;


      }, function(error) {
          // Handle Errors here.
          var errorCode = error.code;
          var errorMessage = error.message;
          //usuarioFirebase= firebase.auth().currentUser;
          //console.log('Error en createuserwithEmail y clave');

        });
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
// CARAGMOS EL COMBO DE ESPECIALIDADES DESDE FIREBASE
function mostrarEspecialidadesFirebase(){
  
  /*
  refEspecialidades.on("value", function(snap){
        var datos = snap.val();
        var filasAMostrar = "";
        for(var key in datos){
            filasAMostrar += 
                '<option value="'+datos[key].Especialidad+'">'+ datos[key].Especialidad +"</option>";
        }
       comboEspecialidades.innerHTML = filasAMostrar; 
        
    });
  */
  //Comento el codigo para hacerlo estatico

  var espesEs = [
    "Alergia/Inmunología",
    "Anestesiología",
    "Cardiología",
    "Medicina de Cuidados Intensivos",
    "Dermatología",
    "Medicina de Emergencia",
    "Endocrinología",
    "Medicina Familiar",
    "Gastroenterología",
    "Genética",
    "Geriatría",
    "Hematología/Oncología",
    "Enfermedades Infecciosas",
    "Medicina Interna",
    "Neonatología",
    "Nefrología",
    "Neurología",
    "Neurocirugía",
    "Obstetricia/Ginecología",
    "Cirugía Oncológica",
    "Oftalmología",
    "Ortopedia",
    "Otorrinolaringología",
    "Manejo  del Dolor",
    "Patología",
    "Pediatría",
    "Cirugía Pediátrica",
    "Cirugía Plástica y Reconstructiva",
    "Podiatría",
    "Medicina Preventiva",
    "Psiquiatría",
    "Neumología",
    "Radiología",
    "Endocrinología Reproductiva",
    "Reumatología",
    "Cirugía General",
    "Cirugía Torácica",
    "Urología",
    "Cirugía Vascular"];

  var espesEn = [
    "Allergy/Immunology",
    "Anesthesiology",
    "Cardiology",
    "Intensive Care Medicine",
    "Dermatology",
    "Emergency Medicine",
    "Endocrinology",
    "Family Medicine",
    "Gastroenterology",
    "Genetics",
    "Geriatrics",
    "Hematology / Oncology",
    "Infectious Diseases",
    "Internal Medicine",
    "Neonatology",
    "Nephrology",
    "Neurology",
    "Neurosurgery",
    "Obstetrics/Gynecology",
    "Oncological Surgery",
    "Ophthalmology",
    "Orthopedics",
    "Otorhinolaryngology",
    "Pain Management",
    "Pathology",
    "Pediatrics",
    "Pediatric Surgery",
    "Plastic and Reconstructive Surgery",
    "Podiatry",
    "Preventive Medicine",
    "Psychiatry",
    "Pneumonology",
    "Radiology",
    "Reproductive Endocrinology",
    "Rheumatology",
    "General Surgery",
    "Thoracic Surgery",
    "Urology",
    "Vascular Surgery"];
    var filasAMostrar = "";
    espeLen = espesEn.length
    for (i = 0; i < espeLen; i++) {
      filasAMostrar += 
                '<option value="'+espesEn[i]+'">'+ espesEn[i] +"</option>";
    }
    comboEspecialidades.innerHTML = filasAMostrar; 


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

