<!DOCTYPE html>
<html>
    <head charset="UTF-8"> 
    <title> Registo de Usuario </title>
    </head>

    <body>
        <h1> Registro de Usuario </h1>
        <br>
        <form get="get" action="alta_usuario.php">
            Nombre  <br> <input type="text" placeholder="Nombre de usuario..." name="nombre" required autofocus> <br> <br>
            Apellido <br> <input type="text" placeholder="Apellido..." name="apellido" required autofocus> <br> <br>
            Contraseña <br> <input type="password" placeholder="Contraseña..." name="pass" minlength="4" maxlength="10" required> 
            <br> <br>
            <input type="submit" value="enviar">
            <a href="index.php"> <h4> Volver al inicio </h4></a>
        </form>
    </body>
</html>