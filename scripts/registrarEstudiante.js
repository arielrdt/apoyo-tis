//@param formulario: formulario html del documento
//@param espacioMensaje: div del documento
let formulario=document.getElementById('formulario');
let espacioMensaje=document.getElementById('espacio-mensaje');

//funcion para validar el nombre
const validarNombre=(nombreEstudiante)=>{
    let patron = new RegExp("^[a-zA-Zñáéíóú ]+$ ?");
    return !!patron.test(nombreEstudiante);}
//funcion para validar el tamaño del nombre
const validarTamanioNombre=(nombreEstudiante)=>{return (nombreEstudiante.length>1 && nombreEstudiante.length<20);}
//funcion para validar el apellido paterno
const validarApellidoP=(apellidoPaternoEstudiante)=>{
    let patron = new RegExp("^[a-zA-Zñáéíóú]+$ ?");
    return !!patron.test(apellidoPaternoEstudiante);}
//funcion para validar la cantidad de caracteres del apellido paterno
const validarTamanioApellidoP=(apellidoPaternoEstudiante)=>{return (apellidoPaternoEstudiante.length>1 && apellidoPaternoEstudiante.length<15);}

//funcion para validar el apellido materno
const validarApellidoM=(apellidoMaternoEstudiante)=>{
    let patron = new RegExp("^[a-zA-Zñáéíóú]+$ ?");
    return !!patron.test(apellidoMaternoEstudiante);}
//funcion para validar la cantidad de caracteres del apellido materno
const validarTamanioApellidoM=(apellidoMaternoEstudiante)=>{return (apellidoMaternoEstudiante.length>1 && apellidoMaternoEstudiante.length<15);}
//funcion para validar el carnet
const validarCarnet=(carnetEstudiante)=>{
    let patron = new RegExp("^[0-9]+$ ?");
    return !!patron.test(carnetEstudiante);}
//funcion para validar la cantidad de caracteres del carnet
const validarTamanioCarnet=(carnetEstudiante)=>{return (carnetEstudiante.length>5 && carnetEstudiante.length<7);}

//funcion para validar el cod sis
const validarCodSis=(codigoSisEstudiante)=>{
    let patron = new RegExp("^[0-9]+$ ?");
    return !!patron.test(codigoSisEstudiante);}
    //funcion para validar la cantidad de caracteres del cod sis
const validarTamanioCodSis=(codigoSisEstudiante)=>{return (codigoSisEstudiante.length==9);}
//funcion para validar el correo electronico
const validarCorreo=(correoEstudiante)=>{
    let patron = new RegExp("^[0-9]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z]+)*$");
    return !!patron.test(correoEstudiante);}

//funcion para validar la cantidad de caracteres del correo electronico
const validarTamanioCorreo=(correoEstudiante)=>{return (correoEstudiante.length==22);}

//funcion para validar la carrera
const validarCarrera=(carrera)=>{
    let patron = new RegExp("^[a-zA-Zñáéíóú ]+$ ?");
    return !!patron.test(carrera);}
//funcion para validar la cantidad de carcteres de la carrera
const validarTamanioCarrera=(carrera)=>{return (carrera.length>5 && carrera.length<25);}

//funcion para validar la contraseña
const validarContrasenia=(contrasenaEstudiante)=>{
    let patron = new RegExp("^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$");
    return !!patron.test(contrasenaEstudiante);}

//funcion para enviar los datos a la base de datos 
const subirDatos=()=>{
    //@param datosFormulario:el contenido del formulario 
    //@param validoParaSubir:cambia a false si no se cumplen las validaciones
    let datosFormulario=new FormData(formulario);
    let validoParaSubir=true;
    espacioMensaje.innerHTML="";

    if(datosFormulario.get('nombreEstudiante')=='')
    {validoParaSubir=false;
    console.log(validoParaSubir);
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Llenar todos los campos</p>';
    }

    if(!validarNombre(datosFormulario.get('nombreEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El nombre no puede contener caracteres especiales, ni numeros</p>' }    

    if(!validarTamanioNombre(datosFormulario.get('nombreEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El nombre no puede tener mas de 20 caracteres</p>' }  

    if(!validarApellidoP(datosFormulario.get('apellidoPaternoEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El apellido paterno no puede contener caracteres especiales, ni numeros</p>' }    

    if(!validarTamanioApellidoP(datosFormulario.get('apellidoPaternoEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El apellido paterno no puede tener mas de 15 caracteres</p>' }    

    if(!validarApellidoM(datosFormulario.get('apellidoMaternoEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El apellido materno no puede contener caracteres especiales, ni numeros</p>' }    

    if(!validarTamanioApellidoM(datosFormulario.get('apellidoMaternoEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El apellido materno no puede tener mas de 15 caracteres</p>' }    

    if(!validarCarnet(datosFormulario.get('carnetEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El carnet solo puede contener numeros</p>' }    

    if(!validarTamanioCarnet(datosFormulario.get('carnetEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El carnet debe tener entre 6 y 7 caracteres</p>' }   

    if(!validarCodSis(datosFormulario.get('codigoSisEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El codigo SIS solo puede contener numeros</p>' }    

    if(!validarTamanioCodSis(datosFormulario.get('codigoSisEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El codigo SIS debe tener 9 caracteres</p>' }    

     if(!validarCorreo(datosFormulario.get('correoEstudiante')))
     {validoParaSubir=false; 
     espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Debe ingresar su correo institucional</p>' }    
    
    if(!validarCarrera(datosFormulario.get('carrera')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*La carrera no puede contener caracteres especiales, ni numeros</p>' }    

    if(!validarTamanioCarrera(datosFormulario.get('carrera')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*La carrera debe tener entre 5 y 24 caracteres</p>' } 
    
    if(!validarContrasenia(datosFormulario.get('contrasenaEstudiante')))
    {validoParaSubir=false; 
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*La contraseña debe contener: Letras minúsculas (a-z), letras mayúsculas (A-Z) y números (0-9</p>' }

    if(validoParaSubir){
//se referencia al archivo con la funcion de registrar al estudiante
//se envia los datos del formulario
    fetch('../backend/RegistrarEstudiante.php',{
            method:'POST',
            body:datosFormulario
             }
             )
                .then(res=>res.json())
                .then(data=>{
          //se espera el resutado y se lo agrega al html del mensajes
           if(data=="El pliego ha sido publicado exitosamente"){espacioMensaje.innerHTML+='<p class=mensaje-verde>*'+data+'</p>';}
            else{espacioMensaje.innerHTML+='<p class=mensaje-rojo>*'+data+'</p>';}
        })

    }
 }

    

formulario.addEventListener('submit',(e)=>{
subirDatos();
e.preventDefault();                        });
        