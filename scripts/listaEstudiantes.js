
const lista = document.querySelectorAll('.main-card-title')
const titulo = document.querySelectorAll('.main-card-list')
// const titulo = document.querySelectorAll('.main-card-name')

titulo.forEach( ( cadaTitulo , i )=> {
    titulo[i].addEventListener('click', ()=> {
        lista.forEach( ( cadaLista , i )=> {
            lista[i].classList.remove('activo')
        })
        lista[i].classList.add('activo');
    })
})