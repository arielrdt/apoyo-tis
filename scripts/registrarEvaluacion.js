
const formularioRegistrarEvaluacion=document.getElementById('formulario-evaluacion-estudiante0');
const subirEvaluacionEstudiante=()=>{
    
    const datosFormularioEvaluacion=new FormData(formularioRegistrarEvaluacion);
    let validoParaSubir=true;

    if(validoParaSubir){
    fetch('../backend/registrarEvaluacionSemanal.php',{
            method:'POST',
            body:datosFormularioEvaluacion})
                .then(res=>res.json())
                .then(data=>{console.log(data)})
                         }
 }

 formularioRegistrarEvaluacion.addEventListener('submit',(e)=>{subirEvaluacionEstudiante(); e.preventDefault(); });
