//llama a las funciones del archivo obtenerDatosJSON 
import {
  obtenerAsistencias,
  obtenerPromediosSemanales,
} from './obtenerDatosJSON.js';

obtenerAsistencias();
obtenerPromediosSemanales();
/*
const llenarTablaDeAsistencias=() =>{
  let datosDeAsistencias= obtenerAsistencias();
  
  const espacioDeAsistencias = document.getElementById("asistencia-alumno");
  espacioDeAsistencias.innerHTML=(datosDeAsistencias);
  };
  llenarTablaDeAsistencias();*/