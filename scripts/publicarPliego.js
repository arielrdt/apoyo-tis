let formulario=document.getElementById('formulario');
let semestre1=document.getElementById('1erSemestre');
let semestre2=document.getElementById('2doSemestre');
let semestreAnioActual=document.getElementById("semestre-plie");
let anio=(new Date).getFullYear();
let mes=(new Date).getMonth();
let espacioMensaje=document.getElementById('espacio-mensaje');
let espacioMensajeT=document.getElementById('espacio-mensajet');
let espacioMensajeS=document.getElementById('espacio-mensajes');
let espacioMensajeD=document.getElementById('espacio-mensajed');
let semestreAnioSistema='';
function obtenerGestionSistema(){
    if(mes<6){semestreAnioSistema="1-"+anio;}
    else{semestreAnioSistema="2-"+anio;}
    console.log(semestreAnioSistema)
}
obtenerGestionSistema();


const asignarSemestresAnio=()=>{
    if(mes<6){semestreAnioActual.innerHTML="1-"+anio;}
    else{semestreAnioActual.innerHTML="2-"+anio;}
  }


const validarTitulo=(titulo)=>{
    let patron = new RegExp("^[a-z||A-Z||0-9][a-zA-Z_.,:;\t\h\r\n\<br />]+"); 
    //return !!patron.test(titulo);
    return true}

const semestreValido=(estado1Semestre,estado2semestre)=>{return(estado1Semestre=='on'||estado2semestre=='on');}


const validarDescripcion=(descripcion)=>{
    let patron = new RegExp("^[a-z||A-Z||0-9][a-zA-Z_.,:;\t\h\r\n\<br />]+"); 
    return !!patron.test(descripcion);}


const validarTamanioTitulo=(titulo)=>{return (titulo.length>4 && titulo.length<36);}

const validarTamanioDescripcion=(descripcion)=>{return (descripcion.length<501);}

const subirDatos=()=>{

    let datosFormulario=new FormData(formulario);
    
    let validoParaSubir=true;
    espacioMensaje.innerHTML="";    

  
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
                    let ubicacion=storage.ref('/pliegos/'+semestreAnioSistema+'.pdf');
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

const verificarLogeo=()=>{
    fetch('../backend/verificarLogeoDocente.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>{
        if(!mensaje){window.location.href ='./index.html';}})
}





