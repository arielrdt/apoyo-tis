let formularioModal=document.getElementById('formulario-modalrol');
let datosFormularioModal=new FormData(formularioModal);
const ventanaModal=document.getElementById("modal-rol");
const campoCodigoSis=document.getElementById("codigoSis");
const campoNombre=document.getElementById("nombre");
const campoRol=document.getElementById("rol");
const mensaje=document.getElementById("mensaje");

const abrirModal=()=>{ventanaModal.hidden=false;}

const cerrarModal=()=>{
campoCodigoSis.value="";
campoNombre.value="";
ventanaModal.hidden=true;
}

const editarDatos=(codigoSis,nombre,rol)=>{
campoCodigoSis.value=codigoSis;
campoNombre.value=nombre;
console.log(codigoSis,nombre,rol);
abrirModal();
}

const rolValida=(rol)=>{
    //let patron = new RegExp("^[a-z]^$|[A-Z]");
    //return !!patron.test(rol);
}


const agregarFuncionBotones=()=>{
const botonCancelar=document.getElementById('boton-cancelar');
botonCancelar.addEventListener("click",()=>{cerrarModal();});
formularioModal.addEventListener("submit",(e)=>{
e.preventDefault();
actualizarRolAlumno();
});

}

const actualizarRolAlumno=()=>{
formularioModal=document.getElementById('formulario-modalrol');
datosFormularioModal=new FormData(formularioModal);
fetch('../backend/cambiarRolEstudianteDocente.php',{
    method:'POST',
    body:datosFormularioModal})
    .then(res=>res.json())
    .then(data=>{console.log(data)
    window.location.reload();
    })
}



agregarFuncionBotones();