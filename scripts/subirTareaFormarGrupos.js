let formulario=document.getElementById('formulario');
const subirDatos=()=>{
let datosFormulario=new FormData(formulario);
let validoParaSubir=true;
if(validoParaSubir){
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








