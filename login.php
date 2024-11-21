
<?php
    include("conexion.php");
    
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];

    $consulta = "SELECT * FROM usuarios WHERE mail='$mail' AND contraseña='$pass'";

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
        $_SESSION['id_usuario']=$fila['id_usuario'];
        $_SESSION['info-foto-perfil']=$fila['foto_perfil'];
        $_SESSION['contador-fotoperfil']=1;
        header("location:index.php");
    }
    else {
        echo '<script>';
        echo "alert('No se pudo iniciar sesión, usuario o contraseña incorrecta. Por favor intente nuevamente');";
        echo 'window.location.href = "login.html";';
        echo '</script>';
    }
    mysqli_close($conexion);
    
?>