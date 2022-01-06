//@param formularioUnionEmpresa=formulario del documento que contiene el codigo del grupo
//@param mensajeUnionGrupoConCodigo=div del documento con el mensaje 
const formularioUnionEmpresa=document.getElementById('formularioUnionEmpresa');
const mensajeUnionGrupoConCodigo=document.getElementById('mensaje-union-grupo');
//funcion para unirse a una emprese con un codigo
const UnirseAUnaEmpresa=()=>{
   //@param datosFormulario: contenido del formulario
    const datosFormulario=new FormData(formularioUnionEmpresa);
    //se referencia al archivo con la funcion de recuperar los grupos
    fetch('../backend/RegistrarEstudianteEnEmpresa.php',{
        method:'POST',
        body:datosFormulario}).then(res=>res.json())
    //se captura y se insertan los datos en campo de mensaje
        .then(data=>{
            mensajeUnionGrupoConCodigo.innerHTML=data;
          
        
        })
    } 

formularioUnionEmpresa.addEventListener('submit',(e)=>{
e.preventDefault();
UnirseAUnaEmpresa();
});



