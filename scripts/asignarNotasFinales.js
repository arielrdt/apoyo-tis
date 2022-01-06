//recupera los elementos del formulario con la id formulario-modal
//las almacena en un formData para mejor uso
let formularioModal=document.getElementById('formulario-modal');
let datosFormularioModal=new FormData(formularioModal);
//Separa los datos del formulario en distinas variables
const ventanaModal=document.getElementById("modal-notas-finales");
const campoCodigoSis=document.getElementById("codigoSis");
const campoNombre=document.getElementById("nombre");
const campoNota=document.getElementById("nota");
const mensaje=document.getElementById("mensaje");
//hace que el modal sea visible
const abrirModal=()=>{ventanaModal.hidden=false;}
//cierra el modal y reinicia sus campos para cuando se vuelva a abrir
const cerrarModal=()=>{
campoCodigoSis.value="";
campoNombre.value="";
campoNota.value="";
ventanaModal.hidden=true;
}
//envia los datos que se mostraran en el modal
const cargarDatos=(codigoSis,nombre)=>{
campoCodigoSis.value=codigoSis;
campoNombre.value=nombre;
abrirModal();
}
//metodo para verificar que la nota sea numerica y vaya entre 1 a 100
const notaValida=(numero)=>{
    let patron = new RegExp("^[1-9]$|^[1-9][0-9]$|^(100)$");
    return !!patron.test(numero);}

//controla / agrega las funciones del modal
const agregarFuncionBotones=()=>{
    //cierra el modal
const botonCancelar=document.getElementById('boton-cancelar');
botonCancelar.addEventListener("click",()=>{cerrarModal();});
//verifica que los datos del modal sean correctos
formularioModal.addEventListener("submit",(e)=>{
e.preventDefault();
if(notaValida(campoNota.value)){calificarAlumno();}
else{
    mensaje.innerHTML="ingrese una nota entre 1 y 100";
}
});

}
//envia los datos del modal a archivo php para que sean almacenados
const calificarAlumno=()=>{
formularioModal=document.getElementById('formulario-modal');
datosFormularioModal=new FormData(formularioModal);
fetch('../backend/registrarNotaFinalAlumno.php',{
    method:'POST',
    body:datosFormularioModal})
    .then(res=>res.json())
    .then(data=>{console.log(data)
    window.location.reload();
    })
}



agregarFuncionBotones();