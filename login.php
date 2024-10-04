
<?php
    include("conexion.php");
    
<<<<<<< HEAD
    $user = $_GET["nombre"];
    $apellido = $_GET['apellido'];
    $pass = $_GET["pass"];
=======
    $user = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $pass = $_POST["pass"];
>>>>>>> main

    $consulta = "SELECT * FROM usuarios WHERE nombre='$user' AND apellido='$apellido' AND contraseña='$pass'";

    $resultado= mysqli_query($conexion, $consulta);

    $cantfilas= mysqli_num_rows($resultado);

    if ($cantfilas==1) {
<<<<<<< HEAD
        $fila= mysqli_fetch_assoc($resultado);
=======
        $fila = mysqli_fetch_assoc($resultado);
>>>>>>> main
        session_name("LOGIN");
        session_start();
        $_SESSION['nombre']=$fila['nombre'];
        $_SESSION['apellido']=$fila['apellido'];
        $_SESSION['pass']=$fila['contraseña'];
        $_SESSION['contador']=1;
        $_SESSION['id_usuario']=$fila['id_usuario'];
        $_SESSION['contador-fotoperfil']=1;
        $_SESSION['info-foto-perfil']=$fila['foto_perfil'];
        $_SESSION['contador-fotoperfil']=1;
        header("location:index.php");
    }
    else {
        echo "<h1>No se pudo conectar, nombre de usuario o contraseña incorrecta.</h1>";
        echo "<input class='boton2' type='button' value='Volver' onclick='location=\"login.html\"'>";
    }
    mysqli_close($conexion);
    
?>