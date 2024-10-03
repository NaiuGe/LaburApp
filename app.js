const stars = document.querySelectorAll('.star');

// Variable para almacenar la calificación seleccionada
let selectedRating = 0;

stars.forEach(function(star, index) {
    star.addEventListener('click', function() {
        selectedRating = index + 1; // Almacena la calificación (1 a 5)

        // Actualizamos las estrellas visualmente
        for (let i = 0; i <= index; i++) {
            stars[i].classList.add('checked');
        }
        for (let i = index + 1; i < stars.length; i++) {
            stars[i].classList.remove('checked');
        }
    });
});

// Enviar la calificación mediante AJAX
document.getElementById('ratingForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevenir que el formulario recargue la página

    // Verificar que se haya seleccionado una calificación
    if (selectedRating > 0) {
        // Crear una solicitud AJAX
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "rating.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Enviar la calificación al archivo PHP
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Mostrar el resultado de la respuesta del servidor
                document.getElementById('result').innerHTML = xhr.responseText;
            }
        };

        // Enviar la calificación seleccionada
        xhr.send("rating=" + selectedRating);
    } else {
        alert("Por favor, selecciona una calificación.");
    }
});