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


// Seleccionamos los elementos necesarios
const passwordInput = document.getElementById('pass');
const togglePassButton = document.getElementById('togglePass');
const openEyeIcon = document.getElementById('openEye');
const closedEyeIcon = document.getElementById('closedEye');

// Agregamos un evento al botón
togglePassButton.addEventListener('click', () => {
    const isPassword = passwordInput.getAttribute('type') === 'password';

    // Cambiar el tipo de input
    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

    // Alternar íconos
    openEyeIcon.style.display = isPassword ? 'inline' : 'none';
    closedEyeIcon.style.display = isPassword ? 'none' : 'inline';
});