<?php

include("conexion.php");

$user = $_POST["nombre"];
$apellido = $_POST['apellido'];
$pass = $_POST["pass"];
$mail = $_POST["mail"];
$telefono = $_POST["telefono"];

$consulta = "SELECT * FROM usuarios WHERE mail='$mail'";
$resultado = mysqli_query($conexion, $consulta);
$cantfilas = mysqli_num_rows($resultado);
if ($cantfilas == 1) {
    echo "<h3> El usuario ya se encuentra registrado. </h3>";
    echo "<input type='button' value='Volver' onClick='location=\"index.php\"'> ";
} else {
    $sql = "INSERT INTO usuarios (nombre, apellido, contraseña, mail, telefono) VALUES ('$user', '$apellido', '$pass', '$mail', '$telefono' )";
    mysqli_query($conexion, $sql);
    echo "registrado con éxito.";
    echo "<br> <br>";
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
        mysqli_close($conexion);
        echo "<input type='button' value='Volver' onClick='location=\"index.php\"'> ";}
}
