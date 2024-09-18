
<?php
    include("conexion.php");
    
    $user=$_GET["nombre"];
    $pass=$_GET["pass"];

    $consulta= "SELECT * FROM usuarios WHERE nombre='$user' AND pass='$pass'";

    $resultado= mysqli_query($conexion, $consulta);

    $cantfilas= mysqli_num_rows($resultado);

    if ($cantfilas==1) {
        session_name("LOGIN");
        session_start();
        $_SESSION['nombre']=$user;
        $_SESSION['pass']=$pass;
        $_SESSION['contador']=1;
        header("location:index.php");
    }
    else {
        echo "<h1>No se pudo conectar, nombre de usuario o contraseña incorrecta.</h1>";
        echo "<input class='boton2' type='button' value='Volver' onclick='location=\"index.php\"'>";
    }
    mysqli_close($conexion);
    
?>