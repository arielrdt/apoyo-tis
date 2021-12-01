let formularioModal=document.getElementById('formulario-modal');
let datosFormularioModal=new FormData(formularioModal);
const ventanaModal=document.getElementById("modal-notas-finales");
const campoCodigoSis=document.getElementById("codigoSis");
const campoNombre=document.getElementById("nombre");
const campoNota=document.getElementById("nota");

const abrirModal=()=>{ventanaModal.hidden=false;}

const cerrarModal=()=>{
campoCodigoSis.value="";
campoNombre.value="";
campoNota.value="";
ventanaModal.hidden=true;
}

const cargarDatos=(codigoSis,nombre)=>{
campoCodigoSis.value=codigoSis;
campoNombre.value=nombre;
abrirModal();
}

const notaValida=(numero)=>{
    let patron = new RegExp("^[0-9]");
    return !!patron.test(numero);}

    
const agregarFuncionBotones=()=>{
const botonCancelar=document.getElementById('boton-cancelar');
botonCancelar.addEventListener("click",()=>{cerrarModal();});
formularioModal.addEventListener("submit",(e)=>{
e.preventDefault();
if(notaValida(campoNota.value)){calificarAlumno();}
else{console.log("nota no valida")}
});

}

const calificarAlumno=()=>{
formularioModal=document.getElementById('formulario-modal');
datosFormularioModal=new FormData(formularioModal);
fetch('../backend/registrarNotaFinalAlumno.php',{
    method:'POST',
    body:datosFormularioModal})
    .then(res=>res.json())
    .then(data=>{console.log(data)})
}



agregarFuncionBotones();