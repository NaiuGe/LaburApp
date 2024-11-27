document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM completamente cargado");

/* Verifica si el responsive está activa sino no crea estos eventos */
    const abrir = document.querySelector("#abrir");
    const cerrar = document.querySelector("#cerrar");
    const nav = document.querySelector("#nav");

    if (abrir && cerrar && nav) {
        abrir.addEventListener("click", () => {
            nav.classList.add("visible");
        });

        cerrar.addEventListener("click", () => {
            nav.classList.remove("visible");
        });
    } else {
        console.log("No se encontraron los elementos del menú móvil. Esto puede ser debido al diseño responsivo.");
    }




let hoy = new Date() // crea una nueva fecha
let anio = hoy.getFullYear() // selecciona el año de esa fecha
let derechos = `&copy; <strong> ${anio} </strong> - LaburAPP - Todos los derechos reservados`
const textoDerechos = document.getElementById('derecho') // se vincula con el id del h3 del footer
textoDerechos.innerHTML = derechos /// lo muestra en el html


function verificar() {
    let clav = document.getElementById("pass").value;

    if (clav.length !== 8) {
    alert("La clave debe tener exactamente 8 caracteres.");
    return false;
    }

    let tMayuscula = false;
    let tMinuscula = false;
    let tDigito = false;

    for (let i = 0; i < clav.length; i++) {
    let letraClav = clav[i];

    if (letraClav >= 'A' && letraClav <= 'Z') {
        tMayuscula = true;
    } else if (letraClav >= 'a' && letraClav <= 'z') {
        tMinuscula = true;
    } else if (letraClav >= '0' && letraClav <= '9') {
        tDigito = true;
    } else {
        alert("La clave solo debe contener caracteres alfanuméricos.");
        return false;
    }
    }

    if (!tMayuscula || !tMinuscula || !tDigito) {
    alert("La clave debe contener al menos una letra mayúscula, una letra minúscula y un dígito.");
    return false;
    }

    return true;
}




function hora(){
    var hora;
    fecha= new Date();
    var cadena = fecha.getHours() + '/' + fecha.getMinutes() + '/' + fecha.getSeconds();
    return cadena;
}

/* ---------------SCRIPT PARA EL OJO -------------------*/

    // Selección de elementos
    const eye = document.querySelector('.eye');
    const iconos = document.querySelector('.eye img');

    // Verificación de elementos
    if (!eye || !iconos) {
        console.error("No se encontró el botón o el ícono del ojo. Verificá tu HTML.");
        return;
    }

    eye.addEventListener('click', () => {
        console.log("Botón del ojo clickeado");
        const input = document.querySelector('#pass');
        if (input) {
            if (input.type === "password") {
                input.type = "text";
                iconos.src = './imagenes/ojo-abierto.png';
            } else {
                input.type = "password";
                iconos.src = './imagenes/ojo-cerrado.png';
            }
        } else {
            console.error("No se encontró el campo de contraseña");
        }
    });


			function preguntar(id) {
				rpta = confirm("Estas seguro de eliminar la publicacion ?");
                if (rpta) {
                    // Si la respuesta es sí, redirigir con el id y el parámetro 'eliminar'
                    window.location.href = "perfil.php?id_publicacion=" + id + "&eliminar=1";
                }}



   

})
function verificar() {
    let clav = document.getElementById("pass").value;

    if (clav.length !== 8) {
    alert("La clave debe tener exactamente 8 caracteres.");
    return false;
    }

    let tMayuscula = false;
    let tMinuscula = false;
    let tDigito = false;

    for (let i = 0; i < clav.length; i++) {
    let letraClav = clav[i];

    if (letraClav >= 'A' && letraClav <= 'Z') {
        tMayuscula = true;
    } else if (letraClav >= 'a' && letraClav <= 'z') {
        tMinuscula = true;
    } else if (letraClav >= '0' && letraClav <= '9') {
        tDigito = true;
    } else {
        alert("La clave solo debe contener caracteres alfanuméricos.");
        return false;
    }
    }

    if (!tMayuscula || !tMinuscula || !tDigito) {
    alert("La clave debe contener al menos una letra mayúscula, una letra minúscula y un dígito.");
    return false;
    }

    return true;
};