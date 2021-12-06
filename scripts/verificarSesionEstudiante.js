    fetch('../backend/verificarLogeoEstudiante.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>{ console.log(mensaje)
        if(!mensaje){window.location.href ='./paginaPrincipal.html';}
    
    }
        )


