"<!DOCTYPE html>
<html>
    <head charset="UTF-8"> 
    <title> Registo de Usuario </title>
    </head>

    <body>
        <h1> Registro de Usuario </h1>
        <br>
        <form method="post" action="alta_usuario.php">
            Nombre <br> <input type="text" placeholder="Ingrese su nombre..." name="nombre" required autofocus> <br> <br>

            Apellido <br> <input type="text" placeholder="Ingrese su apellido..." name="apellido" required autofocus> <br> <br>

            Contraseña <br> <input type="password" placeholder="Contraseña..." name="pass" minlength="4" maxlength="10" required> <br> <br>

            Correo Electrónico <br> <input type="text" placeholder="Ingrese su Correo Electrónico..." name="mail" minlength="11" required> <br> <br>

            Domicilio <br> <input type="text" placeholder="Ingrese la dirección donde reside" name="domicilio" required> <br> <br>

            Teléfono o Celular <br> <input type="tel" placeholder="Ingrese su Número de Teléfono..." name="telefono" required> <br> <br>

            <input type="submit" value="enviar">
            <a href="index.php"> <h4> Volver al inicio </h4></a>
        </form>
    </body>
</html>