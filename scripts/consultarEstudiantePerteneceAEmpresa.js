const datosMiempresa=document.getElementById('datos-Miempresa');

const consultarEstudiantePerteneceEmpresa=()=>{
fetch('../backend/consultarEmpresaEstudiante.php',{method:'GET'})
.then(res=>res.json())
.then(respuesta=>{
          if(!respuesta){
            datosMiempresa.innerHTML='<h2>Mi Empresa</h2><br><br><h2>Todavia no pertenece a un grupo-empresa</h2><br><br><a>Unirse a un grupo empresa con un codigo</a>';
                                }
        else{
            datosMiempresa.innerHTML=respuesta; 
            }
})
}

consultarEstudiantePerteneceEmpresa();