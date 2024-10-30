let hoy = new Date() // crea una nueva fecha
let anio = hoy.getFullYear() // selecciona el año de esa fecha
let derechos = `&copy; <strong> ${anio} </strong> - LaburAPP - Todos los derechos reservados.`
const textoDerechos = document.getElementById('derecho') // se vincula con el id del h3 del footer
textoDerechos.innerHTML = derechos // lo muestra en el html