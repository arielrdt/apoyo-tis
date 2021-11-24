const formularioUnionEmpresa=document.getElementById('formularioUnionEmpresa');

const UnirseAUnaEmpresa=()=>{
    const formulario=document.getElementById('formularioUnionEmpresa');
    const datosFormulario=new FormData(formulario);
    fetch('../backend/RegistrarEstudianteEnEmpresa.php',{
        method:'POST',
        body:datosFormulario}).then(res=>res.json())
        .then(data=>{console.log(data);})
    } 

formularioUnionEmpresa.addEventListener('submit',(e)=>{
e.preventDefault();
UnirseAUnaEmpresa();
});



