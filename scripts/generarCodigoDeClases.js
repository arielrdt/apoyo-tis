/*Genera un codigo para la clase del semestre del docente que lo solicite
un docente puede tener solo una clase por semestre
almecena la variable donde se encuentra o estara el codigo de la clase*/
const campoCodigoClase=document.getElementById('espacio-codigo-clase');
//carga el archivo php que genera los codigos de forma aleatoria
const generarCodigoAleatorio=()=>{
    fetch('../backend/crearClaseConNuevoCodigo.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>console.log(mensaje))
}
 
const llenarCampoCodigo=()=>{
//comprobar si puede generar un codigo para este semestre, sino recuperar el ya existente
fetch('../backend/consultarSiSeCreoUnaClase.php',{method:'GET'})
.then(res=>res.json())
.then(respuesta=>{
    //si ya existe una clase para el semestre, se informa y se muestra el codigo actual
          if(respuesta!=null){
               campoCodigoClase.innerHTML='<h2>ya creo una clase para el semestre actual</h2><br><br> <h2>Codigo de la clase:</h2>'+respuesta
    +'<br><br><h4 class="warning">debe compartir el codigo solo con los alumnos inscritos en la materia</h4>';  
                                   }
     //si no existiera una clase, se pide nombre de la clase y se genera el codigo
         else{
          campoCodigoClase.innerHTML='<h3 class="warning"> Todavia no ha creado una clase para el semestre actual</h3><br><h3>Introduzca el nombre de la clase</h3><br><input class="input-titulo" name="titulo" type="text" placeholder="Nombre de la clase"><br><br><button id="botonGeneraCodigo" onclick=generarCodigoAleatorio()>generar un codigo para el semestre actual</button>';
              }
})
}
llenarCampoCodigo();
