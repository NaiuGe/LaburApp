<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8">
        <title>Registro de Usuario</title>
        <link rel="icon" href="imagenes/logo.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>

    <body>
        <div class="centrar">
            <h1>Registro de Usuario</h1>
            <form class="cuadro-inicio-sesion" onsubmit="return verificar()" method="post" action="alta_usuario.php" enctype="multipart/form-data">
                Foto de perfil <br>
                <input type="file" name="imagen" required>
                <br><br>
                Nombre <br>
                <input type="text" placeholder="Ingrese su nombre..." name="nombre" id="nombre" required autofocus>
                <br><br>
                Apellido <br>
                <input type="text" placeholder="Ingrese su apellido..." name="apellido" required autofocus>
                <br><br>
                Contraseña <br>
                <div class="password-container">
                    <input type="password" placeholder="Contraseña..." name="pass" id="pass" minlength="4" maxlength="10" required>
                    <button type="button" id="togglePass" aria-label="Mostrar/Ocultar contraseña">
                        <!-- Icono del ojo cerrado -->
                        <svg id="closedEye" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: inline;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M19.74 15.64C20.99 14.18 22 12 22 12s-2.72-4.5-10-4.5S2 12 2 12s.71 1.19 1.87 2.36m4.96-.35a3 3 0 104.3-4.3M3 3l18 18"></path>
                        </svg>
                        <!-- Icono del ojo abierto -->
                        <svg id="openEye" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.728 2.214-2.885 4.557-5.654 6.187A9.954 9.954 0 0112 19c-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <br><br>
                Correo Electrónico <br>
                <input type="email" placeholder="Ingrese su Correo Electrónico..." id="mail" name="mail" minlength="11" required>
                <br><br>
                Teléfono o Celular <br>
                <input type="tel" placeholder="Ingrese su Número de Teléfono..." name="telefono" required>
                <br><br>
                <h3>Seleccionar localidad</h3>
                <select name="localidad" required>
                    <option value="" selected disabled>Seleccionar Localidad</option>
                    <?php
                        include("conexion.php");
                        $consulta = "SELECT * FROM localidades ORDER BY id_localidad";
                        $resultado = mysqli_query($conexion, $consulta);
                        while($fila = mysqli_fetch_array($resultado)){
                            $localidad = $fila['nombre_localidad'];
                            $id_localidad = $fila['id_localidad'];
                    ?>
                    <option value="<?php echo $id_localidad; ?>"><?php echo $localidad; ?></option>
                    <?php
                        }
                    ?>
                </select>
                <br><br>
                <input class="btn-busqueda" type="submit" value="Crear usuario">
                <br>
                <a href="index.php">
                    <h4 id="volver">Volver al inicio</h4>
                </a>
            </form>
        </div>
        <footer>
            <div class="paginacion"></div>
            <h3 id="derecho"></h3>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
