<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registo de Usuario </title>
    <link rel="icon" href="imagenes/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
  

    <body>
        <div class="centrar">
        <h1> Registro de Usuario </h1>
        <form class="cuadro-inicio-sesion" onsubmit="return verificar()" method="post" action="alta_usuario.php" enctype="multipart/form-data">
            <div class='contenedor-input'>
                <h3>Foto de perfil</h3> <input type="file" name="imagen" required>
            </div>
            <div class='contenedor-input'>
                <h3>Nombre</h3> <input type="text" placeholder="Ingrese su nombre..." name="nombre" id="nombre"  required autofocus>
            </div>
            <div class='contenedor-input'>
                <h3>Apellido</h3> <input type="text" placeholder="Ingrese su apellido..." name="apellido" required autofocus> 
            </div>
            <div class='contenedor-input'>
                <h3>Contraseña</h3> <input type="password" placeholder="Contraseña..." name="pass" id="pass" minlength="4" maxlength="10" required>
                <p class="eye"><img src="./imagenes/ojo-cerrado.png" alt="Ojo cerrado"></p>
            </div>
            <div class='contenedor-input'>
                <h3>Correo Electrónico</h3> <input type="email" placeholder="Ingrese su Correo Electrónico..." id="mail" name="mail" minlength="11" required> 
            </div>
            <div class='contenedor-input'>
                <h3>Teléfono o Celular</h3> <input type="tel" placeholder="Ingrese su Número de Teléfono..." name="telefono" required> 
            </div>
            <div class='contenedor-input'>
                <h3>Seleccionar localidad</h3> 
                <select name="localidad"  required>    
                    <option value="" selected disabled > Seleccionar Localidad </option>
                <?php
                include("conexion.php");
                $consulta = "SELECT * FROM localidades ORDER BY id_localidad";
                $resultado = mysqli_query($conexion, $consulta);
                while($fila = mysqli_fetch_array($resultado)){
                    $localidad = $fila['nombre_localidad'];
                    $id_localidad = $fila['id_localidad'];
                                ?>
                    <option value="<?php echo $id_localidad; ?>" ><?php echo $localidad; ?></option>
                    <?php
                }
                ?>
                </select>
            </div>
            <input class="btn-busqueda" type="submit" value="Crear usuario">
            <br>
            <a href="index.php"> <h4 id="volver"> Volver al inicio </h4></a>
        </form>
        </div>
        <footer> 
        <div class="paginacion">
        </div>
        <h3 id="derecho"></h3>
        </footer>
        <script src="script.js"></script> 
    </body>
</html>