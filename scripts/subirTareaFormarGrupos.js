
//@param formulario=formulario del documento que contiene la infomacion de la tarea
let formulario=document.getElementById('formulario');

const subirDatos=()=>{
//@param datosFormulario: contenido del formulario
let datosFormulario=new FormData(formulario);
//@param validoParaSubir: variable para verificar que es valido para subir
let validoParaSubir=true;
if(validoParaSubir){
    //se referencia al archivo con la funcion de crear la tarea
    fetch('../backend/publicarTareaFormarGrupos.php',{
        method:'POST',
        body:datosFormulario
                                                }
         )
        .then(res=>res.json())
        .then(data=>{console.log(data)})
                   }
}

formulario.addEventListener('submit',(e)=>{
e.preventDefault();
subirDatos();
}
);








