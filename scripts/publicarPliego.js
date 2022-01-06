/*Recuperda los datos del formulario
almacena los datos en distintas variables
 */
let formulario=document.getElementById('formulario');
let semestre1=document.getElementById('1erSemestre');
let semestre2=document.getElementById('2doSemestre');
let semestreAnioActual=document.getElementById("semestre-plie");
//Recoge el a;o y fecha actual a la que estamos
let anio=(new Date).getFullYear();
let mes=(new Date).getMonth();
let espacioMensaje=document.getElementById('espacio-mensaje');
let espacioMensajeT=document.getElementById('espacio-mensajet');
let espacioMensajeS=document.getElementById('espacio-mensajes');
let espacioMensajeD=document.getElementById('espacio-mensajed');
let semestreAnioSistema='';
//calcula el semestre actual segun la fecha actual
function obtenerGestionSistema(){
    if(mes<6){semestreAnioSistema="1-"+anio;}
    else{semestreAnioSistema="2-"+anio;}
    console.log(semestreAnioSistema)
}
obtenerGestionSistema();


//asigna el semestre actual automaticamente
const asignarSemestresAnio=()=>{
    if(mes<6){semestreAnioActual.innerHTML="1-"+anio;}
    else{semestreAnioActual.innerHTML="2-"+anio;}
  }


//verifica que el titulo solo contenga letras, numeros, comas, puntos entre otros simbolos
const validarTitulo=(titulo)=>{
    let patron = new RegExp("^[a-z||A-Z||0-9][a-zA-Z_.,:;\t\h\r\n\<br />]+"); 
    //return !!patron.test(titulo);
    return true}

//selecciona el semestre actual    
const semestreValido=(estado1Semestre,estado2semestre)=>{return(estado1Semestre=='on'||estado2semestre=='on');}


//verifica que la descripcion no contenga caracteres especiales como @,$,%, etc
const validarDescripcion=(descripcion)=>{
    let patron = new RegExp("^[a-z||A-Z||0-9][a-zA-Z_.,:;\t\h\r\n\<br />]+"); 
    return !!patron.test(descripcion);}


//verifica que el titulo sea mayor a 4 caracteres, pero no mayos a 36
const validarTamanioTitulo=(titulo)=>{return (titulo.length>4 && titulo.length<36);}

//verifica que la descripcion no sea mayor a 501 caracteres
const validarTamanioDescripcion=(descripcion)=>{return (descripcion.length<501);}

//comprueba los datos del formulario
const subirDatos=()=>{

    let datosFormulario=new FormData(formulario);
    
    let validoParaSubir=true;
    espacioMensaje.innerHTML="";    

  
    /* --- Metodos que envian un mensaje en caso de que algun campo tenga un dato erroneo ---- */
    if(datosFormulario.get('titulo')=='')
    {validoParaSubir=false;
    espacioMensajeT.innerHTML='<p class=mensaje-rojo>*Llenar todos los campos</p>';
    }

    if(datosFormulario.get('descripcion')=='')
    {validoParaSubir=false;
    espacioMensajeD.innerHTML='<p class=mensaje-rojo>*La decripcion no puede estar vacia</p>';
    }

    if(!validarTamanioTitulo(datosFormulario.get('titulo')))
    {validoParaSubir=false;
     espacioMensajeT.innerHTML='<p class=mensaje-rojo>*El titulo debe contener entre 5 y 35 caracteres</p>';}

    if(!validarTamanioDescripcion(datosFormulario.get('descripcion')))
    {validoParaSubir=false;    
     espacioMensajeD.innerHTML='<p class=mensaje-rojo>*La descripcion debe contener entre 100 y 500 caracteres</p>';}
/*--------------------- */


//En caso de que no exista campos invalidos, se envia la informacion al archivo php para 
//ser almacenado en la base de datos
    if(validoParaSubir){
             
            fetch('../backend/publicarPliego.php',{
            method:'POST',
            body:datosFormulario
            })
            .then(res=>res.json())
            .then(data=>{
                if(data!=null){
                    
                    espacioMensaje.innerHTML+='<p class=mensaje-verde>'+data+'</p>';
                    let archivo=($('#pdf-pli'))[0].files[0];
                    let ubicacion=storage.ref('/pliegos/'+datosFormulario.get("titulo")+"-"+semestreAnioSistema+'.pdf');
                    let tareaSubida=ubicacion.put(archivo);
                }
         else{espacioMensaje.innerHTML+='<p class=mensaje-rojo>*'+data+'</p>';}

        })
    }


}



asignarSemestresAnio();

formulario.addEventListener('submit',(e)=>{
subirDatos();
e.preventDefault();
}
);
//verifica que el usuario sea un docente

const verificarLogeo=()=>{
    fetch('../backend/verificarLogeoDocente.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>{
        if(!mensaje){window.location.href ='./index.html';}})
}





