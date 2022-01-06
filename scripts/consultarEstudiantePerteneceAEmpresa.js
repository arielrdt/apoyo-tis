//almacena los datos de la variable dato-Miempresa del archivo empresaEstuiante.html
const datosMiempresa=document.getElementById('datos-Miempresa');

/*consulta si el estudiante pertenece a una empresa.
si pertenece se muestran los datos de la empresa
si no pertenece a una, se le da la opcion de ingresar a una con un codigo 
que le debe dar el representante legal o docente*/
const consultarEstudiantePerteneceEmpresa=()=>{
fetch('../backend/consultarEmpresaEstudiante.php',{method:'GET'})
.then(res=>res.json())
.then(respuesta=>{
          if(!respuesta){
            datosMiempresa.innerHTML='<h2>Mi Empresa</h2><br><br><h2>Todavia no pertenece a un grupo-empresa</h2><br><br><a href="./unirseEmpresa.html">Unirse a un grupo empresa con un codigo</a>';
                                }
        else{
          
            datosMiempresa.innerHTML=respuesta; 
            }
})
}

consultarEstudiantePerteneceEmpresa();