
<?php
    include("conexion.php");
    
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];
    $id_usuario = $_POST["id_usuario"];
    
    //echo var_dump($id_usuario);

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
        echo "<h1>No se pudo conectar, nombre de usuario o contraseña incorrecta.</h1>";
        echo "<input class='boton2' type='button' value='Volver' onclick='location=\"login.html\"'>";
    }
    mysqli_close($conexion);
    
?>