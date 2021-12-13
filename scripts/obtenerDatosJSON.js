export function obtenerAsistencias() {
    let solicitud=new XMLHttpRequest();
    solicitud.open('GET','../backend/obtenerAsistencias.php');
    solicitud.onload=function(){
        if(solicitud.status==200){
            let json=JSON.parse(solicitud.responseText);
            console.log(json);
            var html=""; 
            json.map(estudiante=>{html=html+'<table class="tabla-estudiantes"><tr class="titulo"><td>Nombre del alumno</td><td>Codigo SIS</td><td>Grupo</td><td>Presentes</td><td>Tardes</td><td>Ausentes</td></tr>'+
            '<tr><td><div class="estudiante">'+estudiante.nombre+'</div></td>' 
            +'<td><div class="codSis">'+estudiante.cod_sis+'</div></td>'
            +'<td><div class="codSis">'+estudiante.grupo+'</div></td>'
            +'<td><div class="tarde">'+estudiante.presentes+'</div></td>'
            +'<td><div class="tarde">'+estudiante.tardes+'</div></td>'
            +'<td><div class="tarde">'+estudiante.ausentes+'</div></td></tr></table>'});
             const espacioDeAsistencias = document.getElementById("asistencia-alumno");
             espacioDeAsistencias.innerHTML=(html);
            return html;
            
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
            var html=""; 
            json.map(estudiante=>{html=html+'<table class="tabla-estudiantes"><tr class="titulo"><td>Nombre del alumno</td><td>Codigo SIS</td><td>Promedio</td></tr>'
                +'<tr><td><div class="estudiante">'+estudiante.nombre+'</div></td>'+
            '<td><div class="estudiante">'+estudiante.cod_sis+'</div></td>'+
            '<td><div class="estudiante">'+estudiante.promedioNotas+'</div></td></tr></table>'
        });
           
             const espacioDeAsistencias = document.getElementById("notas-alumno");
             espacioDeAsistencias.innerHTML=(html);
            console.log(html);
            return html;
            }
            else{
                console.log("error de conexión");
            }
        }
        solicitud.send();
        }

        