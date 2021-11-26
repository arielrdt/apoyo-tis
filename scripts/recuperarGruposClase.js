// const botonCerrarModal = document.getElementById('boton-cerrar-modal');

// botonCerrarModal.addEventListener("click", () => {
//     contenidoModal.classList.remove("show");
//   });
const asignarFuncionesModal=()=>{
    const contenidoModal=document.getElementsByClassName('ventana-modal');
    const botonAbrirModal=document.getElementsByClassName('boton-abrir-modal');
    botonAbrirModal.addEventListener("click", () => {contenidoModal.classList.add("show");
      });
}


const recuperarGruposClase=()=>{
    fetch('../backend/consultarGruposClase.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
    const seccionGrupos=document.getElementById('espacio-botones-seleccion-grupo');
    seccionGrupos.innerHTML=data;
   //  asignarFuncionesModal();
})
    } 
    recuperarGruposClase();
    
    
    