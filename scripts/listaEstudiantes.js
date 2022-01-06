//selecciona e imprime los estudiantes de las empresas
const lista = document.querySelectorAll('.main-card-title')
const titulo = document.querySelectorAll('.main-card-list')
// const titulo = document.querySelectorAll('.main-card-name')
//envia las listas una a una
titulo.forEach( ( cadaTitulo , i )=> {
    titulo[i].addEventListener('click', ()=> {
        lista.forEach( ( cadaLista , i )=> {
            lista[i].classList.remove('activo')
        })
        lista[i].classList.add('activo');
    })
})