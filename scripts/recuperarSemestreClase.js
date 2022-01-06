//@param semestreActual:semestre Actual del sistema
//@param anioActual:año Actual del sistema
//@param mesActual:mes Actual del sistema
let semestreActual=document.getElementById('semestre');
let anioActual=(new Date).getFullYear();
let mesActual=(new Date).getMonth();
//funcion para asignar el semestre actual al formulario de crear pliego o invitacion publica
const asignarSemestreActual=()=>{
if(mesActual<6){semestreActual.innerHTML="Semestre: 1-"+anioActual;}
else{semestreActual.innerHTML="Semestre: 2-"+anioActual;}
}
asignarSemestreActual();