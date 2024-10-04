
<?php
    include("conexion.php");
    
    $user = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $pass = $_POST["pass"];

    $consulta = "SELECT * FROM usuarios WHERE nombre='$user' AND contraseña='$pass'";

    $resultado= mysqli_query($conexion, $consulta);

    $cantfilas= mysqli_num_rows($resultado);

    if ($cantfilas==1) {
        $fila = mysqli_fetch_assoc($resultado);
        session_name("LOGIN");
        session_start();
        $_SESSION['nombre']=$fila['nombre'];
        $_SESSION['apellido']=$fila['apellido'];
        $_SESSION['pass']=$fila['contraseña'];
        $_SESSION['contador']=1;
        header("location:index.php");
    }
    else {
        echo "<h1>No se pudo conectar, nombre de usuario o contraseña incorrecta.</h1>";
        echo "<input class='boton2' type='button' value='Volver' onclick='location=\"index.php\"'>";
    }
    mysqli_close($conexion);
    
?>