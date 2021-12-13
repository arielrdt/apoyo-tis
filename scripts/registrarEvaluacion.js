let formularioSemanal=document.getElementById('formulario-semanal');
let datosFormularioSemanal=new FormData(formularioSemanal);
const ventanaModal=document.getElementById("modal-nota-semanal");
const campoCodigoSis=document.getElementById("codigoSis");
const campoNombre=document.getElementById("nombre");
const campoAsistencia=document.getElementById("asistencia");
const campoNota=document.getElementById("nota");

const mensaje=document.getElementById("mensaje");

const abrirModal=()=>{ventanaModal.hidden=false;}

const cerrarModal=()=>{
    campoCodigoSis.value="";
    campoNombre.value="";
    campoNota.value="";
    ventanaModal.hidden=true;

    }

const datosSemanal=(codigoSis,nombre)=>{
campoCodigoSis.value=codigoSis;
campoNombre.value=nombre;
abrirModal();
}


const notaValida=(numero)=>{
    let patron = new RegExp("^[1-9]$|^[1-9][0-9]$|^(100)$");
    return !!patron.test(numero);}

const agregarFuncion=()=>{
const botonCancelar=document.getElementById('boton-cancelar');
botonCancelar.addEventListener("click",()=>{cerrarModal();});
formularioSemanal.addEventListener("submit",(e)=>{
e.preventDefault();
if(notaValida(campoNota.value)){actualizarNotaSemanalAlumno();}
else{
    mensaje.innerHTML="Ingrese una nota entre 1 y 100";
}
});

}

const actualizarNotaSemanalAlumno=()=>{
formularioSemanal=document.getElementById('formulario-semanal');
datosFormularioSemanal=new FormData(formularioSemanal);
console.log(datosFormularioSemanal);
fetch('../backend/registrarEvaluacionSemanal.php',{
    
    method:'POST',
    body:datosFormularioSemanal})
    .then(res=>res.json())
    .then(data=>{console.log(data)
    window.location.reload();
    })
}
agregarFuncion();