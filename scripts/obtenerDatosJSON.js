/*Carga los datos recogidos del archivo php y los imprime fila por fila */
export function obtenerAsistencias() {
    let solicitud=new XMLHttpRequest();
    solicitud.open('GET','../backend/obtenerAsistencias.php');
    solicitud.onload=function(){
        if(solicitud.status==200){
            let json=JSON.parse(solicitud.responseText);
            //crea el codigo html que se enviara al archivo correspondiente
            var html=""; 
            //recorre el arreglo de datos uno a uno para imprimirlos
            json.map(estudiante=>{html=html+'<table class="tabla-estudiantes"><tr class="titulo"><td>Nombre del alumno</td><td>Codigo SIS</td><td>Grupo</td><td>Presentes</td><td>Tardes</td><td>Ausentes</td></tr>'+
            '<tr><td><div class="estudiante">'+estudiante.nombre+'</div></td>' 
            +'<td><div class="codSis">'+estudiante.cod_sis+'</div></td>'
            +'<td><div class="codSis">'+estudiante.grupo+'</div></td>'
            +'<td><div class="tarde">'+estudiante.presentes+'</div></td>'
            +'<td><div class="tarde"style="color:orange">'+estudiante.tardes+'</div></td>'
            +'<td><div class="tarde" style="color:red">'+estudiante.ausentes+'</div></td></tr></table>'});
            //envia los datos creados como html al archivo de frontend 
            const espacioDeAsistencias = document.getElementById("asistencia-alumno");
             espacioDeAsistencias.innerHTML=(html);
            return html;
            
        }
        else{
            //alerta en caso de error
            console.log("error de conexión");
        }
    }
    solicitud.send();
    }
//verifica el estado de la nota del alumno, menor a 50 reprobado, mayor a 50 aprobado
function asignarEstado(notaPromedio,notaFinal) {
    if(notaPromedio>50||notaFinal>50){return "aprobado";}
    else{return "reprobado";}
}
/*Carga los datos recogidos del archivo php y los imprime fila por fila */
    export function obtenerPromediosSemanales() {
        let solicitud=new XMLHttpRequest();
        solicitud.open('GET','../backend/obtenerPromediosSemanales.php');
        solicitud.onload=function(){
            if(solicitud.status==200){
                let json=JSON.parse(solicitud.responseText);
            //crea el codigo html que se enviara al archivo correspondiente
            var html=""; 
            //recorre el arreglo de datos uno a uno para imprimirlos
            json.map(estudiante=>{html=html+'<table class="tabla-estudiantes"><tr class="titulo"><td>Nombre del alumno</td><td>Codigo SIS</td><td>Promedio</td><td>nota final</td><td>estado</td></tr>'
                +'<tr><td><div class="estudiante">'+estudiante.nombre+'</div></td>'+
            '<td><div class="estudiante">'+estudiante.cod_sis+'</div></td>'+
            '<td><div class="estudiante">'+estudiante.promedioNotas+'</div></td>'+
            '<td><div class="estudiante">'+estudiante.notaFinal+'</div></td>'+
            '<td><div class="estudiante">'+asignarEstado(estudiante.promedioNotas,estudiante.notaFinal)
            +'</div></td></tr></table>'
        });
           
            //envia los datos creados como html al archivo de frontend 
            const espacioDeAsistencias = document.getElementById("notas-alumno");
             espacioDeAsistencias.innerHTML=(html);
           
            return html;
            }
            else{
                //mensaje de error en consola en caso de error de conexion
                console.log("error de conexión");
            }
        }
        solicitud.send();
        }

        