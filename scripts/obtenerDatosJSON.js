export function obtenerAsistencias() {
let solicitud=new XMLHttpRequest();
solicitud.open('GET','../backend/obtenerAsistencias.php');
solicitud.onload=function(){
    if(solicitud.status==200){
        let json=JSON.parse(solicitud.responseText);
        console.log(json);
        return json;
        
    }
    else{
        console.log("error de conexión");
    }
}
solicitud.send();
}


export function obtenerPromediosSemanales() {
let solicitud=new XMLHttpRequest();
solicitud.open('GET','../backend/obtenerPromediosSemanales.php');
solicitud.onload=function(){
    if(solicitud.status==200){
        let json=JSON.parse(solicitud.responseText);
        console.log(json);
        return json;
    }
    else{
        console.log("error de conexión");
    }
}
solicitud.send();
}

obtenerAsistencias();