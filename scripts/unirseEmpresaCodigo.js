const formularioUnionEmpresa=document.getElementById('formularioUnionEmpresa');
const mensajeUnionGrupoConCodigo=document.getElementById('mensaje-union-grupo');
const UnirseAUnaEmpresa=()=>{
    const datosFormulario=new FormData(formularioUnionEmpresa);
    fetch('../backend/RegistrarEstudianteEnEmpresa.php',{
        method:'POST',
        body:datosFormulario}).then(res=>res.json())
        .then(data=>{
            mensajeUnionGrupoConCodigo.innerHTML=data;
          
        
        })
    } 

formularioUnionEmpresa.addEventListener('submit',(e)=>{
e.preventDefault();
UnirseAUnaEmpresa();
});



