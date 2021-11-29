const formularioUnionEmpresa=document.getElementById('formularioUnionEmpresa');

const UnirseAUnaEmpresa=()=>{
    const datosFormulario=new FormData(formularioUnionEmpresa);
    fetch('../backend/RegistrarEstudianteEnEmpresa.php',{
        method:'POST',
        body:datosFormulario}).then(res=>res.json())
        .then(data=>{console.log(data);})
    } 

formularioUnionEmpresa.addEventListener('submit',(e)=>{
e.preventDefault();
UnirseAUnaEmpresa();
});



