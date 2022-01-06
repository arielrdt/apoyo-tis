/*Revisa si un estudiante ya registro o pertenece a una empresa
si ninguna opcion fuera verdadera se le permite crear una nueva empresa
selecciona y almacena los elementos con la id espacio-empresa*/
const campoMiEmpresa=document.getElementById('espacio-empresa');
//si no existiera una empresa, se cargan el formulario para crear una
const crearEmpresa=()=>{
    let formulario=document.getElementById('formulario');
        const subirDatos=()=>
        {   let datosFormulario=new FormData(formulario);
            let validoParaSubir=true;
            if(validoParaSubir)
            {
            fetch('../backend/EstudianteRegistrarEmpresa.php',{method:'POST', body:datosFormulario})
                    .then(res=>res.json())
                    .then(data=>{console.log(data);})
            }
        }
    formulario.addEventListener('submit',(e)=>{subirDatos(); e.preventDefault(); });
}
//controla las acciones disponibles en la pagina
const llenarCampoMiEmpresa=()=>{
fetch('../backend/consultarEstudianteCreoEmpresa.php',{method:'GET'})
.then(res=>res.json())
.then(respuesta=>{
    //si el alumno no pertenece a ninguna empresa se le activan las opciones para crear una
          if(respuesta=="none"){
          campoMiEmpresa.innerHTML='<div class="div-formulario">                                        <form id="formulario" class="formulario">                                               <h1>REGISTRAR GRUPO-EMPRESA</h1>                                                      <h2>Nombre Corto*:</h2>                                                                      <input class="input-titulo" name="nombreCortoEmpresa" type="text" placeholder="Nombre corto de la empresa">                                                                            <h2>Nombre Largo*:</h2>                                                                       <input class="input-titulo" name="nombreLargoEmpresa" type="text" placeholder="Nombre largo de la empresa">                                                                            <h2>Tipo de Sociedad*:</h2>                                                                <input class="input-titulo" name="sociedad" type="text" placeholder="Intoduzca el tipo de sociedad">                                                                                     <h2>Direccion de la empresa:</h2>                                                                                             <input class="input-titulo" name="direccionEmpresa" type="text" placeholder="Intoduzca la direccion">                                                                                 <h2>Telefono:</h2>                                                                          <input class="input-titulo" name="telefonoEmpresa" type="text" placeholder="Intoduzca el telefono de referencia"> <h2>Correo de la empresa*:</h2>                                                                                             <input class="input-titulo" name="correoEmpresa" type="email" placeholder="Intoduzca el correo de la empresa"> <hr><div id="espacio-mensaje"> </div> <hr> <button name="botonFormulario" onclick="crearEmpresa()" >Registrar empresa</button>                                                                                           </form><br><br><br> </div>';
        }
    //si ya pertenece a una empresa, de bloquea la opcion de creacion y aparece el siguiente mensaje
        else{
        campoMiEmpresa.innerHTML='<h2>ya creo una empresa o pertenece a una</h2><br><br> <h2>Codigo de la empresa:</h2>'+respuesta+'<br><br>'; 
            }
})
}
llenarCampoMiEmpresa();