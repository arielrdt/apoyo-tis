const btnEditarInvitacion=document.getElementById();
const formInvi=document.getElementById();

btnEditarInvitacion.addEventListener(()=>{formInvi.hidden=false;btnEditarInvitacion.hidden=true;})


fetch('../backend/consultarSiExisteinvitacio.php',{method:'GET'})
.then(res=>res.json())
.then(mensaje=>{
          if(mensaje){
              formInvi.hidden=true;
              btnEditarInvitacion.hidden=false;            
              obtenerDatosActualInvitacion();
                     }
          else{formInvi.hidden=false;}
})


function obtenerDatosActualInvitacion() {
    let solicitud=new XMLHttpRequest();
    solicitud.open('GET','../backend/datosActualInvitacion.php');
    solicitud.onload=function(){
        if(solicitud.status==200){
        let json=JSON.parse(solicitud.responseText);
                 
        


        return html;
        }
        else{
            console.log("error de conexión");
        }
    }
    solicitud.send();
    }