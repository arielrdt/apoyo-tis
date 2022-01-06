  //@param formularioApuntes=formulario del documento que contiene los datos de los apuntes
const formularioApuntes=document.getElementById('formulario-apuntes');
//funcion para subir el apunte a la base de datos
const subirApunte=()=>{
    //@param datosFormularioApuntes: contenido del formulario de apuntes
    const datosFormularioApuntes=new FormData(formularioApuntes);
    let validoParaSubir=true;
    if(validoParaSubir){
        //se referencia al archivo con la funcion de recuperar los grupos
        //se agrega el contenido del formulario
    fetch('../backend/subirApunte.php',{
            method:'POST',
            body:datosFormularioApuntes})
                .then(res=>res.json())
                .then(data=>{
                    //@param mensajeApuntes=div del documento para agregar el mensaje 
                    //se captura y se insertan los datos del mensaje de respuesta
                    const mensajeApuntes=document.getElementById('espacio-mensaje-apunte');
                    mensajeApuntes.innerHTML=data;
                })
                         }
 }

 formularioApuntes.addEventListener('submit',(e)=>{subirApunte(); e.preventDefault(); });

