const formularioApuntes=document.getElementById('formulario-apuntes');
const subirApunte=()=>{
    const datosFormularioApuntes=new FormData(formularioApuntes);
    let validoParaSubir=true;

    if(validoParaSubir){
    fetch('../backend/subirApunte.php',{
            method:'POST',
            body:datosFormularioApuntes})
                .then(res=>res.json())
                .then(data=>{
                    const mensajeApuntes=document.getElementById('espacio-mensaje-apunte');
                    mensajeApuntes.innerHTML=data;
                })
                         }
 }

 formularioApuntes.addEventListener('submit',(e)=>{subirApunte(); e.preventDefault(); });

