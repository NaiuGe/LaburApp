<!DOCTYPE html>
<html>
    <head charset="UTF-8"> 
    <title> Registo de Usuario </title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>

    <body>
        <div class="centrar">
        <h1> Registro de Usuario </h1>
        <form class="cuadro-inicio-sesion" method="post" action="alta_usuario.php">
            Nombre <br> <input type="text" placeholder="Ingrese su nombre..." name="nombre" required autofocus> <br> <br>
            Apellido <br> <input type="text" placeholder="Ingrese su apellido..." name="apellido" required autofocus> <br> <br>
            Contraseña <br> <input type="password" placeholder="Contraseña..." name="pass" minlength="4" maxlength="10" required> <br> <br>
            Correo Electrónico <br> <input type="text" placeholder="Ingrese su Correo Electrónico..." name="mail" minlength="11" required> <br> <br>
            Teléfono o Celular <br> <input type="tel" placeholder="Ingrese su Número de Teléfono..." name="telefono" required> <br> <br>
            <input type="submit" value="Enviar">
            <br>
            <a href="index.php"> <h4 id="volver"> Volver al inicio </h4></a>
        </form>
        </div>
    </body>
</html>